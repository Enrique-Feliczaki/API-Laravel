<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explorador extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'idade', 'latitude', 'longitude'];
    protected $table = 'exploradores';

    public function itens()
    {
        return $this->hasMany(Item::class);
    }
}
