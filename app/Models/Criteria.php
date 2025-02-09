<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_type_id',
        'code',
        'name',
    ];

    public function criteriaType(){
        return $this->belongsTo(CriteriaType::class);
    }
    public function subCriterias(){
        return $this->hasMany(SubCriteria::class);
    }
}
