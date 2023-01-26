<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPettyCashModel extends Model
{
    protected $table      = 'user_petty_cash';
    protected $primaryKey = 'id_user_petty_cash';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_user_petty_cash','nama','ktp','telpon','email','alamat','id_group_user'];

    public function getData($slug=false,$join=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_user_petty_cash'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_user_petty_cash','desc')->first();
    	$no = 1;
    	if(isset($data['id_user_petty_cash'] )) $no = $data['id_user_petty_cash'] + 1;
    	return $no;
    }

}