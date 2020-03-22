{{-- breadcrumb area--}}
@php
    $jdf=new \App\Library\Jdf();
@endphp
<div class="breadcrumb">
    <ul class="list-inline">
        <li>
            <a href="{{url('u/a')}}">
                <span class="fa fa-home"></span>
                <span>پیشخوان</span>
                @if (isset($data))
                    <span class="fa fa-angle-left"></span>
                @endif
            </a>
        </li>
        @if (isset($data) && is_array($data))
            @foreach($data as $key=>$value)
                <li>
                    <a href="{{$value['url']}}">
                        <span>{{$value['title']}}</span>
                        @if ($key!=(sizeof($data)-1) || isset($_GET['trashed']))
                            <span class="fa fa-angle-left"></span>
                        @endif
                    </a>
                </li>
             @endforeach
        @endif
    {{-- Date Area--}}
        <li class="date_li">
            <span class="fa fa-calendar"></span>
            <span>امروز</span>
            <span>{{$jdf->jdate('l')}}</span>
            <span>{{$jdf->jdate('j')}}</span>
            <span>{{$jdf->jdate('F')}}</span>
            <span>{{$jdf->jdate('Y')}}</span>
        </li>
    {{-- Date Area--}}
    </ul>
</div>

{{-- End breadcrumb area--}}



