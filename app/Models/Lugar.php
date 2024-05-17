<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;
    protected $table = 'lugares';

    protected $primaryKey = 'lugar_id';

    protected $fillable = ['nombre', 'descripcion','url_images'];

    protected $hidden = ['created_at', 'updated_at'];

protected $casts = [
        'url_images' => 'array',
    ];

    public function actividadDeportiva()
    {
        return $this->belongsToMany(ActividadDeportiva::class);
    }
}
