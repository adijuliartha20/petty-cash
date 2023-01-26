<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KotaModel;

class Kota extends BaseController
{
	protected $kotaModel;
	public function __construct(){
		$this->kotaModel = new KotaModel();
	}

    public function index()
    {
    	$data = [
    		'title' => 'Kota',
    		'kota'=> $this->kotaModel->getKota(),
    		
    	];
        return view('admin/kota/index', $data);
    }

    public function create(){
    	$data = [
    		'title' => 'Tambah Kota',
    		'action' => base_url().'/kota/save'
    	];
    	return view('admin/kota/edit',$data);

    }

    public function save(){
    	$slug = url_title($this->request->getVar('kota'),'-',true);
    	$data = [
    		'id_kota' => $this->kotaModel->setID(),
    		'kota' => $this->request->getVar('kota')
    	];
    	$this->kotaModel->insert($data);

    	session()->setFlashdata('pesan','Data kota '.$this->request->getVar('kota').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/kota/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => 'Edit Kota',
    		'action' => base_url().'/kota/update',    		
    		'kota'=> $this->kotaModel->getKota($slug),
    	];

    	//print_r($data['kota']);

    	if(empty($data['kota'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data kota tidak ditemukan');
    	}

    	return view('admin/kota/edit', $data);
    }


    public function update(){  
    	$id = $this->request->getVar('id'); 	
    	$data = [
    		'kota' => $this->request->getVar('kota')
    	];
    	
    	$this->kotaModel->update($id,$data);
    	session()->setFlashdata('pesan','Data kota '.$this->request->getVar('kota').' berhasil diupdate.');

    	return redirect()->to(base_url().'/kota/edit/'.$id);
    }

    public function delete($id){
        $this->kotaModel->delete($id);
        return redirect()->to(base_url().'/kota');
    }
}

