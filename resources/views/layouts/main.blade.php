@extends('layouts.app')

@section('main')
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="pt-4 pl-4">
            <h5>Categories</h5>
        </div>
        <ul class="nav flex-column pt-2 pl-4 pb-4">
            @foreach(\App\Utils::getCategoryList() as $categoryInList)
                <li class="nav-item">
                    <a class="nav-link" href="{{'/category/'.$categoryInList->slug}}">{{$categoryInList->name}}</a>
                    <ul>
                        @foreach($categoryInList->sub_categories as $sub_category)
                            <li class="nav-item">
                                <a class="nav-link" href="{{'/category/'.$sub_category->slug}}">{{$sub_category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="page-content " id="content">
        @yield('content')
    </div>
@endsection