<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'grading_id',
        'major_id',
        'total_nilai',
    ];

    public function calculationDetails(){
        return $this->hasMany(CalculationDetail::class);
    }
    public function grading(){
        return $this->belongsTo(Grading::class);
    }
    public function major(){
        return $this->belongsTo(Major::class);
    }
}
