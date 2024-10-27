<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use Filterable, HasFactory;
    protected $fillable = [
        'l_name',
        'f_name',
        'email',
        'phone',
        'gender',
        'religion',
        'olevel',
        'dob',
        'user_id',
        'admission_number',
        'level',
        // todo replace in controllers
        'department_id'
    ];

    public function user() {
        return $this->BelongsTo(User::class,);
    }

    /**
     * Get all of the results for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(Result::class, 'student_id', 'id');
    }

    /**
     * Get the department that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
