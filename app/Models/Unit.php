<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'unit_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Unit::select('unit.*', 'unit.id as id')
        
		->where('unit.unit_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("unit.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Unit::select('unit.*', 'unit.id as id')
        
		->where('unit.unit_name', 'like', $search)

        ->count();
    }
}
