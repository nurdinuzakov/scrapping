<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Watches extends Model
{
    public $table = 'watches';

    public function images()
    {
        return $this->hasMany(Images::class, 'watch_id');
    }

    public function details()
    {
        return $this->hasMany(Details::class, 'watch_id');
    }
}
