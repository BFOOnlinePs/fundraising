<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
    use HasFactory;

    protected $table = 'regions';
    protected $fillable = [
        'regions_id',
        'regions_name',
    ];
    protected $primaryKey = 'regions_id';
}
