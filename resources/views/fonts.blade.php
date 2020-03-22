@extends('layouts.main')

@section('content')
<div class="container pt-3">
    <h3>Fonts</h3>
    <div class="row justify-content-center">
        @foreach($fonts as $font)
            @include('font_card', ['font' => $font])
        @endforeach
        <div class="pagination">
            {{$fonts->links()}}
        </div>
    </div>
</div>
@endsection
