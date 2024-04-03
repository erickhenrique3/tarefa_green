<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    // One to Many
    protected $fillable = [
        'name',
        'avaliable',
    ];

    public function modules(){
        return $this->hasMany(Module::class);
    }
}