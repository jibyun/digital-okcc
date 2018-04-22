<?php

namespace App\Http\Services\MemberList;

use App\Member;
use App\Code_Category;
use App\Code;
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
            $member = Member::where($field, $code)->get();
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
        $result=array();

        $cates=Code_Category::with(['codes'])->whereIn('id',array(2,5,10))->get();

        $menuList=array();
        foreach($cates as $cate){
            $menu=$this->makeMenu($cate);  //code_category->menu_level1
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
}

class MenuObject {
    public $text;
    public $code;
    public $selectable;
    public $children;
}