<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AcademicData extends Model
{
    use HasFactory;

    protected $table = 'academic_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'employee_id',
        'academic_level_id',
        'education_center',
        'year',
        'obtained_title',
    ];

    public $timestamps = true;
}
