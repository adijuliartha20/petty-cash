<?php

namespace App\Models;

use CodeIgniter\Model;

class PettyCashGroupModel extends Model
{
    protected $table      = 'petty_cash_group';
    protected $primaryKey = 'id_petty_cash_group';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_petty_cash_group','petty_cash_group'];

    public function getData($slug=false,$join=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_petty_cash_group'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_petty_cash_group','desc')->first();
    	$no = 1;
    	if(isset($data['id_petty_cash_group'] )) $no = $data['id_petty_cash_group'] + 1;
    	return $no;
    }

}