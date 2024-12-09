<?php
namespace  App\Repositories\Contracts;
use App\DataTables\Dashboard\Admin\TeacherDataTable;
interface TeacherRepositoryInterface {
    public function index(TeacherDataTable $teacherDataTable);
    /*public function store($request);
    public function update($request);
    public function destroy($request);*/
}
