<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    // Nama tabel yang digunakan oleh model ini (opsional, jika nama tabel sesuai konvensi tidak perlu didefinisikan)
    protected $table = 'facilities';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'description',
        'image',
    ];


    protected $guarded = [];
}
