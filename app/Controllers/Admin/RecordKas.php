<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RecordKasModel;

class RecordKas extends BaseController
{
	protected $recordKasModel;
	public function __construct(){
        $this->recordKasModel = new RecordKasModel();
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
    	$data = [
    		'title' => 'Tambah '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/save',
            'dt' => []
    	];
    	return view('admin/'.$this->appName.'/edit',$data);
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
       
        dd($data);
    	$this->recordKasModel->insert($data);

    	session()->setFlashdata('pesan','Data kas pada tanggal '.$this->request->getVar('tanggal').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/'.$this->appName.'/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => 'Edit '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/update',    		
    		'dt'=> $this->recordKasModel->getData($slug)
    	];
    	//dd($data['dt']);
    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data '.$this->title.' tidak ditemukan');
    	}

    	return view('admin/'.$this->appName.'/edit', $data);
    }


    public function update(){
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
            return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id)->withInput()->with('validation',$validation);
        }

    	$id = $this->request->getVar('id');
        $tanggal  ='';
        $dttgl = explode('/',$this->request->getVar('tanggal'));   
        if(!empty($dttgl)){
            $tanggal = $dttgl[2].'-'.$dttgl[1].'-'.$dttgl[0].' 00:00:00';
        }

    	$data = [
    		'tanggal' => $tanggal ,
            'jumlah' => $this->request->getVar('jumlah'),
            'sumber' => $this->request->getVar('sumber'),
            'bukti_kas' => $this->request->getVar('bukti_kas'),
            'id_user' => 1
    	];
    	
    	$this->recordKasModel->update($id,$data);
    	session()->setFlashdata('pesan','Data kas tanggal '.$this->request->getVar('tanggal').' berhasil diupdate.');

    	return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function delete($id){
        $this->recordKasModel->delete($id);
        return redirect()->to(base_url().'/'.$this->appName.'');
    }
}