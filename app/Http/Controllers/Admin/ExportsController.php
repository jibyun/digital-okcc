<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Exports\CategoriesExport;
use App\Exports\CodesExport;

class ExportsController extends Controller {

    public function exportCategories() {
        return new CategoriesExport();
    }

    public function exportCodes() {
        return new CodesExport();
    }
}
