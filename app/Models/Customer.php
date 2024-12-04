<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table="customer"; //! Tablo Adı
    
    //! Tablo Sutunları
    protected $fillable = [
        'name',
        'surname',
        'email',
        'company',
    ];
}
