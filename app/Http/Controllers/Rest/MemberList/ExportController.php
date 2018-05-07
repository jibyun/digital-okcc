<?php

namespace App\Http\Controllers\Rest\MemberList;

use App\Exports\MembersExport;
use App\Http\Controllers\Rest\BaseController;
use App\Http\Services\MemberList\MemberListService;
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
        $fieldName = '';
        $fieldCode = '';
        $searchString = '';
        if (!empty(trim($request->filename))) {
            // Also need to check the extention.
            $filename = $request->filename;
        }
        if (!empty(trim($request->code))) {
            $fieldCode = $request->code;
        }

        if (!empty(trim($request->search))) {
            $searchString = $request->search;
        }

        if ($fieldCode != "0000" && $fieldCode != "9999") {
            $memberService = new MemberListService();
            $fieldName = $memberService->findFieldByCode($fieldCode);
        }

        // This code need to be optimize
        if ($fieldCode != "9999") {
            $searchString = '';
        }
        return (new MembersExport)->setSearchParams($fieldName, $fieldCode, $searchString)->download($filename);
    }
}
