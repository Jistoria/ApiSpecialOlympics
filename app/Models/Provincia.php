<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $table = 'provincias';
    protected $primaryKey = 'provincia_id';

    protected $fillable = ['provincia'];

    protected $hidden = ['created_at','updated_at'];
}
