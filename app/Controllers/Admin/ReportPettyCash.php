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
    		'title' => 'Report Petty Cash'
    		
    	];
        return view('admin/'.$this->appName.'/index', $data);
    }
}    