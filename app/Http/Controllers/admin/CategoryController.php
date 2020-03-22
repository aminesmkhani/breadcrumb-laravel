<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends CustomController
{
    // this property for send custom controller for use
    // model
    protected $model='Category';
    // title
    protected $title='دسته';
    // this property for access route for set controller
    protected $route_params='category';
    public function index(Request $request)
    {
        // this method refer in Category model and getData function
        $category=Category::getData($request->all());
        // select and return trashed count
        $trash_cat_count=Category::onlyTrashed()->count();
        return view('admin.category.index',compact('category','trash_cat_count'));
    }
    public function create()
    {
        // select category and send view for select
        $parent_cat=Category::get_parent();
        return view('admin.category.create',compact('parent_cat'));
    }
    public function store(CategoryRequest $request)
    {
        $notshow=$request->has('notShow') ? 1 : 0;
        $category=new Category($request->all());
        $category->notShow=$notshow;
        $category->url=get_url($request->get('ename'));
        $img_url=upload_file($request,'pic','category');
        $category->img=$img_url;
        $category->save();

        return redirect('c/a/category')->with('message','ثبت دسته با موفقیت انجام شد');
    }
    public function edit($id)
    {
        $category=Category::findOrFail($id);
        $parent_cat=Category::get_parent();
        return view('admin.category.edit',compact('category','parent_cat'));
    }
    public function update($id,CategoryRequest $request)
    {
        $data=$request->all();
        $category=Category::findOrFail($id);
        $notshow=$request->has('notShow') ? 1 : 0;
        $img_url=upload_file($request,'pic','category');
        $category->url=get_url($request->get('ename'));
        if ($img_url!=null)
        {
            $category->img=$img_url;
        }
        $data['notShow']=$notshow;
        $category->update($data);
        return redirect('c/a/category')->with('message','ویرایش دسته با موفقیت انجام شد');
    }

}
