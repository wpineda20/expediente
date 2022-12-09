<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'direction';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'direction_name', 'deleted_at', 'created_at', 'updated_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Direction::select('direction.*', 'direction.id as id')

            ->where('direction.direction_name', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("direction.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return Direction::select('direction.*', 'direction.id as id')

            ->where('direction.direction_name', 'like', $search)

            ->count();
    }

    public function dependence()
    {
        return $this->hasMany(Direction::class);
    }
}
