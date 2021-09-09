<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Watches
 * @package App\Models
 * @mixin Builder
 */
class Watches extends Model
{
    public $table = 'watches';

    public function getRecomendedWatches($brands)
    {
        $temp = Details::where('signatures', '=', $brands);
        return $temp->watches();
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'watch_id');
    }

    public function details()
    {
        return $this->hasMany(Details::class, 'watch_id');
    }
}
