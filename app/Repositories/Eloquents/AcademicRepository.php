<?php

namespace  App\Repositories\Eloquents;

use App\DataTables\Dashboard\Admin\AcademicDataTable;
use App\Repositories\Contracts\AcademicRepositoryInterface;

class AcademicRepository implements AcademicRepositoryInterface
{
    public function index(AcademicDataTable $academicDataTable)
    {
        return $academicDataTable->render('dashboard.Admin.Academics.index', ['pageTitle' => trans('dashboard/admin.academics')]);
    }

    public function store($request) {}

    public function update($request) {}

    public function destroy($request) {}
}
