<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profession';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'profession_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Profession::select('profession.*', 'profession.id as id')
        
		->where('profession.profession_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("profession.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Profession::select('profession.*', 'profession.id as id')
        
		->where('profession.profession_name', 'like', $search)

        ->count();
    }
}
