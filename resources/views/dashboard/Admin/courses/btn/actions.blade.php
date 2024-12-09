<div class="d-flex">


    @if ($course->deleted_at == null)

    <button type="button" class="btn btn-danger mx-1" onclick="confirmDeleteAdmin({{ $course->id }})">
        {{ trans('dashboard/general.delete') }}
    </button>

        <form id="delete-form-{{ $course->id }}" action="{{ route('admin.courses.destroy', $course->id) }}" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @else
        <form action="{{ route('admin.restore',$course->id) }}" method="post">
            @csrf
            <button class="btn btn-danger mx-1">{{ trans('dashboard/general.restore')}}</button>
        </form>
    @endif

    <form action="{{ route('admin.courses.edit' ,$course->id ) }}">
        @csrf
        <button class="btn btn-info">{{ trans('dashboard/general.update')}}</button>

    </form>

</div>

<div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-labelledby="deleteAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAdminModalLabel">Delete Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this course?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteAdminBtn">Delete</button>
            </div>
        </div>
    </div>
</div>


    <script>
       let selectedAdminId = null; // Variable to store the selected admin ID

// Function to trigger the delete confirmation modal
function confirmDeleteAdmin(adminId) {
    selectedAdminId = adminId; // Set the selected admin ID
    $('#deleteAdminModal').modal('show'); // Show the confirmation modal
}

// Handle the confirm delete button click
$('#confirmDeleteAdminBtn').on('click', function() {
    if (selectedAdminId) {
        // Submit the delete form for the selected admin
        document.getElementById('delete-form-' + selectedAdminId).submit();
        $('#deleteAdminModal').modal('hide'); // Hide the modal after submission
    }
});
    </script>

