<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorije extends Model
{
    use HasFactory;

    protected $table = 'kategorije';

    public function artikli(){
        return $this->hasMany(Artikli::class, 'id_kategorija');
    }
}
