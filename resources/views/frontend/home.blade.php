@extends('frontend.includes.site')
@push('css')
@endpush
@section('pageTitle', $pageTitle)

@section('content')


<div class="container my-5">
    <div class="row justify-content-center text-center my-5">
<div class="container justify-content-center text-center">
        <div class="cardcode">
            <a class="singup text-light">Enter The code here</a>
            <form action="{{ route("site.code.validate") }}" method="POST">
                @csrf

            
            <div class="inputBox1">
                <input type="text text-light" name="code">
                <span class="user text-light">Email</span>

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="enter text-light mt-5">Enter</button>
        </form>
        </div>
    </div>
    </div>
</div>


    @push('js')
    @endpush
@endsection
