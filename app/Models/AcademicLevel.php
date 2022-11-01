<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AcademicLevel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'academic_level';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'level_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return AcademicLevel::select('academic_level.*', 'academic_level.id as id')
        
		->where('academic_level.level_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("academic_level.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return AcademicLevel::select('academic_level.*', 'academic_level.id as id')
        
		->where('academic_level.level_name', 'like', $search)

        ->count();
    }
}
