<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{

     protected $table = 'mapels';
     protected $fillable = [
        'mandiri_id',
        'pertanyaan',
        'a',
        'b',
        'c',
        'd',
    ];

    public function mandiri()
    {
        return $this->belongsTo(Mandiri::class);
    }
}
