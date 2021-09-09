<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function index($watches)
    {
        $myArray = [
            ['id' => 1, 'title' => 'Laravel 6 CRUD'],
            ['id' => 2, 'title' => 'Laravel 6 Ajax CRUD'],
            ['id' => 3, 'title' => 'Laravel 6 CORS Middleware'],
            ['id' => 4, 'title' => 'Laravel 6 Autocomplete'],
            ['id' => 5, 'title' => 'Laravel 6 Image Upload'],
            ['id' => 6, 'title' => 'Laravel 6 Ajax Request'],
            ['id' => 7, 'title' => 'Laravel 6 Multiple Image Upload'],
            ['id' => 8, 'title' => 'Laravel 6 Ckeditor'],
            ['id' => 9, 'title' => 'Laravel 6 Rest API'],
            ['id' => 10, 'title' => 'Laravel 6 Pagination'],
        ];

        $myCollectionObj = collect($watches);

        $data = $this->paginate($myCollectionObj);

        return view('paginate', compact('data'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
