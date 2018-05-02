<?php

namespace App\Http\Services\MemberList;

use App\Member;

/**
 * Service layer for common functions
 */
class CommonService
{
    /**
     * Get members include all code value
     */
    public static function getMemberListWithCodeValue() {
        $member = Member::with(['codeByStatusId', 'codeByLevelId', 'codeByDutyId', 'departmentId',
                                    'codeByCityId','codeByProvinceId','codeByCountryId']);
        return $member;
    }
}
