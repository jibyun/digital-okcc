<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable; // This contract allows objects to be converted to an HTTP response instance when returned from a controller or route closure.
use Maatwebsite\Excel\Concerns\FromCollection; // Use a Laravel Collection to populate the export.
use Maatwebsite\Excel\Concerns\Exportable; // Add download/store abilities right on the export class itself.
use Maatwebsite\Excel\Concerns\FromQuery; // Use an Eloquent query to populate the export.
use Illuminate\Support\Facades\DB;

use App\Code;

class CodesExport implements FromCollection, Responsable {
    use Exportable;

    private $fileName = 'codes.xlsx';

    public function collection() {
        return Code::get(['id', 'txt', 'kor_txt', 'enabled', 'memo', 'code_category_id']);
    }
}