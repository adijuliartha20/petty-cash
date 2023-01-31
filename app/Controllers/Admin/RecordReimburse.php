<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RecordReimburseModel;
use App\Models\RecordKlaimModel;
use App\Models\AssetsModel;

class RecordReimburse extends BaseController
{
	protected $recordReimbustModel;
    protected $recordKlaimModel;
	public function __construct(){
        $this->recordReimburseModel = new RecordReimburseModel();
        $this->recordKlaimModel = new RecordKlaimModel();
        $this->assetsModel = new AssetsModel();
        $this->appName = 'record-reimburse';
        $this->title = 'Record Reimburse';
	}

    public function index(){
    	$data = [
    		'title' => $this->title,
    		'data'=> $this->recordReimburseModel->getDataRemburceWithDetail(),
            'app'=> $this->appName
    	];
        return view('admin/'.$this->appName.'/index', $data);
    }

    public function create(){
        $id = $this->recordReimburseModel->setID();
        $data = [
            'id_reimburse'=> $id,
            'id_user'     => 1
        ];

        $this->recordReimburseModel->insert($data);
        return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function save(){
        if(!$this->validate([
            'id_klaim' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'tanggal' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'jumlah' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'bukti_reimburse' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ]

        ])){
            $validation = \Config\Services::validation(); dd($validation);
            return redirect()->to(base_url().'/'.$this->appName.'/create')->withInput()->with('validation',$validation);
        }

        $tanggal  ='';
        $dttgl = explode('/',$this->request->getVar('tanggal'));   
        if(!empty($dttgl)){
            $tanggal = $dttgl[2].'-'.$dttgl[1].'-'.$dttgl[0].' 00:00:00';
        }
    	$data = [
    		'id_reimburse'=> $this->recordReimburseModel->setID(),
            'id_klaim'    => $this->request->getVar('id_klaim'),
    		'tanggal'     => $tanggal,
    		'jumlah'      => $this->request->getVar('jumlah'),
    		'bukti_reimburse'   => $this->request->getVar('bukti_reimburse'),
    		'id_user'     => 1
    	];

    	$this->recordReimburseModel->insert($data);

    	session()->setFlashdata('pesan','Data reimburse pada tanggal '.$this->request->getVar('tanggal').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/'.$this->appName.'/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => $this->title,
    		'action' => base_url().'/'.$this->appName.'/update',    		
    		'dt'=> $this->recordReimburseModel->getData($slug),
            //'klaim'=> $this->recordKlaimModel->getDataKlaim(),
            'klaim'=> $this->recordKlaimModel->getDataKlaimNew(),
            'upload' => base_url().'/'.$this->appName.'/upload',
            'deleteFile' => base_url().'/'.$this->appName.'/delete-file',
            'actGetFile' => base_url().'/'.$this->appName.'/list-assets',
            'assetLink' => base_url().'/assets',
            'typeAsset' => 'reimburse'
    	];
    	//dd($data['dt']);
    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data '.$this->title.' tidak ditemukan');
    	}

    	return view('admin/'.$this->appName.'/edit', $data);
    }


    public function update(){
        $id = $this->request->getVar('id');
        if(!$this->validate([
            'id' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'id_klaim' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'tanggal' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'jumlah' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id)->withInput()->with('validation',$validation);
        }

    	
        $tanggal  ='';
        $dttgl = explode('/',$this->request->getVar('tanggal'));   
        if(!empty($dttgl)){
            $tanggal = $dttgl[2].'-'.$dttgl[1].'-'.$dttgl[0].' 00:00:00';
        }

        $id_klaim = $this->request->getVar('id_klaim');
        $jumlah = (int)$this->request->getVar('jumlah');
    	$data = [
            'id_klaim'    => $id_klaim,
            'tanggal'     => $tanggal,
            'jumlah'      => $jumlah,
            'id_user'     => 1
    	];
    	
        
        //validate for status

        $msg = '';
        $klaim = $this->recordKlaimModel->getTotal($id_klaim);
        $totalKlaim = $klaim['total'];
        $reimburseSebelumnya = $this->recordReimburseModel->getDataByKlaim($id_klaim,$id);
        
        $totalReimburseSebelumnya = (int)$reimburseSebelumnya[0]['totalBayar'];
        $totalBayarSekarang = $jumlah + $totalReimburseSebelumnya;


        /*if($totalKlaim == $totalBayarSekarang){
            echo 'sama';
        }else{
            echo $totalBayarSekarang.' < '.$totalKlaim;    
        }*/
        
        //get id_klaim old bila ganti klaim
        //get data klaim lama
        $dtReimburse = $this->recordReimburseModel->getData($id);
        $idKlaimOld = $dtReimburse['id_klaim'];
        //dd($reimburseSebelumnya);


        if($totalBayarSekarang > $totalKlaim){
            $msg = 'Jumlah reimburse lebih besar dari klaim, tolong input jumlah sama dengan klaim atau lebih kecil';
            session()->setFlashdata('pesanError',$msg);    
        }else{
            $msg = '';
            if($totalKlaim == $totalBayarSekarang){//update status jadi lunas
                $status = ['status'=>1];
                $this->recordKlaimModel->update($id_klaim,$status);
                $msg = 'Data Reimburse tanggal '.$this->request->getVar('tanggal').' berhasil diupdate dan Klaim sudah lunas.';
            }else {
                $kurang = number_format(($totalKlaim - $totalBayarSekarang), 0, '', '.');
                $msg = 'Data Reimburse tanggal '.$this->request->getVar('tanggal').' berhasil diupdate dan klaim masih kurang lagi '.$kurang;
            }

            $this->recordReimburseModel->update($id,$data);//simpan data
            if($id_klaim!= $idKlaimOld && $idKlaimOld!=''){
                $this->calculateKlaim($idKlaimOld);
            }
            session()->setFlashdata('pesan',$msg);
        }
    	return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }


    public function changeStatusKlaim($id){

    }

    public function delete($id){
        //get data klaim lama
        $dtReimburse = $this->recordReimburseModel->getData($id);
        $idKlaim = '';
        if(isset($dtReimburse['id_klaim'])) $idKlaim = $dtReimburse['id_klaim'];

        $this->recordReimburseModel->delete($id);//delete dulu
        if(!empty($idKlaim)) $this->calculateKlaim($idKlaim);//baru calculate lagi

        //get data
        $data = $this->assetsModel->getDataByPost($id,'reimburse');
        //delete asset
        foreach ($data as $dt) {
            $id = $dt['id_asset'];
            if($this->assetsModel->where('id_asset',$id)->delete()){
                unlink('../public/assets/reimburse/'.$dt['nama']);
            }
        }
        return redirect()->to(base_url().'/'.$this->appName.'');
    }


    public function calculateKlaim($idKlaim){
        $dtKlaim = $this->recordKlaimModel->getData($idKlaim);

        $dtReimburse = $this->recordReimburseModel->getDataByKlaim($idKlaim,'');

        $totalBayar = $dtReimburse[0]['totalBayar'];
        $totalKlaim = (isset($dtKlaim['total'])? $dtKlaim['total'] : 0);

        $status = 0;
        if($totalBayar>=$totalKlaim){
            $status = 1;
        }

        $data = ['status'=>$status];

        $this->recordKlaimModel->update($idKlaim,$data);
    }


    public function upload(){
        $data = array();

        // Read new token and assign to $data['token']
        $data['token'] = csrf_hash();

        ## Validation
        $validation = \Config\Services::validation();

        $input = $validation->setRules([
         'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png,pdf],'
        ]);

        if ($validation->withRequest($this->request)->run() == FALSE){
         $data['success'] = 0;
         $data['error'] = $validation->getError('file');// Error response

        }else{
            if($file = $this->request->getFile('file')) {
                if ($file->isValid() && ! $file->hasMoved()) {
                   // Get file name and extension
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    // Get random file name
                    $newName = $file->getRandomName();

                    //save data
                    $id_data = $this->request->getVar('id_data');
                    $idAsset = $this->assetsModel->setID();
                    $data = [
                                'id_asset' => $idAsset,
                                'nama' => $newName,
                                'id_data' => $id_data,
                                'tipe' => 'reimburse',
                                'id_user' => 1
                            ];
                    $this->assetsModel->insert($data);

                    // Store file in public/uploads/ folder
                    $file->move('../public/assets/reimburse', $newName);

                    // Response
                    $data['success'] = 1;
                    $data['newfilename'] = $newName;
                    $data['newId'] = $idAsset;
                    $data['message'] = 'Uploaded Successfully!';
                }else{
                   // Response
                   $data['success'] = 2;
                   $data['message'] = 'File not uploaded.'; 
                }
             }else{
                // Response
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }
        return $this->response->setJSON($data);
    }

    public function deleteFile(){
        $id = $this->request->getVar('idFile');        
        $data = [];
        $data['status'] = 'error';
        $data['message'] = 'file tidak ada';

        $img = $this->assetsModel->getData($id);
        if(!empty($img)){
             //detele data
            if($this->assetsModel->where('id_asset',$id)->delete()){
                unlink('../public/assets/reimburse/'.$img['nama']);
                $data['status'] = 'success';
                $data['message'] = 'file berhasil di hapus';
            }
        }
        return $this->response->setJSON($data);
    }

    public function getListAssets($slug){
        $dt = [];
        $dt['status'] = 'success';

        $data = $this->assetsModel->getDataByPost($slug,'reimburse');
        if(!empty($data)){
            $dt['listFile'] = $data;
        }

        return $this->response->setJSON($dt);
    }

}