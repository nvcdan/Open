<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Notifiable;
    /**
      * The database table used by the model.
      *
      * @var string
      */
     protected $table = 'employees';
 
         /**
      * The attributes that are not mass assignable.
      *
      * @var array
      */
     protected $guarded = [
       'id',
     ];
 
 
     /**
      * Fillable fields for an Employee.
      *
      * @var array
      */
     protected $fillable = [
         'user_id',
         'project_id',
         'job_title',
         'responsability',
     ];
  
     /**
      * 
      *
      * @return mixed
      */
     
 
     public function project()
     {
         return $this->belongsTo('App\Models\Project');
     }
 
     /**
      * An Employee belongs to an user.
      *
      * @return mixed
      */
 
     public function user()
     {
         return $this->belongsTo('App\Models\User');
     }
 
 }