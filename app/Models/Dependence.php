<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Dependence extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dependence';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'unit_name', 'direction_id', 'deleted_at', 'created_at', 'updated_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Dependence::select('dependence.*', 'direction.*', 'dependence.id as id')
        ->join('direction', 'dependence.direction_id', '=', 'direction.id')

		->where('dependence.unit_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("dependence.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Dependence::select('dependence.*', 'direction.*', 'dependence.id as id')
        ->join('direction', 'dependence.direction_id', '=', 'direction.id')

		->where('dependence.unit_name', 'like', $search)

        ->count();
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class, 'direction_id', 'id');
    }
}
