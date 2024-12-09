<?php

namespace App\DataTables\Dashboard\Admin;

use App\Models\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Video;
use App\Models\Playlist;
use Flasher\Laravel\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class VideoDataTable extends BaseDataTable
{
    protected function getParameters() {
        $parameters = parent::getParameters();
        if(!request()->has('filter'))
        {
            $parameters['buttons'][] = [
                'text' => "<i class='fa fa-trash'></i> " . trans('dashboard/datatable.deleted'),
                'className' => 'btn btn-danger',
                'action' => '
                function(e, dt, node, config) {
                 window.location.href = "' . route('admin.admins.index' , ["filter"=>"deleted"]) . '"; }
                 '
            ];
        }

        elseif(request()->has('filter') && request()->input('filter') === 'deleted')
        {
            $parameters['buttons'][] = [
            'text' => "<i class='fa fa-user'></i> " . trans('dashboard/datatable.admins'),
            'className' => 'btn btn-primary',
            'action' => '
            function(e, dt, node, config) {
             window.location.href = "' . route('admin.admins.index') . '"; }
             '
        ];
        }


        return $parameters;
    }
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Video());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Video $video) {
                return view('dashboard.admin.videos.btn.actions', compact('video'));
            })
            ->editColumn('created_at', function (Video $video) {
                return $this->formatBadge($this->formatDate(value: $video->created_at));
            })
            ->editColumn('deleted_at', function (Video $video) {
                return $this->formatBadge($this->formatDate($video->deleted_at));
            })
            ->editColumn('status', function (Video $video) {
                return $this->formatStatus($video->status);
            })
            ->rawColumns(['action', 'created_at', 'updated_at', 'deleted_at', 'status', 'name']);
    }

    public function query(): QueryBuilder
    {
        return Video::query();
    }

    public function getColumns(): array
    {


        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/admin.name')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'deleted_at', 'data' => 'deleted_at', 'title' => trans('dashboard/general.deleted_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
