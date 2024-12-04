<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table="users"; //! Tablo Adı
    
    //! Tablo Sutunları
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];
}
