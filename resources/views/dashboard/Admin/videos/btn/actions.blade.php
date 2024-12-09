<div class="d-flex">


    @if ($video->deleted_at == null)
        <form id="delete-form-{{ $video->id }}" action="{{ route('admin.videos.destroy', $video->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-1  btn-sm">{{ trans('dashboard/general.delete')}}</button>
        </form>
    @else
        <form action="{{ route('admin.restore',$video->id) }}" method="post">
            @csrf

            <button class="btn btn-danger mx-1 btn-sm">{{ trans('dashboard/general.restore')}}</button>


        </form>
    @endif

        <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-info btn-sm" style="margin-left: 5px; justify-content: center; align-items: center; display: flex;">{{ trans('dashboard/general.update')}}</a>
</div>


    <script>
        function deleteAdmin(id) {
            if (confirm("Are you sure you want to delete this admin?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>

