<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personalform extends Model
{
    use HasFactory;
    protected $table = 'personalforms';
    protected $guarded=[];
    // protected $fillable=['firstname','lastname','phonenumber','emailaddress','country','language','username','emailaddress1','password','confirmpassword','schoolname','boardname','coursename','universityname','experience1','position1','experience2','position2','experience3','position3'];
}
