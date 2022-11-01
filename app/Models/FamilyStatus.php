<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FamilyStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'family_status';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'family_status_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return FamilyStatus::select('family_status.*', 'family_status.id as id')
        
		->where('family_status.family_status_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("family_status.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return FamilyStatus::select('family_status.*', 'family_status.id as id')
        
		->where('family_status.family_status_name', 'like', $search)

        ->count();
    }
}
