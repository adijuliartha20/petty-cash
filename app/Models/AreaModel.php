<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table      = 'area';
    protected $primaryKey = 'id_area';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_area','area','id_kota'];

    public function getArea($slug=false,$withKota=false){
		if($slug==false){
            if($withKota){
                return $this->db->table('area a')->select('a.id_area,a.area,a.created_at,a.updated_at,k.kota')->join('kota k','k.id_kota=a.id_kota')->get()->getResultArray();
            }
			return $this->findAll();
		}
		return $this->where(['id_area'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_area','desc')->first();
    	$no = 1;
    	if(isset($data['id_area'] )) $no = $data['id_area'] + 1;
    	return $no;
    }

    public function getListArea($slug){
        return $this->select('id_area,area')->where('id_kota',$slug)->findAll();
    }

}