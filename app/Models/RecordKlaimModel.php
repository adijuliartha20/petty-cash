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
        return $this->db->table('record_klaim k')->select('k.id_klaim, k.tanggal, s.site, p.petty_cash_group type, u.nama')->join('site s','k.id_site=s.id_site')->join('petty_cash_group p','k.id_petty_cash_group=p.id_petty_cash_group')->join('user_petty_cash u','k.id_user_petty_cash=u.id_user_petty_cash')->where('status',0)->get()->getResultArray();
    }

    public function setID(){
    	$data = $this->orderBy('id_klaim','desc')->first();
    	$no = 1;
    	if(isset($data['id_klaim'] )) $no = $data['id_klaim'] + 1;
    	return $no;
    }

}