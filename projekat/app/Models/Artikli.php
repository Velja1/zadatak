<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikli extends Model
{
    use HasFactory;

    protected $table = 'artikli';

    public function kategorije(){
        return $this->belongsTo(Kategorije::class,'id_kategorija');
    }

}
