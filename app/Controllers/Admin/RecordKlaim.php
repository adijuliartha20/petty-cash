<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RecordKlaimModel;
use App\Models\RecordKlaimDetailModel;
use App\Models\SiteModel;
use App\Models\PettyCashGroupModel;
use App\Models\UserPettyCashModel;
use App\Models\AssetsModel;

class RecordKlaim extends BaseController
{
    protected $recordKlaimModel;
	public function __construct(){
        $this->recordKlaimModel = new RecordKlaimModel();
        $this->recordKlaimDetailModel = new RecordKlaimDetailModel();
        $this->siteModel = new SiteModel();
        $this->pettyCashGroupModel = new PettyCashGroupModel();
        $this->userPettyCashModel = new UserPettyCashModel();
        $this->assetsModel = new AssetsModel();
        $this->appName = 'record-klaim';
        $this->title = 'Record Klaim';
	}

    public function index(){
    	$data = [
    		'title' => $this->title,
    		'data'=> $this->recordKlaimModel->getData(),
            'app'=> $this->appName
    	];
        return view('admin/'.$this->appName.'/index', $data);
    }

    public function create(){
        $id = $this->recordKlaimModel->setID();
        $data = [
            'id_klaim'=> $id,
            'status'=>0,
            'id_user'     => 1
        ];

        $this->recordKlaimModel->insert($data);
        return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function edit($slug){
        $data = [
            'title' => $this->title,
            'action' => base_url().'/'.$this->appName.'/update',            
            'dt'=> $this->recordKlaimModel->getData($slug),
            'sites' => $this->siteModel->getData(),
            'pettyCashGroup' => $this->pettyCashGroupModel->getData(),
            'userPettyCash' => $this->userPettyCashModel->getData(),
            'dataKlaim' => $this->recordKlaimDetailModel->getData($slug),
            'upload' => base_url().'/'.$this->appName.'/upload',
            'deleteFile' => base_url().'/'.$this->appName.'/delete-file',
            'actGetFile' => base_url().'/'.$this->appName.'/list-assets',
            'assetLink' => base_url().'/assets',
            'typeAsset' => 'klaim'
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
            'tanggal' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'id_site' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'id_petty_cash_group' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'id_user_petty_cash' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'total' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ]
        ])){
            $validation = \Config\Services::validation();//dd($validation);
            return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id)->withInput()->with('validation',$validation);
        }

        $nama = $this->request->getVar('nama');
        $this->recordKlaimDetailModel->where('id_klaim',$id)->delete();
        if(!empty($nama)){            
            //simpan detail
            $harga = $this->request->getVar('harga');
            $jumlah = $this->request->getVar('jumlah');            
            foreach ($nama as $key => $value) {
                $dataDetail = [
                    'id_klaim' => $id,
                    'nama' => $value,
                    'harga' => $harga[$key],
                    'jumlah' => $jumlah[$key]
                ];
                $this->recordKlaimDetailModel->insert($dataDetail);
            }
        }//dd($this->request->getVar());
        
        $tanggal  ='';
        $dttgl = explode('/',$this->request->getVar('tanggal'));   
        if(!empty($dttgl)){
            $tanggal = $dttgl[2].'-'.$dttgl[1].'-'.$dttgl[0].' 00:00:00';
        }

        $data = [
            'id_site'    => $this->request->getVar('id_site'),
            'id_petty_cash_group'    => $this->request->getVar('id_petty_cash_group'),
            'id_user_petty_cash'    => $this->request->getVar('id_user_petty_cash'),
            'tanggal'     => $tanggal,
            'total'      => $this->request->getVar('total'),
            'id_user'     => 1
        ];
        
        $this->recordKlaimModel->update($id,$data);

        session()->setFlashdata('pesan','Data Klaim tanggal '.$this->request->getVar('tanggal').' berhasil disimpan.');

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
                                'tipe' => 'klaim',
                                'id_user' => 1
                            ];
                    $this->assetsModel->insert($data);

                    // Store file in public/uploads/ folder
                    $file->move('../public/assets/klaim', $newName);

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
                unlink('../public/assets/klaim/'.$img['nama']);
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
?>