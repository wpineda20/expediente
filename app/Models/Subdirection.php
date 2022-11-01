<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Subdirection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subdirection';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'subdirection_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Subdirection::select('subdirection.*', 'subdirection.id as id')
        
		->where('subdirection.subdirection_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("subdirection.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Subdirection::select('subdirection.*', 'subdirection.id as id')
        
		->where('subdirection.subdirection_name', 'like', $search)

        ->count();
    }
}
