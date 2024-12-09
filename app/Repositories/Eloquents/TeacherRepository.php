<?php

namespace  App\Repositories\Eloquents;

use App\Models\Admin;
use App\Repositories\Contracts\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\TeacherDataTable;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function index(TeacherDataTable $teacherDataTable)
    {
        return $teacherDataTable->render('dashboard.Admin.teachers.index', ['pageTitle' => trans('dashboard/admin.teachers')]);
    }

    public function store($request) {}

    public function update($request) {}

    public function destroy($request) {}
}
