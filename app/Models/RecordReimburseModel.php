<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordReimburseModel extends Model
{
    protected $table      = 'record_reimburse';
    protected $primaryKey = 'id_reimburse';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_reimburse','id_klaim','tanggal','jumlah','bukti_reimburse','id_user'];

    public function getData($slug=false,$join=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_reimburse'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_reimburse','desc')->first();
    	$no = 1;
    	if(isset($data['id_reimburse'] )) $no = $data['id_reimburse'] + 1;
    	return $no;
    }
}