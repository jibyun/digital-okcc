<?php

namespace App\Http\Services\MemberList;

use App\Member;
use App\Code_Category;
use App\Code;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service layer for handling member list
 */
class MemberListService
{
    function __construct() {
        
    }

    /**
     * Retrieve all members
     */
    public function getAllMembers() {
        // TODO: Implement the logic to get all member
        $member = Member::all()->take(50);
        return $member;
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
        //TODO: replace the 5, 10 to something else
        if ($category->code_category_id  == 5
            || $category->code_category_id == 10) {
            $member = Member::with(['departmentId'])->whereHas('departmentId', function($query) use ($code){
                $query -> where('department_id', $code);
            })->get();
        } else {
            $member = Member::with('duty')->where($field, $code)
                                          ->select('*', DB::raw("CONCAT(first_name,' ',last_name) as eng_name"))
                                          ->get();
        }
        return $member;
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
     * Get MemberList Column Info
     * TODO: temporary hard-code, and it will be from DB
     * 
     * @return Object array of ColumnInfo
     */
    public function getColumnInfos() {
        $columnInfos = array();
        
        $columnInfo = new ColumnInfo();
        $columnInfo->field = '';
        $columnInfo->title = '';
        $columnInfo->checkbox = true;
        $columnInfo->visible = true;
        array_push ($columnInfos, $columnInfo);
        
        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'eng_name';
        $columnInfo->title = __('messages.memberlist.name');
        $columnInfo->checkbox = false;
        $columnInfo->visible = true;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'first_name';
        $columnInfo->title = __('messages.memberlist.first_name');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'middle_name';
        $columnInfo->title = __('messages.memberlist.middle_name');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'last_name';
        $columnInfo->title = __('messages.memberlist.last_name');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'kor_name';
        $columnInfo->title = __('messages.memberlist.kor_name');
        $columnInfo->checkbox = false;
        $columnInfo->visible = true;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'dob';
        $columnInfo->title = __('messages.memberlist.dob');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'gender';
        $columnInfo->title = __('messages.memberlist.gender');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'email';
        $columnInfo->title = __('messages.memberlist.email');
        $columnInfo->checkbox = false;
        $columnInfo->visible = true;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'tel_home';
        $columnInfo->title = __('messages.memberlist.tel_home');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'tel_office';
        $columnInfo->title = __('messages.memberlist.tel_office');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'tel_cell';
        $columnInfo->title = __('messages.memberlist.tel_cell');
        $columnInfo->checkbox = false;
        $columnInfo->visible = true;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'address';
        $columnInfo->title = __('messages.memberlist.address');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'postal_code';
        $columnInfo->title = __('messages.memberlist.postal_code');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'city';
        $columnInfo->title = __('messages.memberlist.city');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'province';
        $columnInfo->title = __('messages.memberlist.province');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'country';
        $columnInfo->title = __('messages.memberlist.country');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'status';
        $columnInfo->title = __('messages.memberlist.status');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'level';
        $columnInfo->title = __('messages.memberlist.level');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'duty.txt';
        $columnInfo->title = __('messages.memberlist.duty');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'register_date';
        $columnInfo->title = __('messages.memberlist.register_date');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        $columnInfo = new ColumnInfo();
        $columnInfo->field = 'baptism_date';
        $columnInfo->title = __('messages.memberlist.baptism_date');
        $columnInfo->checkbox = false;
        $columnInfo->visible = false;
        array_push ($columnInfos, $columnInfo);

        LOG::debug($columnInfos);        

        return $columnInfos;
    }

    /**
     * find the field name in member table by given code
     * 
     * @param string $code
     * @return string $fieldName
     */
    private function findFieldByCode($code) {
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
    private function findCategoryByCode($code) {
        $category = Code::where('id', $code)->first();
        Log::debug($category);
        return $category;
    }

    /**
     * Search Category Sample
     */
    private function buildCategory() {


        //전교인 메뉴는 관련 코드없이 카데고리에 생성하면 나올 수 있도록 처리
       // $result=array();

        $cates=Code_Category::with(['codes'])->whereIn('id',array(2,5,9))->get();

        $menuList=array();
        foreach($cates as $cate){
            //code_category->menu_level1 //$this->makeMenu($cate);
            $menu=(object)array();
            $menu->text = $cate->txt;
            $menu->code = $cate->id;
            $menu->selectable=false;

            $children=array();
            foreach($cate->codes as $code){
                array_push($children,$this->childMenu($code)); //code->menu_level2 with submenu
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
        $menu=(object)array();
        $menu->text = $code->txt;
        $menu->code = $code->id;
        $menu->selectable=false;

        if($subList->count()>0){
            $children=array();
            foreach($subList as $child){
               array_push($children,$this->childMenu($child));
            }
            $menu->children=$children;
        }
        else{
            $menu->selectable=true;
            $menu->children=null;
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