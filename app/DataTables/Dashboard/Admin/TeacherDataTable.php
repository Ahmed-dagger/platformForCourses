<?php

namespace App\DataTables\Dashboard\Admin;

use App\Models\Teacher;
use App\DataTables\Base\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class TeacherDataTable extends BaseDataTable
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
        parent::__construct(new Teacher());
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Teacher $teacher) {
                return view('dashboard.admin.teachers.btn.actions', compact('teacher'));
            })
            ->editColumn('created_at', function (Teacher $teacher) {
                return $this->formatBadge($this->formatDate($teacher->created_at));
            })
            ->editColumn('updated_at', function (Teacher $teacher) {
                return $this->formatBadge($this->formatDate($teacher->updated_at));
            })
            ->editColumn('deleted_at', function (Teacher $teacher) {
                return $this->formatBadge($this->formatDate($teacher->deleted_at));
            })
            ->editColumn('name', function (Teacher $teacher) {
                return '<a href="' . route('admin.teachers.show', $teacher->profile->uuid) . '">' . $teacher->name . '</a>';
            })
            ->editColumn('status', function (Teacher $teacher) {
                return $this->formatStatus($teacher->status);
            })
            ->rawColumns(['action', 'created_at', 'updated_at','deleted_at', 'status', 'name']);
    }

    public function query(): QueryBuilder
    {
        return Teacher::query();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false,],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/admin.name'),],
            ['name' => 'email', 'data' => 'email', 'title' => trans('dashboard/admin.email'),],
            ['name' => 'status', 'data' => 'status', 'title' => trans('dashboard/general.status'),],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at'), 'orderable' => false, 'searchable' => false,],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at'), 'orderable' => false, 'searchable' => false,],
            ['name' => 'deleted_at', 'data' => 'deleted_at', 'title' => trans('dashboard/general.deleted_at'), 'orderable' => false, 'searchable' => false,],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false,],
        ];
    }
}
