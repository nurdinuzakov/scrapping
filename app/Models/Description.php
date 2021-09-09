<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    public $table = 'description';

    public function watch()
    {
        return $this->belongsTo(Watches::class, 'id');
    }
}
