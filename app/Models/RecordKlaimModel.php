<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordKlaimModel extends Model
{
    protected $table      = 'record_klaim';
    protected $primaryKey = 'id_klaim';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_klaim','tanggal','total','id_site','id_petty_cash_group','id_user_petty_cash','id_user','status','bukti_klaim'];

    public function getData($slug=false,$join=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_klaim'=>$slug])->first();
    }

    public function getDataKlaim(){
        return $this->where('status',0)->findAll();
    }

    public function setID(){
    	$data = $this->orderBy('id_klaim','desc')->first();
    	$no = 1;
    	if(isset($data['id_klaim'] )) $no = $data['id_klaim'] + 1;
    	return $no;
    }

}