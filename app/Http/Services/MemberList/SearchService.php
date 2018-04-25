<?php

namespace App\Http\Services\MemberList;

use App\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service layer for handling Search request
 */
class SearchService
{
    function __construct() {
        
    }

    /**
     * Search the member and return the array
     * params: $search search string
     * 
     * return member list
     * 
     */
    public function getMemberList($search) {
        $memberList = Member::with(['codeByStatusId', 'codeByLevelId', 'codeByDutyId',
                                    'codeByCityId','codeByProvinceId','codeByCountryId'])
                        ->where(
                            DB::raw("CONCAT(first_name, ' ', last_name, ' ', kor_name)"), 
                            'like', '%' . $search . '%')
                        ->select('*', DB::raw("CONCAT(first_name,' ',last_name) as eng_name"))
                        ->get();
        return $memberList;
    }
}
