<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorProfileStandard extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',
        'criteria_id',
        'sub_criteria_id',
        'value_of_sub_criteria',
    ];

    public function major(){
        return $this->belongsTo(Major::class);
    }
    public function criteria(){
        return $this->belongsTo(Criteria::class);
    }
    public function subCriteria(){
        return $this->belongsTo(SubCriteria::class);
    }
}
