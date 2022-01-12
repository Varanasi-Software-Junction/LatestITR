<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
	protected $fillable = ['id','bankname','ifsccode','accountno','accounttype','userid','message','itrid'];
	 protected $table = 'bankdetails';
	 protected $primaryKey= 'id';
	 const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';	
}