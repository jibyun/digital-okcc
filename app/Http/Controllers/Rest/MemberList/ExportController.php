<?php

namespace App\Http\Controllers\Rest\MemberList;

use App\Exports\MembersExport;
use App\Http\Controllers\Rest\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ExportController extends BaseController
{
    /**
     * Export data
     *
     * @param  $requst export information
     * @return export file
     */
    public function export(Request $request) {
        $filename = "members.xlsx";
        if (!empty(trim($request->filename))) {
            // Also need to check the extention.
            $filename = $request->filename;
        }
        return (new MembersExport)->download($filename);
    }
}
