<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    public $table = 'images';

    public function watches()
    {
        return $this->hasOne(Watches::class);
    }
}
