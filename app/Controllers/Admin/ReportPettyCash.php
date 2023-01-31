<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RecordKlaimModel;
use App\Models\RecordKasModel;

class ReportPettyCash extends BaseController
{
	protected $recordKlaimModel ;
    protected $recordKasModel ;
	public function __construct(){		
        $this->appName = 'report-petty-cash';
        $this->recordKlaimModel = new RecordKlaimModel();
        $this->recordKasModel = new RecordKasModel();
	}

    public function index()
    {
    	$data = [
    		'title' => 'Report Petty Cash',
            'actGetReport' => base_url().'/'.$this->appName.'/find-report',
            'appName' => 'report'
    	];
        return view('admin/'.$this->appName.'/index', $data);
    }

    public function getReport(){
        if(!$this->validate([
            'mulai' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ],
            'akhir' => [
                        'rules' => 'required',
                        'errors' => [
                                    'required' => '{field} harus diisi'
                        ]
            ]
        ])){
            $validation = \Config\Services::validation(); //dd($validation);
            return redirect()->to(base_url().'/'.$this->appName.'/create')->withInput()->with('validation',$validation);
        }
        //klaim sudah direimbust
        $status = 1;//status sudah terbayarkan
        $mulai  ='';
        $dtmulai = explode('/',$this->request->getVar('mulai'));   
        if(!empty($dtmulai)) $mulai = $dtmulai[2].'-'.$dtmulai[1].'-'.$dtmulai[0].' 00:00:00';
        $akhir  ='';
        $dtakhir = explode('/',$this->request->getVar('akhir'));   
        if(!empty($dtakhir)) $akhir = $dtakhir[2].'-'.$dtakhir[1].'-'.$dtakhir[0].' 00:00:00';      
        $dtKlaim = $this->recordKlaimModel->getListDataKlaim($status,$mulai,$akhir);
        
        $dtKas = $this->recordKasModel->getListDataKas(1,$mulai,$akhir);

        $data=[];//$data['klaim']= $dtKlaim;$data['kas']= $dtKas;
        $data['status'] = 'success';
        $data['report'] = $this->setObjectReportPeriod($dtKlaim,$dtKas);

        return $this->response->setJSON($data);
    }

    private function setObjectReportPeriod($dtKlaim,$dtKas){
        $parent = [];
        foreach ($dtKas as $kk => $dtkk) {
            $child = [
                'idTanggal' =>  strtotime($dtkk['tanggal']),
                'tanggal' => $dtkk['tanggal'],
                'nama_report' => 'Kas Masuk',
                'debit' => $dtkk['jumlah'],
                'kredit' => '',
                'saldo' => '',
                'type_report' => 'kas'
            ];
            array_push($parent, $child);
        }

        foreach($dtKlaim as $key => $dtk){
            $child = [
                'idTanggal' =>  strtotime($dtk['tanggal']),
                'tanggal' => $dtk['tanggal'],
                'site' => $dtk['site'],
                'group_klaim' => $dtk['type'],
                'user' => $dtk['nama'],
                'debit' => '',
                'kredit' => $dtk['total'],
                'saldo' => '',
                'type_report' => 'klaim'
            ];
            array_push($parent, $child);
        }

        usort($parent, function($a, $b){
            return strcmp($a['idTanggal'], $b['idTanggal']);
        });

        //generate saldo
        $saldo = 0;
        $totalDebit = 0;
        $totalKredit = 0;
        foreach ($parent as $key => $pdt) {
            $debit = (int)$pdt['debit'];
            $totalDebit += $debit;
            $kredit = (int)$pdt['kredit'];
            $totalKredit += $kredit;
            $saldo = $saldo + $debit - $kredit;
            $parent[$key]['saldo'] = $saldo;

        }
        $data = [
            'data' => $parent,
            'debit' => $totalDebit,
            'kredit' => $totalKredit,
            'saldo' => $saldo
        ];

        return $data;
    }

}    