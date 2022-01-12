<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    //
	protected $fillable = ['id','financialyear','firstname','lastname','mobileno','dob','emailid','panno','aadharno','userid','sourceofincome','platform',];
	 protected $table = 'personalinfo';
	 protected $primaryKey= 'id';
	 const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';
	
	 /* public function user()
    {
        return $this->hasOne(User::class.'');
    }*/
	
	
}
