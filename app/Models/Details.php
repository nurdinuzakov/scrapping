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

    public function watches()
    {
        return $this->hasOne(Watches::class);
    }

    public function brands()
    {
        return $this->hasOne(Brands::class);
    }
}
