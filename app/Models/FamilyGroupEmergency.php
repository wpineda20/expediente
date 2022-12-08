<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FamilyGroupEmergency extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'family_group_emergency';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id',
        'emergency_full_name',
        'emergency_phone',
        'emergency_cell_phone',
        'emergency_address',
        'kinship_id',
        'employee_id',
    ];

     public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;
}
