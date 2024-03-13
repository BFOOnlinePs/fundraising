<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorsCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'donors_categories';
    protected $fillable = [
        'donors_categories_id',
        'donors_categories_arabic_name'
    ];
    protected $primaryKey = 'donors_categories_id';
}
