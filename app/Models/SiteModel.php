<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteModel extends Model
{
    protected $table      = 'site';
    protected $primaryKey = 'id_site';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_site','site','id_area','id_kota','alamat'];

    public function getData($slug=false,$join=false){
		if($slug==false){
            if($join){
               return $this->db->table('site s')->select('s.id_site,s.site, a.area, k.kota,s.created_at, s.updated_at')->join('kota k','k.id_kota=s.id_kota')->join('area a','a.id_area=s.id_area')->get()->getResultArray();
            }
			return $this->findAll();
		}
		return $this->where(['id_site'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_site','desc')->first();
    	$no = 1;
    	if(isset($data['id_site'] )) $no = $data['id_site'] + 1;
    	return $no;
    }

}