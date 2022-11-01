<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Kinship extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kinship';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'kinship_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Kinship::select('kinship.*', 'kinship.id as id')
        
		->where('kinship.kinship_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("kinship.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Kinship::select('kinship.*', 'kinship.id as id')
        
		->where('kinship.kinship_name', 'like', $search)

        ->count();
    }
}
