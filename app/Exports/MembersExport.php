<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable; // This contract allows objects to be converted to an HTTP response instance when returned from a controller or route closure.
use Maatwebsite\Excel\Concerns\FromCollection; // Use a Laravel Collection to populate the export.
use Maatwebsite\Excel\Concerns\Exportable; // Add download/store abilities right on the export class itself.
use Maatwebsite\Excel\Concerns\FromQuery; // Use an Eloquent query to populate the export.

use App\Member;

class MembersExport implements FromCollection {
    use Exportable;

    public function collection() {
        return Member::all();
    }
}