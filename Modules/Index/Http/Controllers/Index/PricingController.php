<?php

namespace Modules\Index\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\BaseVan;

class PricingController extends Controller
{


    public function index(BaseVan $baseVan)
    {
        dd('route working');
    }

}
