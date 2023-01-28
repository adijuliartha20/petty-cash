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
    		'data'=> $this->recordReimburseModel->getData(),
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

    	/*$data = [
    		'title' => 'Tambah '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/save',
            'dt' => [],
            'klaim'=> $this->recordKlaimModel->getDataKlaim()
    	];
    	return view('admin/'.$this->appName.'/edit',$data);*/
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
            'klaim'=> $this->recordKlaimModel->getDataKlaim(),
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

    	$data = [
            'id_klaim'    => $this->request->getVar('id_klaim'),
            'tanggal'     => $tanggal,
            'jumlah'      => $this->request->getVar('jumlah'),
            'bukti_reimburse'   => $this->request->getVar('bukti_reimburse'),
            'id_user'     => 1
    	];
    	
    	$this->recordReimburseModel->update($id,$data);
    	session()->setFlashdata('pesan','Data Reimburse tanggal '.$this->request->getVar('tanggal').' berhasil diupdate.');

    	return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function delete($id){
        //get data
        $data = $this->assetsModel->getDataByPost($id);
        //delete asset
        foreach ($data as $dt) {
            $id = $dt['id_asset'];
            if($this->assetsModel->where('id_asset',$id)->delete()){
                unlink('../public/assets/reimburse/'.$dt['nama']);
            }
        }       

        $this->recordReimburseModel->delete($id);
        return redirect()->to(base_url().'/'.$this->appName.'');
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

        $data = $this->assetsModel->getDataByPost($slug);
        if(!empty($data)){
            $dt['listFile'] = $data;
        }

        return $this->response->setJSON($dt);
    }

}