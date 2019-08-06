<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'instruction', 'deadline','status', 'currency', 'budget', 'user_id'
    ]; 

    public function supervisor()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\ProjectTask', 'project_id');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\Employee');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\Employee', 'project_id');
    }
}
