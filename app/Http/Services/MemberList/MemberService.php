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
        ,'visits.user','member_histories','member_department_maps.codeByPositionId'])->find($id);
        //Log::debug($member);
        $familys=$this->getFamilys($id);
        $member->familys=$familys;
        
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

    public function getFamilys($id) {
        $familys=array();
        $member=Member::with(['primaryMembers'])->find($id);
        $primaryId=$id;
      
        if(!$member->primary)
        {
            if($member->primaryMembers->count()==0)
            return null;

           $primaryId=$member->primaryMembers[0]->id;
        }

        $member=Member::with(['family_maps'=> function ($query) {
            $query->orderBy('relation_id', 'asc');}
        ,'family_maps.memberByParentId'
        ,'family_maps.memberByChildId'
        ,'family_maps.codeByRelationId'
        ])->find($primaryId);
       
            $primary=(object)array();
            $primary->id=$member->id;
            $primary->english_name=$member->english_name;
            $primary->relation_txt ='HouseHolder';
            array_push($familys,$primary);
            foreach($member->family_maps as $family)
            {
                $familyMember=(object)array();
                $familyMember->id=$family->memberByChildId->id;
                $familyMember->english_name=$family->memberByChildId->english_name;
                $familyMember->relation_txt =$family->codeByRelationId->txt;
                array_push($familys,$familyMember);
            }
      
        return $familys;
    }
}
