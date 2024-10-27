<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Filterable, HasFactory;
    protected $fillable = [
        'question',
        'a',
        'b',
        'c',
        'd',
        'answer',
        'exam_id'
    ];

    public function exam() {
        return $this->belongsTo(Exam::class);
    }
}
