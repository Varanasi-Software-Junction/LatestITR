<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpInfo extends Model
{
    //
	protected $fillable = ['empname','empemail','emppass','empadrs'];
	protected $table = 'jobinfo';
	protected $primaryKey= 'id';
	const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';
	 
	protected $hidden = [
        'password',
    ];
}
