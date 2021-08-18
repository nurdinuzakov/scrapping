<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Watches extends Model
{
    public $table = 'watches';

    public function images()
    {
        return $this->hasMany(Images::class, 'model');
    }

    public function details()
    {
        return $this->hasOne(Details::class, 'id');
    }
}
