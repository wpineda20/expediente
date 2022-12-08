<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id',
        'user_id',
        'full_name',
        'family_status_id',
        'profession_id',
        'current_address',
        'municipality_id',
        'vulnerable_area',
        'personal_email',
        'phone',
        'cell_phone',
        'direction_id',
        'subdirection_id',
        'unit_id',
        'nominal_fee',
        'functional_position',
        'immediate_superior',
        'email_institutional',
        'municipality_assigned_id',
        'subjects_approved',
        'dui_file',
        'title_file',
        'employee_status_id'
    ];

     public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function hide()
    {
        return $this->makeHidden([
            'id',
            'family_status_id',
            'profession_id',
            'municipality_id',
            'user_id',
            'direction_id',
            'subdirection_id',
            'unit_id',
            'municipality_assigned_id',
        ]);
    }
}
