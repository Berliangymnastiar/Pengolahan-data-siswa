<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapels';
    protected $fillable = ['kode', 'nama', 'semester'];

    public function student() 
    {
        return $this->belongsToMany(Student::class)->withPivot(['nilai']);
    }
}
