@extends('frontend.includes.site')
@push('css')
@endpush
@section('pageTitle', $pageTitle)

@section('content')
   

@foreach($videos as $video)

<div class="container">
<IFRAME SRC="https://fsdcmo.sbs/e/lb77r7twef5y" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=640 HEIGHT=360 allowfullscreen></IFRAME>
    Your browser does not support the video tag.
</video>
    <h1 class="text-light">{{ $video->name }}</h1>
</div>
    
@endforeach

@push('js')
    
@endpush
@endsection