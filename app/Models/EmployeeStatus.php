<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee_status';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'status_name', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return EmployeeStatus::select('employee_status.*', 'employee_status.id as id')
        
		->where('employee_status.status_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("employee_status.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return EmployeeStatus::select('employee_status.*', 'employee_status.id as id')
        
		->where('employee_status.status_name', 'like', $search)

        ->count();
    }
}
