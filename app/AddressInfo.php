<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressInfo extends Model
{
    //
	protected $fillable = ['id','flatno','building','street','locality','city','country','state','pincode','itrid'];
	 protected $table = 'addressinfo';
	 protected $primaryKey= 'id';
	 const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';
	
	 /* public function user()
    {
        return $this->hasOne(User::class.'');
    }*/
	
	
}
