@extends('dashboard.layouts.master')

@push('css')

@endpush('css')

@section('pageTitle'){{ $pageTitle }}@endsection
@section('content')
@include('dashboard.layouts.common._partial.messages')


    <div class="card">
        <form id="video_properties" class="form" method="POST" action="{{ route('admin.videos.update', ['video'=> $video->id , 'type' => 'update']) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                @include('dashboard.Admin.videos.form')
                <div class="">
                    <div class="row my-4">
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('js')


    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@endpush

