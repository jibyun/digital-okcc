<?php

namespace App\Http\Services\MemberList;

use App\Member;
use App\Code_Category;
use App\Code;

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
     * params: code code
     */
    public function getMemberList($code) {
        $field = $this->findFieldByCode($code);
        $member = Member::where($field, $code)->get();

    }

    /**
     * find the field name in member table by given code
     */
    private function findFieldNameByCode($code) {

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