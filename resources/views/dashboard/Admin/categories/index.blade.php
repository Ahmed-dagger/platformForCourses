@extends('dashboard.layouts.master')

@section('css')


@endsection

@section('pageTitle')
    {{$pageTitle}}
@endsection

@section('content')
    @include('dashboard.layouts.common._partial.messages')
   

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this category?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
   

    
    <div id="kt_content_container" class="container-xxl">
        <div class="mb-5 card card-xxl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="pt-5 border-0 card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="mb-1 card-label fw-bolder fs-3">{{$pageTitle}}</span>
                    <span class="mt-1 text-muted fw-bold fs-7">{{$pageTitle}}</span>
                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" >
                    </div>
                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" >
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-light btn-active-primary" >
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->اضافة فئة جديدة</a>
                    </div>
                </h3>
            </div>
            <div class="py-3 card-body">


                <div class="mb-4">
                    <a href="" hidden class="showbtn delete_cat" id="deleteCategory">
                        <button class="btn btn-danger mx-1">{{ trans('dashboard/general.delete') }}</button>
                    </a>
                    <a href="" hidden class="showbtn edit_cat">
                        <button class="btn btn-info">{{ trans('dashboard/general.update')}}</button>
                    </a>
                </div>

                
                <!--begin::Table container-->

                <div id="jstree"></div>

                <input type="hidden" name="parent" id="parent" class="parent" value="" />
                <!--end::Table container-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <!--begin::Body-->
        </div>

    </div>
@endsection

@push('js')

<script>
    $('#jstree').jstree({
    "core" : {

        'data' : {!! loadcategories(old('parent')) !!},
        "themes" : {
        "variant" : "large"
      }

    },

    "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "wholerow" ] // add later checkbox for bulk
  });

  $('#jstree').on('changed.jstree',function(e, data) {

    var i, j, r = [];

    for (i = 0, j = data.selected.length; i < j; i++)
    {
        r.push(data.instance.get_node(data.selected[i]).id);
    }

    $('.parent').val(r.join(', '));


    if (r.length > 0) { // Category is selected
        // Show the buttons
        $('.showbtn').removeAttr('hidden');

        // Update the edit button's URL with the selected category ID
        var urledit = '{{ route("admin.categories.edit", ":id") }}'; // Placeholder :id
        urledit = urledit.replace(':id', r.join(', '));
        $('.edit_cat').attr('href', urledit);

        $('#deleteCategory').data('id', r.join(', '));

    }else
    {
        $('.showbtn').addAttr('hidden');
    }


    });

    $('#deleteCategory').on('click', function(e) {
    e.preventDefault();

    // Open confirmation modal (if using modal)
    $('#deleteConfirmationModal').modal('show');
});

// Handle confirm delete button inside modal
$('#confirmDeleteBtn').on('click', function() {
    var categoryId = $('#deleteCategory').data('id');

    if (categoryId) {
        var deleteUrl = '{{ route("admin.categories.destroy", ":id") }}';
        deleteUrl = deleteUrl.replace(':id', categoryId);

        // Make an AJAX request to delete the category or submit a form (method depends on your preference)
        $.ajax({
            url: deleteUrl,
            type: 'DELETE', // Assuming RESTful route with DELETE method
            data: {
                _token: '{{ csrf_token() }}' // CSRF token for security
            },
            success: function(response) {
                // Handle success (e.g., reload page or remove the category from the list)
                window.location.reload(); // Or update UI dynamically
            },
            error: function(xhr) {
                // Handle error (e.g., show error message)
                alert('Failed to delete the category.');
            }
        });

        // Close the modal after confirmation
        $('#deleteConfirmationModal').modal('hide');
    }
});
</script>




@endpush
