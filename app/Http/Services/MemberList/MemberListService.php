<?php

namespace App\Http\Services\MemberList;

use App\Member;
use App\Code_Category;
use App\Code;
use App\Member_Department_Map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service layer for handling member list
 */
class MemberListService
{
    // This is language setting and it is test purpose only.
    private $language = "EN";

    function __construct() {
    }

    /**
     * Retrieve all members
     */
    public function getAllMembers() {
        $members = CommonService::getMemberListWithCodeValue()
                                ->select('*', DB::raw("CONCAT(first_name,' ',last_name) as eng_name"))
                                ->get();
        return $members;
    }

    /**
     * Retrieve the search category from DB
     * 전교인/직분/기관부서/구역 등등
     */
    public function getCategory() {

        $category = $this->buildCategory();
        return $category;
    }

    /**
     * Retrieve the member list belong to the given code
     * 
     * @param string $code
     * @return $member list
     */
    public function getMemberList($code) {
        $category = $this->findCategoryByCode($code);
        $field = $this->findFieldByCode($code);
        $members = '';
        $searchByDepartment = config('app.SearchByDepartment');
        if (in_array($category->code_category_id, $searchByDepartment)) {
            // In case of department type, it looks up all dependent nodes.
            $dependentCodes = $this->getDepartmentCodes($code);
            $members = CommonService::getMemberListWithCodeValue()
                                ->whereHas('departmentId', function($query) use ($dependentCodes) {
                                    $query -> wherein('department_id', $dependentCodes);
                                    })
                                ->select('*', DB::raw("CONCAT(first_name,' ',last_name) as eng_name"))
                                ->get();
        } else {
            $members = CommonService::getMemberListWithCodeValue()
                                    ->where($field, $code)
                                    ->select('*', DB::raw("CONCAT(first_name,' ',last_name) as eng_name"))
                                    ->get();
        }
        return $members;
    }

    /**
     * Read the app.MemberList_Bookmark, and return the code and name
     * 
     * @return Object bookmark
     */
    public function getBookmark() {
        $config_bookmark = config('app.MemberList_Bookmark');
        $bookmark_json = json_decode($config_bookmark);
        LOG::debug($bookmark_json);
        $bookmark_result = array();
        foreach($bookmark_json as $bookmark) {
            LOG::debug($bookmark->title);
            $menu = new MenuObject();
            $categoryName = Code_category::where('id', $bookmark->title)->select('txt')->first();
            $menu->text = $categoryName->txt;
            $menu->code = $bookmark->title;
            $menu->children = array();
            foreach($bookmark->children as $child) {
                $childMenu = new MenuObject();
                $codeName = Code::where('id', $child)->select('txt')->first();
                $childMenu->text = $codeName->txt;
                $childMenu->code = $child;
                array_push ($menu->children, $childMenu);
            }
            array_push ($bookmark_result, $menu);
        }
        return $bookmark_result;
    }

    /**
     * Return the list of member status
     * The member status code category is 1
     * 
     * @return Object Code
     */
    public function getMemberStatus() {
        return Code::where('code_category_id', 1)->get();
    }

    /**
     * Get manager info string
     * It reads the Member_Department_Map table and build the manager info string
     * 
     * @param code
     * @return string position:name | position:name | .....
     */
    public function getManagerInfo($code) {
        $fieldName = "txt";
        if ($this->language !== "EN") {
            $fieldName = "kor_txt";
        }
        $result = '';
        $members = Member_Department_Map::where('department_id', $code)->where('manager', true)
                                        ->select('member_id', 'position_id')
                                        ->orderBy('position_id', 'asc')
                                        ->get();
        LOG::debug($members);                                  
        foreach($members as $member) {
            $positionName = Code::where('id', $member->position_id)
                                ->select(DB::raw($fieldName . ' as name'))
                                ->first();
            $memberName = '';
            if ($this->language === "EN") {
                $memberName = Member::where('id', $member->member_id)
                                    ->select(DB::raw("CONCAT(first_name,' ',last_name) as name"))
                                    ->first();
            } else {
                $memberName = Member::where('id', $member->member_id)
                                    ->select(DB::raw('kor_name as name'))
                                    ->first();
            }

            if ($result !== '') {
                $result = $result . " | ";
            }
            $result = $result . $positionName->name . ": " . $memberName->name;
        }
        return $result;
    }

    /**
     * Get MemberList Column Info
     * The colun info is defined in app.php
     * 
     * @return Object array of ColumnInfo
     */
    public function getColumnInfos() {
        $columnInfos = json_decode(config('app.MemberList_ColumnInfos'));
        return $columnInfos;
    }

    /**
     * find the field name in member table by given code
     * 
     * @param string $code
     * @return string $fieldName
     */
    public function findFieldByCode($code) {
        $category = $this->findCategoryByCode($code);
        $fieldName = Code_category::where('id', $category->code_category_id)->select('fieldName')->first();
        return $fieldName->fieldName;
    }

    /**
     * find the category by code
     * 
     * @param string $code
     * @return object $category
     */
    public function findCategoryByCode($code) {
        $category = Code::where('id', $code)->first();
        Log::debug($category);
        return $category;
    }

    /**
     * Search Category Sample
     */
    private function buildCategory() {
        $menuList=array();
        // Add All Member as a default
        $allMember = (object)array();
        $allMember->id = "0000";
        $allMember->txt = __('messages.memberlist.allmember');
        array_push($menuList, $this->makeMenu($allMember));

        $displayableCategories = config('app.DisplayableCategories');
        $cates=Code_Category::with(['codes'])->whereIn('id', $displayableCategories)->get();


        foreach($cates as $cate){
            $menu=$this->makeMenu($cate);//code_category->menu_level1
            $children=array();
            foreach($cate->codes as $code){
                if($code->parents()->get()->count()==0)
                    array_push($children,$this->childMenu($code)); //code->children menu
            }
            $menu->children=$children;
            array_push($menuList,$menu);
        }

        return $menuList;

    }

	//code -> menu with childrenMenu
    private function childMenu($code)
    {
        $subList=$code->children()->get();
        $menu=$this->makeMenu($code);

        if($subList->count()>0){
            $children=array();
            foreach($subList as $child){
               array_push($children,$this->childMenu($child));
            }
            $menu->children=$children;
        }
        else{
            $menu->selectable=true;
        }
        return $menu;
    }
    
    //code -> menu
    private function makeMenu($code){
        $menu=new MenuObject();
        $menu->text = $code->txt;
        $menu->code = $code->id;
        $menu->selectable=false;
        $menu->children=null;
        return $menu;
    }

    /**
     * Get all department codes including dependent
     * 
     * return array of code 
     */
    private function getDepartmentCodes($code) {
        $codeObj = Code::where('id', $code)->first();
        $dependentCodes = array();
        $dependentCodes = $this->getDependentCodes($codeObj, $dependentCodes);
        LOG::debug($dependentCodes);
        return $dependentCodes;
    }

    /**
     * Recursive function to get all dependent code
     */
    private function getDependentCodes($code, $dependentCodes) {
        $children = $code->children()->get();

        if ($children->count() > 0) {
            foreach ($children as $child) {
                $dependentCodes = $this->getDependentCodes($child, $dependentCodes);
            }
        }
        array_push($dependentCodes, $code->id);
        return $dependentCodes;
    }
}

class MenuObject {
    public $text;
    public $code;
    public $selectable;
    public $children;
}

class ColumnInfo {
    public $field;
    public $title;
    public $checkbox;
    public $visible;
}