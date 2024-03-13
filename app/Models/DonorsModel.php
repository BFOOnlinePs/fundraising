<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorsModel extends Model
{
    use HasFactory;

    protected $table = 'donors';
    protected $fillable = [
        'donors_id',
        'donors_arabic_name',
        'donors_english_name',
        'gender',
        'donors_regions_id',
        'donors_donors_categories_id',
        'donors_is_partner',
        'fax',
        'address',
        'website',
        'work_field',
        'gender',
        'phone',
        'email',
        'notes',
    ];
    protected $primaryKey = 'donors_id';
}
