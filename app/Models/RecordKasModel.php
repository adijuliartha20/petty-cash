<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordKasModel extends Model
{
    protected $table      = 'record_kas';
    protected $primaryKey = 'id_kas';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_kas','tanggal','jumlah','sumber','bukti_kas','id_user'];

    public function getData($slug=false,$join=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_kas'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_kas','desc')->first();
    	$no = 1;
    	if(isset($data['id_kas'] )) $no = $data['id_kas'] + 1;
    	return $no;
    }

}