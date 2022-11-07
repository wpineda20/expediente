<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyGroup extends Model
{
     use HasFactory;

    protected $table = 'family_group';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'full_name',
        'kinship_id',
        'date_birth',
        'employee_id',
    ];

    public $timestamps = true;
}
