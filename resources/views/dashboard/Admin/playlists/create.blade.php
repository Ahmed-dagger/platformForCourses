@extends('dashboard.layouts.master')

@push('css')
    <style>
        /* From Uiverse.io by Na3ar-17 */
        .radio-input {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .radio-input * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        .radio-input label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 0px 20px;
            width: 220px;
            cursor: pointer;
            height: 50px;
            position: relative;
        }

        .radio-input label::before {
            position: absolute;
            content: "";
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 220px;
            height: 45px;
            z-index: -1;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-radius: 10px;
            border: 2px solid transparent;
        }

        .radio-input label:hover::before {
            transition: all 0.2s ease;
            background-color: #2a2e3c;
        }

        .radio-input .label:has(input:checked)::before {
            background-color: #2d3750;
            border-color: #435dd8;
            height: 50px;
        }

        .radio-input .label .text {
            color: #000000;
        }

        .radio-input .label input[type="radio"] {
            background-color: #8787a1;
            appearance: none;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .radio-input .label input[type="radio"]:checked {
            background-color: #435dd8;
            -webkit-animation: puls 0.7s forwards;
            animation: pulse 0.7s forwards;
        }

        .radio-input .label input[type="radio"]:before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            transition: all 0.1s cubic-bezier(0.165, 0.84, 0.44, 1);
            background-color: #fff;
            transform: scale(0);
        }

        .radio-input .label input[type="radio"]:checked::before {
            transform: scale(1);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(138, 124, 124, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(115, 98, 98, 0);
            }
        }
    </style>
@endpush('css')


@section('pageTitle')
    {{ $pageTitle }}
@endsection

@section('content')
    @include('dashboard.layouts.common._partial.messages')


    <div class="card">
        <form class="form" method="POST" action="{{ route('admin.playlist.playlists.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row" class="my-2">
                    <div class="col-lg-6">
                        <label class="mb-2">{{ __('dashboard/forms.fullname') }}</label>
                        <input name="name" type="text" class="form-control form-control-solid"
                            placeholder="ادخل اسم القائمة كاملا" />
                        <span class="form-text text-muted">ادخل اسم القائمة كاملا</span>
                    </div>
                    <div class="col-lg-6">

                        <label for="exampleTextarea" class="mb-2">{{ __('dashboard/forms.desc') }}</label>
                        <textarea name="description" class="form-control form-control-solid" rows="1" placeholder="ادخل وصف للقائمة"></textarea>
                        <span class="form-text text-muted">ادخل وصف القائمة</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label class="my-2">{{ __('dashboard/forms.courses') }}</label>
                        <div class="radio-inline">
                            @foreach ($courses as $course)
                            <div class="radio-input">
                                <label class="label">
                                    <input type="radio" name="course_id" value="{{ $course->id }}"
                                        {{ old('course_id') == $course->id ? 'checked' : '' }} />
                                    <span></span>
                                    {{ $course->name }}
                                </label>

                            </div>
                            @endforeach
                        </div>
                        <span class="form-text text-muted">Please select user group</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="my-2"> {{ __('dashboard/forms.teachers') }}</label>
                    <div class="checkbox-list">
                        @foreach ($teachers as $teacher)
                            <div class="radio-input">
                                <label class="label">
                                    <input type="radio" name="teacher_id" value="{{ $teacher->id }}"
                                        {{ old('teacher_id') == $teacher->id ? 'checked' : '' }} />
                                    <span></span>
                                    {{ $teacher->name }}
                                </label>

                            </div>
                        @endforeach
                    </div>





                </div>
            </div>
            <div class="">
                <div class="row my-4 mx-3">
                    <div class="col-lg-10 text-lg-right">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endpush
