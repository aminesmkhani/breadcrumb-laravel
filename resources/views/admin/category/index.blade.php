@extends('layouts.admin.admin')
@section('content')
    @include('include.admin.breadcrumb',['data'=>[['title'=>'مدیریت دسته ها','url'=>url('c/a/category')]]])
    <div class="panel">
        <div class="header">
            مدیریت دسته ها
           @include('include.admin.item_table',['count'=>$trash_cat_count,'route'=>'c/a/category','title'=>'دسته'])
        </div>
        <div class="panel_content">
            @include('include.admin.alert')
            @php $i=(isset($_GET['page'])) ?(($_GET['page']-1)*10) : 0; @endphp
            <form method="post" id="data_form">
                @csrf
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ردیف</th>
                        <th>نام دسته</th>
                        <th>دسته والد</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $key=>$value)
                        @php $i++ @endphp
                        <tr>
                            <td>
                                <input type="checkbox" class="check_box" name="category_id[]" value="{{$value->id}}">
                            </td>
                            <td>{{replace_number($i)}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->getParent->name}}</td>
                            <td>
                                @if(!$value->trashed())
                                <a href="{{url('c/a/category/'.$value->id.'/edit')}}" title="ویرایش دسته"><span class="fa fa-edit"></span></a>
                                @endif
                                @if($value->trashed())
                                        <span data-toggle="tooltip" data-placement="bottom" title="بازیابی دسته" onclick="restore_row('{{url('c/a/category/'.$value->id)}}','{{Session::token()}}','آیا از بازیابی این دسته مطمئن هستید ؟')" class="fa fa-refresh"></span>
                                @endif
                                @if(!$value->trashed())
                                 <span data-toggle="tooltip" data-placement="bottom" title="حذف دسته" onclick="del_row('{{url('c/a/category/'.$value->id)}}','{{Session::token()}}','آیا از حذف این دسته مطمئن هستید ؟')" class="fa fa-remove"></span>
                                @else
                                        <span data-toggle="tooltip" data-placement="bottom" title="حذف دسته برای همیشه" onclick="del_row('{{url('c/a/category/'.$value->id)}}','{{Session::token()}}','آیا از حذف این دسته مطمئن هستید ؟')" class="fa fa-remove"></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if(sizeof($category)==0)
                        <tr>
                            <td colspan="5">رکوردی برای نمایش وجود ندارد</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </form>
            {{$category->links()}}
        </div>
    </div>
    @stop
