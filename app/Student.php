<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['nama', 'nis', 'kelas', 'jenis_kelamin', 'agama', 'alamat', 'picture', 'email', 'user_id', 'role'];

    public function getPicture() 
    { 
        if(!$this->picture) {
            return asset('images/default.png');
        } else {
            return asset('images/' . $this->picture );
        }
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimeStamps();
    }

}

