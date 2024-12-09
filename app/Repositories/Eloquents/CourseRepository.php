<?php

namespace  App\Repositories\Eloquents;

use App\Models\Admin;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\CourseDataTable;

class CourseRepository implements CourseRepositoryInterface
{
    public function index(CourseDataTable $courseDataTable)
    {
        return $courseDataTable->render('dashboard.Admin.courses.index', ['pageTitle' => trans('dashboard/admin.courses')]);
    }

    public function store($request) {}

    public function update($request) {}

    public function destroy($request) {}
}
