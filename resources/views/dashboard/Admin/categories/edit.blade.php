@extends('dashboard.layouts.master')

@section('css')
@endsection

@section('pageTitle')
    {{ $pageTitle }}
@endsection

@section('content')
    @include('dashboard.layouts.common._partial.messages')


    <div class="card">
        <form class="form" method="POST" action="{{ route('admin.categories.update', $category->id) }}">
            @csrf
            @method('PUT') 
        
            <div class="card-body">
                <!-- Name Fields -->
                <div class="form-group my-4">
                    <label>{{ __('dashboard/forms.fullname') }}</label>
                    <input name="name[ar]" type="text" class="form-control form-control-solid" placeholder="Enter Arabic name"
                    value="{{ $category->translating('ar')->name ?? '' }}"/>
                    <input name="name[en]" type="text" class="form-control form-control-solid mt-2"
                        placeholder="Enter English name" value="{{ $category->translating('en')->name ?? '' }}" />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Description Fields -->
                <div class="form-group my-4">
                    <label>{{ __('dashboard/forms.desc') }}</label>
                    <input name="description[ar]" type="text" class="form-control form-control-solid"
                        placeholder="Enter Arabic description"
                        value="{{ $category->translating('ar')->description ?? '' }}" />
                    <input name="description[en]" type="text" class="form-control form-control-solid mt-2"
                        placeholder="Enter English description"
                        value="{{ $category->translating('en')->description ?? '' }}" />
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Parent Category Selection -->
                <div class="form-group">
                    <span>{{ __('dashboard/forms.parent') }}</span>
                    <div class="py-3 card-body">
                        <div id="jstree"></div> <!-- jstree -->
                    </div>
        
                    <input type="hidden" name="parent" id="parent" class="parent" value="{{ $category->parent }}" />
                    @error('parent')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('dashboard/forms.Submit') }}</button>
                <button type="reset" class="btn btn-secondary">{{ __('dashboard/forms.Reset') }}</button>
            </div>
        </form>
    </div>


    
@endsection

@push('js')
    



    <script>
        $('#jstree').jstree({
            "core": {

                'data': {!! loadcategories($category->parent , $category->id) !!},
                "themes": {
                    "variant": "large"
                }

            },

            "checkbox": {
                "keep_selected_style": false
            },
            "plugins": ["wholerow"]
        });




        $('#jstree').on('changed.jstree',function(e, data) {

            var i, j, r = [];

            for (i = 0, j = data.selected.length; i < j; i++)
            {
                r.push(data.instance.get_node(data.selected[i]).id);
            }

            $('.parent').val(r.join(', '));


        });
    </script>
@endpush
