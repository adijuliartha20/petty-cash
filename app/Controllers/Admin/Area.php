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

        $this->appName = 'area';
	}

    public function index()
    {
        //$this->areaModel->getArea(false,true));
    	$data = [
    		'title' => 'Area',
    		'area'=> $this->areaModel->getArea(false,true)
    	];


        return view('admin/'.$this->appName.'/index', $data);
    }

    public function create(){
    	$data = [
    		'title' => 'Tambah Area',
    		'action' => base_url().'/area/save',
            'dt' => [],
            'kota' => $this->kotaModel->getKota()
    	];
    	return view('admin/'.$this->appName.'/edit',$data);

    }

    public function save(){
        if(!$this->validate([
            'id_kota' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'area' => [
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
    		'id_area' => $this->areaModel->setID(),
    		'area' => $this->request->getVar('area'),
            'id_kota' => $this->request->getVar('id_kota')
    	];
    	$this->areaModel->insert($data);

    	session()->setFlashdata('pesan','Data Area '.$this->request->getVar('area').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/'.$this->appName.'/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => 'Edit Area',
    		'action' => base_url().'/'.$this->appName.'/update',    		
    		'dt'=> $this->areaModel->getArea($slug),
            'kota' => $this->kotaModel->getKota()
    	];

    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Area tidak ditemukan');
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
            'id_kota' => [
                        'rules' => 'required|alpha_numeric',
                        'errors' => [
                                    'required' => '{field} harus diisi',
                                    'alpha_numeric' => 'format {field} salah'
                        ]
            ],
            'area' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ]
        ])){
            $validation = \Config\Services::validation();            
            return redirect()->to(base_url().'/'.$this->appName.'/create')->withInput()->with('validation',$validation);
        }

    	$id = $this->request->getVar('id'); 	
    	$data = [
    		'area' => $this->request->getVar('area'),
            'id_kota' => $this->request->getVar('id_kota'),
    	];
    	
    	$this->areaModel->update($id,$data);
    	session()->setFlashdata('pesan','Data Area '.$this->request->getVar('area').' berhasil diupdate.');

    	return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function delete($id){
        $this->areaModel->delete($id);
        return redirect()->to(base_url().'/'.$this->appName);
    }

    public function getAreas($slug){
        return $this->response->setJSON($this->areaModel->getListArea($slug));
    }
}

