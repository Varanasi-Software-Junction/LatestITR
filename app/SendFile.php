<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendFile extends Model
{
    //
	protected $fillable = ['id','filename','url'];
	 protected $table = 'uploadedfiles';
	 protected $primaryKey= 'id';
	 const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';
	
	 /* public function user()
    {
        return $this->hasOne(User::class.'');
    }*/
	
	
}
