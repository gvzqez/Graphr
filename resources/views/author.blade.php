@extends('layouts.main')

@section('content')
<div class="container pt-3">
    <h3>{{$author->name}}</h3>
    <div class="row justify-content-center">
        @foreach($fonts as $font)
            @if (isset($font->images) and !empty($font->images) and isset($font->files) and !empty($font->files))
                @include('font_card', ['font' => $font])
            @endif
        @endforeach
        <div class="pagination">
            {{$fonts->links()}}
        </div>
    </div>
</div>
@endsection
