<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'valor', 'latitude', 'longitude'];
    protected $table = 'itens';
    public function explorador()
    {
        return $this->belongsTo(Explorador::class);
    }
}
