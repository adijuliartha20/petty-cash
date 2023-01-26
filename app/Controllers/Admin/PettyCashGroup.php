<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PettyCashGroupModel;

class PettyCashGroup extends BaseController
{
	protected $pettyCashGroupModel;
	public function __construct(){
        $this->PettyCashGroupModel = new PettyCashGroupModel();
        $this->appName = 'petty-cash-group';
        $this->title = 'Petty Cash Group';
	}

    public function index(){
    	$data = [
    		'title' => $this->title,
    		'data'=> $this->PettyCashGroupModel->getData(),
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
            'petty_cash_group' => [
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
    		'id_petty_cash_group' => $this->PettyCashGroupModel->setID(),
    		'petty_cash_group' => $this->request->getVar('petty_cash_group')
    	];
    	$this->PettyCashGroupModel->insert($data);

    	session()->setFlashdata('pesan','Data '.$this->request->getVar('petty_cash_group').' '.$this->request->getVar('group_user').' berhasil ditambahkan.');

    	return redirect()->to(base_url().'/'.$this->appName.'/create');
    }

    public function edit($slug){
    	$data = [
    		'title' => 'Edit '.$this->title,
    		'action' => base_url().'/'.$this->appName.'/update',    		
    		'dt'=> $this->PettyCashGroupModel->getData($slug)
    	];

    	if(empty($data['dt'])){
    		throw new \CodeIgniter\Exceptions\PageNotFoundException('Data '.$this->title.' tidak ditemukan');
    	}

    	return view('admin/'.$this->appName.'/edit', $data);
    }


    public function update(){
        if(!$this->validate([
            'petty_cash_group' => [
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
    		'petty_cash_group' => $this->request->getVar('petty_cash_group')
    	];
    	
    	$this->PettyCashGroupModel->update($id,$data);
    	session()->setFlashdata('pesan','Data '.$this->title.' '.$this->request->getVar('group_user').' berhasil diupdate.');

    	return redirect()->to(base_url().'/'.$this->appName.'/edit/'.$id);
    }

    public function delete($id){
        $this->PettyCashGroupModel->delete($id);
        return redirect()->to(base_url().'/'.$this->appName.'');
    }
}