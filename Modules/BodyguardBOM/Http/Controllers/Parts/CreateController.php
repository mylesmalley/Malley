<?php

namespace Modules\BodyguardBOM\Http\Controllers\Parts;

use Modules\BodyguardBOM\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{

    public function create()
    {
        return response()->view('bodyguardbom::parts.create');


        /*
         $nodes = Category::get()->toTree();

$traverse = function ($categories, $prefix = '-') use (&$traverse) {
foreach ($categories as $category) {
echo PHP_EOL.$prefix.' '.$category->name;

$traverse($category->children, $prefix.'-');
}
};

$traverse($nodes);
         */
    }



    public function store()
    {

    }
}


