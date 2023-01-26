<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserGroupModel;

class UserGroup extends BaseController
{
	protected $userGroupModel;
	public function __construct(){
        $this->userGroupModel = new UserGroupModel();
        $this->appName = 'user-group';
        $this->title = 'User Group';
	}

    public function index(){
    	$data = [
    		'title' => $this->title,
    		'data'=> $this->userGroupModel->getData(),
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
            'group_user' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/'.$this->appName.'/create')->withInput()->with('validation',$validation);
        }

    	$data = [
    		'id_group_user' => $this->userGroupModel->setID(),
    		'group_user' => $this->request->getVar('group_user')
    	];
    	$this->userGroupModel->insert($data);

    	session()->setFlashdata('pesan','Data '.$this->title.' '.$this->request->getVar('group_user').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/'.$this->appName.'/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => 'Edit '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/update',    		
    		'dt'=> $this->userGroupModel->getData($slug)
    	];

    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data '.$this->title.' tidak ditemukan');
    	}

    	return view('admin/'.$this->appName.'/edit', $data);
    }


    public function update(){
        if(!$this->validate([
            'group_user' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
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
    		'group_user' => $this->request->getVar('group_user')
    	];
    	
    	$this->userGroupModel->update($id,$data);
    	session()->setFlashdata('pesan','Data '.$this->title.' '.$this->request->getVar('group_user').' berhasil diupdate.');

    	return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function delete($id){
        $this->userGroupModel->delete($id);
        return redirect()->to(base_url().'/'.$this->appName.'');
    }
}