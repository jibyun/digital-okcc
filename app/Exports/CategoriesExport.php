<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable; // This contract allows objects to be converted to an HTTP response instance when returned from a controller or route closure.
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use App\Code_Category;

class CategoriesExport implements FromCollection, Responsable {
    use Exportable;

    private $fileName = 'categories.xlsx';

    public function collection() {
        return Code_Category::get(['id', 'txt', 'kor_txt', 'enabled', 'memo', 'fieldName']);
    }
}