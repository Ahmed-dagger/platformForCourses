<?php
namespace  App\Repositories\Contracts;
use App\DataTables\Dashboard\Admin\CourseDataTable;
interface CourseRepositoryInterface {
    public function index(CourseDataTable $courseDataTable);
    /*public function store($request);
    public function update($request);
    public function destroy($request);*/
}
