<?php

namespace App\Http\Services\MemberList;
use App\Member;
use App\Family_Map;
use App\Code_Category;
use Illuminate\Support\Facades\Log;

/**
 * Service layer for handling member
 */
class MemberService
{
    function __construct() {
        
    }

    /**
     * Get member information
     * params: $id member ID
     * 
     */
    public function getMember($id) {
        // TODO: Implement the logic to get member info

       // $memberinfo=(object)array();
        $member = Member::with(['codeByCityId','codeByProvinceId','codeByCountryId','codeByDutyId','codeByLevelId','codeByStatusId'
        ,'visits.user','member_histories','familyPrimaryMap.family_maps'=> function ($query) {
            $query->orderBy('relation_id', 'asc');}
        ,'familyPrimaryMap.family_maps.memberByParentId'
        ,'familyPrimaryMap.family_maps.memberByChildId'
        ,'familyPrimaryMap.family_maps.codeByRelationId'
        ])->find($id);
       
        return $member;
    }

    /**
     * Retrieve the search category+code by categoryIds from DB
     */
    public function getCategoryByIds($ids) {

        $cates=Code_Category::with(['codes'=>function ($query) {
            $query->orderBy('order', 'asc');
        }])->whereIn('id',$ids)->get();
        
        return $cates;
    }
}
