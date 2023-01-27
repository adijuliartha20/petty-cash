<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RecordReimburseModel;
use App\Models\RecordKlaimModel;

class RecordReimburse extends BaseController
{
	protected $recordReimbustModel;
    protected $recordKlaimModel;
	public function __construct(){
        $this->recordReimburseModel = new RecordReimburseModel();
        $this->recordKlaimModel = new RecordKlaimModel();
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
    	$data = [
    		'title' => 'Tambah '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/save',
            'dt' => [],
            'klaim'=> $this->recordKlaimModel->getDataKlaim()
    	];
    	return view('admin/'.$this->appName.'/edit',$data);
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
    		'title' => 'Edit '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/update',    		
    		'dt'=> $this->recordReimburseModel->getData($slug),
            'klaim'=> $this->recordKlaimModel->getDataKlaim()
    	];
    	//dd($data['dt']);
    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data '.$this->title.' tidak ditemukan');
    	}

    	return view('admin/'.$this->appName.'/edit', $data);
    }


    public function update(){
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
            ],
            'bukti_reimburse' => [
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
        $this->recordReimburseModel->delete($id);
        return redirect()->to(base_url().'/'.$this->appName.'');
    }
}