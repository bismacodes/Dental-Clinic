<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $fillable = [
        'firstname',
        'surname',
        'othername',
        'gender',
        'date_of_birth',
        'phone_no',
        'relative_phone_no',
        'address',
    ];


    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
