<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Details
 * @package App\Models
 * @mixin Builder
 */
class Details extends Model
{
    public $table = 'details';

    public function watch()
    {
        return $this->belongsTo(Watches::class,'id');
    }

    public function images()
    {
        return $this->hasMany(Images::class,'watch_id');
    }

    public function brands()
    {
        return $this->hasOne(Brands::class);
    }
}
