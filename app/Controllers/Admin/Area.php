<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AreaModel;
use App\Models\KotaModel;

class Area extends BaseController
{
	protected $areaModel;
	public function __construct(){
		$this->areaModel = new AreaModel();
        $this->kotaModel = new KotaModel();
	}

    public function index()
    {
        //$this->areaModel->getArea(false,true));
    	$data = [
    		'title' => 'Area',
    		'area'=> $this->areaModel->getArea(false,true)
    	];


        return view('admin/area/index', $data);
    }

    public function create(){
    	$data = [
    		'title' => 'Tambah Area',
    		'action' => base_url().'/area/save',
            'dt' => [],
            'kota' => $this->kotaModel->getKota()
    	];
    	return view('admin/area/edit',$data);

    }

    public function save(){
    	$data = [
    		'id_area' => $this->areaModel->setID(),
    		'area' => $this->request->getVar('area'),
            'id_kota' => $this->request->getVar('id_kota')
    	];
    	$this->areaModel->insert($data);

    	session()->setFlashdata('pesan','Data Area '.$this->request->getVar('area').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/area/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => 'Edit Area',
    		'action' => base_url().'/area/update',    		
    		'dt'=> $this->areaModel->getData($slug),
            'kota' => $this->kotaModel->getKota()
    	];

    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Area tidak ditemukan');
    	}

    	return view('admin/area/edit', $data);
    }


    public function update(){  
    	$id = $this->request->getVar('id'); 	
    	$data = [
    		'area' => $this->request->getVar('area'),
            'id_kota' => $this->request->getVar('id_kota'),
    	];
    	
    	$this->areaModel->update($id,$data);
    	session()->setFlashdata('pesan','Data Area '.$this->request->getVar('area').' berhasil diupdate.');

    	return redirect()->to(base_url().'/area/edit/'.$id);
    }

    public function delete($id){
        $this->areaModel->delete($id);
        return redirect()->to(base_url().'/area');
    }
}

