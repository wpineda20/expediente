<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

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
    ];

    public $timestamps = false;

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
