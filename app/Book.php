<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
	protected $fillable = ['bookname','price','platform'];
	 protected $table = 'books';
	 protected $primaryKey= 'id';
	 const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';
}
