<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherSourceInc extends Model
{
	protected $fillable = ['id','interestinc','interestonrd','otherinc','itrid'];
	 protected $table = 'othersourceinc';
	 protected $primaryKey= 'id';
	 const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';	
}