<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RecordKlaimModel;
use App\Models\RecordKlaimDetailModel;
use App\Models\RecordReimburseModel;
use App\Models\RecordKasModel;

class ReportPettyCashDetail extends BaseController
{
	protected $recordKlaimModel ;
    protected $recordKlaimDetailModel ;
    protected $recordReimburseModel ;
    protected $recordKasModel ;
	public function __construct(){		
        $this->appName = 'report-petty-cash-detail';
        $this->recordKlaimModel = new RecordKlaimModel();
        $this->recordKlaimDetailModel = new RecordKlaimDetailModel();
        $this->recordReimburseModel = new RecordReimburseModel();
        $this->recordKasModel = new RecordKasModel();
	}

    public function index()
    {
    	$data = [
    		'title' => 'Report Petty Cash Detail',
            'actGetReport' => base_url().'/'.$this->appName.'/find-report',
            'appName' => 'report-detail'
    	];
        return view('admin/'.$this->appName.'/index', $data);
    }

    public function getReport(){
        //get data klaim
        $status = 1;
        $mulai  ='';
        $dtmulai = explode('/',$this->request->getVar('mulai'));   
        if(!empty($dtmulai)) $mulai = $dtmulai[2].'-'.$dtmulai[1].'-'.$dtmulai[0].' 00:00:00';
        $akhir  ='';
        $dtakhir = explode('/',$this->request->getVar('akhir'));   
        if(!empty($dtakhir)) $akhir = $dtakhir[2].'-'.$dtakhir[1].'-'.$dtakhir[0].' 00:00:00';
        $dtKlaim = $this->recordKlaimModel->getDataKlaimReport($status,$mulai,$akhir);

        //get data klaim detail
        foreach ($dtKlaim as $key => $dt) {
            if(!isset($dtKlaim[$key]['data'])) $dtKlaim[$key]['data'] = [];
            $detail = $this->recordKlaimDetailModel->getData($dt['id_klaim']);
            $dtKlaim[$key]['data'] = $detail;
        }


        $data = [];
        $data['status'] = 'success';
        $data['reports'] = $dtKlaim;
        return $this->response->setJSON($data);
    }

}    