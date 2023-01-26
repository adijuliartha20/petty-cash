<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserPettyCashModel;
use App\Models\UserGroupModel;

class UserPettyCash extends BaseController
{
	protected $userPettyCashModel;
	public function __construct(){
        $this->userPettyCashModel = new UserPettyCashModel();
        $this->userGroupModel = new UserGroupModel();
        $this->appName = 'user-petty-cash';
        $this->title = 'User Petty Cash';
	}

    public function index(){
    	$data = [
    		'title' => $this->title,
    		'data'=> $this->userPettyCashModel->getData(),
            'app'=> $this->appName,
            'group' => $this->userGroupModel->getData()
    	];
        return view('admin/'.$this->appName.'/index', $data);
    }

    public function create(){
    	$data = [
    		'title' => 'Tambah '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/save',
            'dt' => [],
            'group' => $this->userGroupModel->getData()
    	];
    	return view('admin/'.$this->appName.'/edit',$data);
    }

    public function save(){
        if(!$this->validate([
            'nama' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'ktp' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'telpon' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'email' => [
                        'rules' => 'required|valid_email',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'valid_email' => 'Please check the Email field. It does not appear to be valid.'
                        ]
            ],
            'id_group_user' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/'.$this->appName.'/create')->withInput()->with('validation',$validation);
        }

    	$data = [
    		'id_user_petty_cash' => $this->userPettyCashModel->setID(),
    		'nama' => $this->request->getVar('nama'),
    		'ktp' => $this->request->getVar('ktp'),
    		'telpon' => $this->request->getVar('telpon'),
    		'email' => $this->request->getVar('email'),
    		'alamat' => $this->request->getVar('alamat'),
    		'id_group_user' => $this->request->getVar('id_group_user')
    	];
    	$this->userPettyCashModel->insert($data);

    	session()->setFlashdata('pesan','Data '.$this->request->getVar('nama').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/'.$this->appName.'/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => 'Edit '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/update',    		
    		'dt'=> $this->userPettyCashModel->getData($slug),
            'group' => $this->userGroupModel->getData()
    	];
    	//dd($data['dt']);
    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data '.$this->title.' tidak ditemukan');
    	}

    	return view('admin/'.$this->appName.'/edit', $data);
    }


    public function update(){
        if(!$this->validate([
            'nama' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'ktp' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'telpon' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'email' => [
                        'rules' => 'required|valid_email',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'valid_email' => 'Please check the Email field. It does not appear to be valid.'
                        ]
            ],
            'id_group_user' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'id' => [
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

    	$id = $this->request->getVar('id'); 	
    	$data = [
    		'nama' => $this->request->getVar('nama'),
    		'ktp' => $this->request->getVar('ktp'),
    		'telpon' => $this->request->getVar('telpon'),
    		'email' => $this->request->getVar('email'),
    		'alamat' => $this->request->getVar('alamat'),
    		'id_group_user' => $this->request->getVar('id_group_user')
    	];
    	
    	$this->userPettyCashModel->update($id,$data);
    	session()->setFlashdata('pesan','Data '.$this->title.' '.$this->request->getVar('nama').' berhasil diupdate.');

    	return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function delete($id){
        $this->userPettyCashModel->delete($id);
        return redirect()->to(base_url().'/'.$this->appName.'');
    }
}