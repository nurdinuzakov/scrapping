<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    public function watches()
    {
        return $this->hasOne(Watches::class);
    }
}
