<?php
namespace  App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\AcademicDataTable;
use App\DataTables\Dashboard\Admin\TeacherDataTable;
interface AcademicRepositoryInterface {
    public function index(AcademicDataTable $academicDataTable);
    /*public function store($request);
    public function update($request);
    public function destroy($request);*/
}
