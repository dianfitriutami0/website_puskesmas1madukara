<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
    protected $table = 'welcomes';

    protected $fillable = ['nama_lengkap', 'gelar', 'jabatan', 'foto', 'sambutan'];
}