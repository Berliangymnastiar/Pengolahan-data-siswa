<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['nama', 'nis', 'kelas', 'jenis_kelamin', 'agama', 'alamat'];
}
