<div class="col-md-12 my-2 px-4">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a href="{{'/fonts/'.$font->slug}}">{{$font->name}}</a>
                 -
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
                <div class="card-buttons">
                    <button type="button" class="btn btn-dark card-button" onclick="downloadZip('{{route('download',$font->slug)}}')">Download</button>
                    {{--<button type="button" class="btn btn-light card-button-sm" onclick="">Donate Designer</button>--}}
                </div>
            </div>
        </div>
    </div>
</div>