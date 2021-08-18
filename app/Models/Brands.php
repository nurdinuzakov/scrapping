<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    public $table = 'brands';

    public function details()
    {
        return $this->hasMany(Details::class, 'watch_id', 'id');
    }
}
