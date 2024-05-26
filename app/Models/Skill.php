<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'image'];

    public function projects() {
        return $this->hasMany(Project::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($skill) {
            // Set the user_id value automatically when creating a new Skill record
            $skill->user_id = auth()->user()->id;
        });
    }
}
