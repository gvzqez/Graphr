@extends('layouts.main')

@section('content')
    <div class="col-md-12 my-2 px-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {{$font->name}} -
                    <a href="{{'/fonts/author/'.$font->author->slug}}">{{$font->author->name}}</a>
                </div>
                @if(!is_null($font->category->parent) and $font->category->parent->name != $font->category->name)
                    <div class="card-tag">
                        <a href="{{'/fonts/category/'.$font->category->parent->slug}}">{{$font->category->parent->name}}</a>
                    </div>
                @endif
                <div class="card-tag">
                    <a href="{{'/fonts/category/'.$font->category->slug}}">{{$font->category->name}}</a>
                </div>
            </div>
            <div class="card-body row">
                <div class="col-10">
                    @if(isset($font->images))
                        @foreach($font->images as $image)
                            @if($image->is_cover)
                                <a href="{{'/fonts/'.$font->slug}}">
                                    <img alt="" src="{{asset('/img/fonts/' . $image->source)}}">
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="col-2">
                    @if(isset($font->files) and !empty($font->files))
                        <div class="card-buttons">
                            <button type="button" class="btn btn-dark card-button" onclick="downloadZip('{{route('download',$font->slug)}}')">Download</button>
                            {{--<button type="button" class="btn btn-light card-button-sm" onclick="">Donate Designer</button>--}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row card-section">
                <div class="col-6 card-info">
                    <div class="row">
                        <div class="col-4 card-info-el">Date added:</div>
                        <div class="col-7 card-info-el">{{$font->created_at}}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 card-info-el">Formats:</div>
                        <div class="col-7 card-info-el">{{$fontTypes}}</div>
                    </div>
                    @if (!is_null($fontSize))
                        <div class="row">
                            <div class="col-4 card-info-el">File size:</div>
                            <div class="col-7 card-info-el">{{$fontSize / 1000}} Kb</div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-4 card-info-el">Downloads:</div>
                        <div class="col-7 card-info-el">{{$font->downloads->count()}}</div>
                    </div>
                </div>
                @if (!is_null($font->description) and !empty($font->description))
                    <div class="col-12 card-description">
                        {!! $font->description !!}
                    </div>
                @endif
                <div class="col-12 card-images">
                    @if(isset($font->images))
                        @foreach($font->images as $image)
                            @if(!$image->is_cover)
                                <img alt="" src="{{asset('/img/fonts/' . $image->source)}}">
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection