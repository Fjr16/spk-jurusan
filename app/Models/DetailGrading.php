<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGrading extends Model
{
    use HasFactory;

    protected $fillable = [
        'grading_id',
        'criteria_id',
        'sub_criteria_id',
        'nilai_profil',
    ];


    public function grading(){
        return $this->belongsTo(Grading::class);
    }
    public function criteria(){
        return $this->belongsTo(Criteria::class);
    }
    public function subCriteria(){
        return $this->belongsTo(SubCriteria::class);
    }
}
