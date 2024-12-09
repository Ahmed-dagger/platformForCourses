<?php
namespace  App\Repositories\Eloquents;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\AdminDataTable;

class CategoryRepository implements CategoryRepositoryInterface {
    public function index(AdminDataTable $adminDataTable) {

        return $adminDataTable->render('dashboard.Admin.categories.index', ['pageTitle' => trans('dashboard/admin.categories')]);

    }

    public function store($request) {

    }

    public function update($request) {

    }

    public function destroy($request) {

    }
}
