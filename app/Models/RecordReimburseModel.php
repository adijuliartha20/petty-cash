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

    public function getDataByKlaim($slug,$id_reimburse){
        return $this->select('sum(jumlah) totalBayar')->where('id_klaim',$slug)->where('id_reimburse!=',$id_reimburse)->findAll();
    }

    public function getDataRemburceWithDetail($slug=false){
        return $this->db->table('record_reimburse r')->select('r.id_reimburse, r.id_klaim, r.tanggal, r.jumlah, r.created_at, r.updated_at, r.id_user, s.site, rk.total')->join('record_klaim rk', 'r.id_klaim=rk.id_klaim','left')->join('site s','rk.id_site=s.id_site','left')->get()->getResultArray();
    }
}