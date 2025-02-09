<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'calculation_id',
        'detail_grading_id',
        'nilai_profil_standard',
        'gap_awal',
        'gap_konversi',
    ];


    public function calculation(){
        return $this->belongsTo(Calculation::class);
    }
    public function detailGrading(){
        return $this->belongsTo(DetailGrading::class);
    }
}
