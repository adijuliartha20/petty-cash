<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RecordKasModel;
use App\Models\AssetsModel;

class RecordKas extends BaseController
{
	protected $recordKasModel;
	public function __construct(){
        $this->recordKasModel = new RecordKasModel();
        $this->assetsModel = new AssetsModel();
        $this->appName = 'record-kas';
        $this->title = 'Record Kas';
	}

    public function index(){
    	$data = [
    		'title' => $this->title,
    		'data'=> $this->recordKasModel->getData(),
            'app'=> $this->appName
    	];
        return view('admin/'.$this->appName.'/index', $data);
    }

    public function create(){
        //auto 
        $id_kas = $this->recordKasModel->setID();
        $data = [
            'id_kas' => $id_kas,
            'status' => 0,//set draft
            'id_user' => 1
        ];       
        $this->recordKasModel->insert($data);

        return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id_kas);
    }

    public function save(){
        if(!$this->validate([
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
            'sumber' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'bukti_kas' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ]

        ])){
            $validation = \Config\Services::validation();
            //dd($validation);
            return redirect()->to(base_url().'/'.$this->appName.'/create')->withInput()->with('validation',$validation);
        }

        $tanggal  ='';
        $dttgl = explode('/',$this->request->getVar('tanggal'));   
        if(!empty($dttgl)){
            $tanggal = $dttgl[2].'-'.$dttgl[1].'-'.$dttgl[0].' 00:00:00';
        }
    	$data = [
    		'id_kas' => $this->recordKasModel->setID(),
    		'tanggal' => $tanggal,
    		'jumlah' => $this->request->getVar('jumlah'),
    		'sumber' => $this->request->getVar('sumber'),
    		'bukti_kas' => $this->request->getVar('bukti_kas'),
    		'id_user' => 1
    	];
        //echo $this->request->getVar('tanggal').'#';
       
        //dd($data);
    	$this->recordKasModel->insert($data);

    	session()->setFlashdata('pesan','Data kas pada tanggal '.$this->request->getVar('tanggal').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/'.$this->appName.'/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => $this->title,//'Edit '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/update',
            'upload' => base_url().'/'.$this->appName.'/upload',
            'deleteFile' => base_url().'/'.$this->appName.'/delete-file',
            'actGetFile' => base_url().'/'.$this->appName.'/list-assets',
            'assetLink' => base_url().'/assets',
    		'dt'=> $this->recordKasModel->getData($slug),
            'typeAsset' => 'kas'
    	];
    	
    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data '.$this->title.' tidak ditemukan');
    	}

    	return view('admin/'.$this->appName.'/edit', $data);
    }


    public function update(){
        $id = $this->request->getVar('id');
        if(!$this->validate([
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
            'sumber' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ]
        ])){
            $validation = \Config\Services::validation();dd($validation);
            return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id)->withInput()->with('validation',$validation);
        }

    	
        $tanggal  ='';
        $dttgl = explode('/',$this->request->getVar('tanggal'));   
        if(!empty($dttgl)){
            $tanggal = $dttgl[2].'-'.$dttgl[1].'-'.$dttgl[0].' 00:00:00';
        }

    	$data = [
    		'tanggal' => $tanggal ,
            'jumlah' => $this->request->getVar('jumlah'),
            'sumber' => $this->request->getVar('sumber'),
            'id_user' => 1,
            'status'=>1
    	];
    	
    	$this->recordKasModel->update($id,$data);
    	session()->setFlashdata('pesan','Data kas tanggal '.$this->request->getVar('tanggal').' berhasil diupdate.');

    	return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function delete($id){
         //get data
        $data = $this->assetsModel->getDataByPost($id);
        //delete asset
        foreach ($data as $dt) {
            $id = $dt['id_asset'];
            if($this->assetsModel->where('id_asset',$id)->delete()){
                unlink('../public/assets/kas/'.$dt['nama']);
            }
        }
        $this->recordKasModel->delete($id);
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
                    $id_kas = $this->request->getVar('id_kas');
                    $idAsset = $this->assetsModel->setID();
                    $data = [
                                'id_asset' => $idAsset,
                                'nama' => $newName,
                                'id_data' => $id_kas,
                                'tipe' => 'kas',
                                'id_user' => 1
                            ];
                    $this->assetsModel->insert($data);

                    // Store file in public/uploads/ folder
                    $file->move('../public/assets/kas', $newName);

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
                unlink('../public/assets/kas/'.$img['nama']);
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