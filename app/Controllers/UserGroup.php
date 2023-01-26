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
        echo 'ewe';
    	$data = [
    		'title' => $this->title,
    		'data'=> $this->userGroupModel->getData()
    	];
        return view('admin/'$this->appName.'/index', $data);
    }

    public function create(){
    	$data = [
    		'title' => 'Tambah Site',
    		'action' => base_url().'/site/save',
            'dt' => [],
            'kota' => $this->kotaModel->getKota()
    	];
    	return view('admin/site/edit',$data);
    }

    public function save(){
        if(!$this->validate([
            'site' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'id_kota' => [
                    'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            /*'id_area' => [
                    'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ]*/

        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/site/create')->withInput()->with('validation',$validation);
        }

    	$data = [
    		'id_site' => $this->siteModel->setID(),
    		'site' => $this->request->getVar('site'),
            'id_kota' => $this->request->getVar('id_kota'),
            'id_area' => $this->request->getVar('id_area')
    	];
    	$this->siteModel->insert($data);

    	session()->setFlashdata('pesan','Data Site '.$this->request->getVar('site').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/site/create');
    }

    public function edit($slug){

    	$data = [
    		'title' => 'Edit Site',
    		'action' => base_url().'/site/update',    		
    		'dt'=> $this->siteModel->getData($slug),
            'kota' => $this->kotaModel->getKota()
    	];

    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Area tidak ditemukan');
    	}

    	return view('admin/site/edit', $data);
    }


    public function update(){
        if(!$this->validate([
            'site' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'id_kota' => [
                    'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            /*'id_area' => [
                    'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ]*/

        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/site/edit')->withInput()->with('validation',$validation);
        }

    	$id = $this->request->getVar('id'); 	
    	$data = [
    		'site' => $this->request->getVar('site'),
            'id_kota' => $this->request->getVar('id_kota'),
            'id_area' => $this->request->getVar('id_area')
    	];
    	
    	$this->siteModel->update($id,$data);
    	session()->setFlashdata('pesan','Data Site '.$this->request->getVar('site').' berhasil diupdate.');

    	return redirect()->to(base_url().'/site/edit/'.$id);
    }

    public function delete($id){
        $this->siteModel->delete($id);
        return redirect()->to(base_url().'/site');
    }
}