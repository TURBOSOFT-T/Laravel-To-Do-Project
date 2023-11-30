<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    use HasFactory;
    protected $table= 'affectations';

    protected $fillable = ['name', 'user_id','project_id', 'task_id'];

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
