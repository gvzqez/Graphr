@extends('layouts.app')

@section('sidebar')
    @if(isset($category->sub_categories))
        @parent
        <div class="pt-4 pl-4">
            <h5>Categories</h5>
        </div>
        <ul class="nav flex-column pt-2 pl-4 pb-4">
            @foreach($category->sub_categories as $sub_category)
                <li class="nav-item">
                    <a class="nav-link" href="{{'/category/'.$sub_category->slug}}">{{$sub_category->name}}</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection

@section('content')
<div class="container pt-3">
    <div class="row justify-content-center">
        @foreach($fonts as $font)
            <div class="col-md-12 my-2">
                <div class="card">
                    <div class="card-header">
                        <a href="{{'/'.$font->slug}}">{{$font->name}}</a>
                        <div class="card-tag">{{$font->category->name}}</div>
                    </div>
                    <div class="card-body row">
                        <div class="col-12">
                            @if(isset($font->images))
                                @foreach($font->images as $image)
                                    @if($image->is_cover)
                                        <img alt="" src="{{asset('/img/fonts/' . $image->source)}}">
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
