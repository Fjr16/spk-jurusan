<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nisn',
        'tgl_lahir',
        'alamat',
    ];

    public function grading(){
        return $this->hasOne(Grading::class);
    }
}
