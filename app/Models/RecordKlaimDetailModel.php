<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordKlaimDetailModel extends Model
{
    protected $table      = 'record_klaim_detail';
    protected $primaryKey = 'id_klaim_detail';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_klaim_detail','id_klaim','nama','harga','jumlah'];

    public function getData($slug=false,$join=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_klaim'=>$slug])->findAll();
    }

    public function setID(){
    	$data = $this->orderBy('id_klaim_detail','desc')->first();
    	$no = 1;
    	if(isset($data['id_klaim_detail'] )) $no = $data['id_klaim_detail'] + 1;
    	return $no;
    }

}