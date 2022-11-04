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
        'full_name',
        'family_status_id',
        'profession_id',
        'current_address',
        'municipality_id',
        'vulnerable_area',
        'personal_email',
        'phone',
        'cell_phone',
        'dui_file',
        'user_id',
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
        ]);
    }
}
