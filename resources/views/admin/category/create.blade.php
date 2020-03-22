@extends('layouts.admin.admin')
@section('content')
    @include('include.admin.breadcrumb',['data'=>[
    ['title'=>'مدیریت دسته ها','url'=>url('c/a/category')],
     ['title'=>'ایجاد کردن دسته جدید','url'=>url('c/a/category/create')]
    ]])
    <div class="panel">
        <div class="header">افزودن دسته جدید</div>
        <div class="panel_content">

            {!! Form::open(['url' => 'c/a/category','files'=>true]) !!}

                <div class="form-group">
                    {{ Form::label('name','نام دسته :')}}
                    {{ Form::text('name',null,['class'=>'form-control'])}}
                    @if($errors->has('name'))
                        <span class="has_error">{{$errors->first('name')}}</span>
                    @endif
                </div>
            <div class="form-group">
                {{ Form::label('ename','نام لاتین دسته :')}}
                {{ Form::text('ename',null,['class'=>'form-control'])}}
            </div>
            <div class="form-group">
                {{ Form::label('search_url','URL دسته :')}}
                {{ Form::text('search_url',null,['class'=>'form-control'])}}
                @if($errors->has('search_url'))
                    <span class="has_error">{{$errors->first('search_url')}}</span>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('parent_id','انتخاب سر دسته : ')}}
                {{ Form::select('parent_id',$parent_cat,null,['class'=>'selectpicker','data-live-search'=>'true']) }}
            </div>
            <div class="form-group">
                <input type="file" name="pic" id="pic" onchange="loadFile(event)" style="display: none">
                {{ Form::label('pic','انتخاب تصویر :')}}
                <img src="{{url('files/images/fixed/cat_img_template.png')}}" onclick="select_file()" alt="آپلود عکس برای دسته بندی" width="150px" id="output">
                @if($errors->has('pic'))
                    <span class="has_error">{{$errors->first('pic')}}</span>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('notShow','عدم نمایش در لیست اصلی')}}
                {{Form::checkbox('notShow',false)}}
            </div>
            <button class="btn btn-success" title="ثبت و اضافه کردن دسته جدید به مجموعه دسته بندی ها"> ثبت دسته</button>
            {!! Form::close() !!}

        </div>
    </div>

@stop
