<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;


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

   

  public $sortable = ['name','dob','gender',"mobile_no','email','address'"];

   public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

   public function getAgeAttribute()
	{
	    return Carbon::parse($this->attributes['dob'])->age . ' years';
	}

	 public function calculateEmployedFor($date){
    $days = Carbon::parse($date)->diffInDays(Carbon::now());
    $year = floor($days/365);
    $month = floor(($days%365)/30.5);
    $d = floor($days - ($year * 365 + $month * 30.5));
    return $year . ' years ' . $month . ' months ' .$d . ' days';
  }



}
