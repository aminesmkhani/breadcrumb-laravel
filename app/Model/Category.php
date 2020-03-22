<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  Category extends Model
{
    use SoftDeletes;
    protected $table='category';
    protected $fillable=[
      'name',
      'ename',
      'url',
      'search_url',
      'img',
      'parent_id',
      'notShow'
    ];
    /*
    |--------------------------------------------------------------------------
    | get_parent static function
    |--------------------------------------------------------------------------
    |
    | this function for access under category
    |
    */
    public static function get_parent()
    {
        $array=[0=>'دسته اصلی'];
        $list=self::with('getChild.getChild')->where('parent_id',0)->get();
        foreach ($list as $key=>$value)
        {
            $array[$value->id]=$value->name;
            // child 1 select
            foreach ($value->getChild as $key1=>$value1)
            {
                $array[$value1->id]=' - '.$value1->name;
                // child 2 select
                foreach ($value1->getChild as $key2=>$value2)
                {
                    $array[$value2->id]=' - - '.$value2->name;
                }
            }
        }
        return $array;
    }
    /*
    |--------------------------------------------------------------------------
    | Relation 1 to many
    |--------------------------------------------------------------------------
    |
    | A bunch can have a few under
    | getChild for category
    |
    | hasMany 3 input
    |   1: bayad moshakhas konim ke ertebat beyne kodom jadval ha bashe (مشخص کردن جدول از طریق لایه مدل انجام میشه)
    |   2: select kone jayi ke parent_id
    |   3: mosavi bashe ba id
    */
    public function getChild()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
    /*
   |--------------------------------------------------------------------------
   | Relation 1 to 1
   |--------------------------------------------------------------------------
   |
   | Each batch can have a leader
   | hasOne 3 input
   |   1: bayad moshakhas konim ke ertebat beyne kodom jadval ha bashe (مشخص کردن جدول از طریق لایه مدل انجام میشه)
   |   2: select kone jayi ke id
   |   3: mosavi bashe ba parent_id
   */
    public function getParent()
    {
        return $this->hasOne(Category::class,'id','parent_id')
            ->withTrashed()
            ->withDefault(['name'=>'-']);
    }
    /*
  |--------------------------------------------------------------------------
  | getData Function
  |--------------------------------------------------------------------------
  | this function for select category table data
  | 1: select normal category and send view
  | 2: select trashed category and send view
  */
    public static function getData($request)
    {
        $string='?';
        $category=self::with('getParent');
        if (inTrashed($request))
        {
            $category=$category->onlyTrashed();
            $string=create_paginate_url($string,'trashed=true');
        }
        $category=$category->orderBy('id','DESC')->paginate(10);
        $category->withPath($string);
        return $category;

    }
}
