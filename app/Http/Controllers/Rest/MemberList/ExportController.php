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
        LOG::debug($request->all());
        return (new MembersExport)->download($request->fileName);
    }
}
