<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ReportPettyCash extends BaseController
{
	
	public function __construct(){		
        $this->appName = 'report-petty-cash';
	}

    public function index()
    {
    	$data = [
    		'title' => 'Report Petty Cash',
            'actGetReport' => base_url().'/'.$this->appName.'/find-report',
    		
    	];
        return view('admin/'.$this->appName.'/index', $data);
    }

    public function getReport(){
        $data = $this->request->getVar();

        return $this->response->setJSON($data);
    }

}    