<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
     protected $fillable = [
   	"name",
   	"dob",
   	"gender",
   	"mobile_no",
   	"email",
   	"address",
   	"department",
   	"join_date",
   	"about",
  
   ];

   public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

   public function getAgeAttribute()
	{
	    return Carbon::parse($this->attributes['dob'])->age;
	}

	 public function getAzAttribute()
	{
	    return Carbon::parse($this->attributes['join_date'])->az;
	}

}
