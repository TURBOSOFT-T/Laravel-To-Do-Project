<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    use HasFactory;
    protected $table= 'projects';

    protected $fillable = ['name', 'user_id'];

    public function tasks() {
        return $this->hasMany(Task::class);
    }
    public function affectationss() {
        return $this->hasMany(Affectation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
