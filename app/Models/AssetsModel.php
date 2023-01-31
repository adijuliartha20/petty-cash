<?php

namespace App\Models;

use CodeIgniter\Model;

class AssetsModel extends Model
{
    protected $table      = 'assets';
    protected $primaryKey = 'id_asset';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_asset','nama','id_data','tipe','id_user'];

    public function getData($slug=false,$join=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_asset'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_asset','desc')->first();
    	$no = 1;
    	if(isset($data['id_asset'] )) $no = $data['id_asset'] + 1;
    	return $no;
    }

    public function getDataByPost($slug,$type=''){
        return $this->select('id_asset,nama')->where('id_data',$slug)->where('tipe',$type)->findAll();        
    }

}