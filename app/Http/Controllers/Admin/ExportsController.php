<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Exports\CategoriesExport;

class ExportsController extends Controller {

    public function exportCategories() {
        return new CategoriesExport();
    }
}
