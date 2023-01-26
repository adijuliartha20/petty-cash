<?php

namespace App\Models;

use CodeIgniter\Model;

class UserGroupModel extends Model
{
    protected $table      = 'user_group';
    protected $primaryKey = 'id_group_user';
    protected $useTimestamps = true;

    //tambahkan property disini untuk save
    protected $allowedFields = ['id_group_user','group_user'];

    public function getData($slug=false,$join=false){
		if($slug==false){
			return $this->findAll();
		}
		return $this->where(['id_group_user'=>$slug])->first();
    }

    public function setID(){
    	$data = $this->orderBy('id_group_user','desc')->first();
    	$no = 1;
    	if(isset($data['id_group_user'] )) $no = $data['id_group_user'] + 1;
    	return $no;
    }

}