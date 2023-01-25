<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table      = 'kota';
    protected $primaryKey = 'id_kota';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_kota','kota'];

    public function getKota($slug=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_kota'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_kota','desc')->first();
    	$no = 1;
    	if(isset($data['id_kota'] )) $no = $data['id_kota'] + 1;
    	return $no;
    }

}