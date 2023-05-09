<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\Admin\Category\DeleteCategoryRequest;
use App\Http\Requests\Admin\Category\EditCategoryRequest;
use App\Http\Requests\Admin\Category\AddCategoryRequest;

class CategoryController extends Controller
{
    // ========================================= GET ========================================= //

    public function show() {
        return view('admin.dynamic.categories.show', [
            'allCategories' => Category::orderBy('id', 'desc')->paginate(10),
            'categoryCount' => Category::count()
        ]);
    }

    public function edit($slug) {
        return view('admin.dynamic.categories.edit', [
            'category' => Category::slug($slug)->first()
        ]);
    }

    public function add() {
        return view('admin.dynamic.categories.add');
    }

    // ========================================= POST ========================================= //

    public function deleteProcess(DeleteCategoryRequest $request) {
        $request->validated($request->all());

        Category::where('id', $request->category_id)->forceDelete();

        return Redirect::route('category.admin.show')
                        ->with('successMessage', 'Đã xóa thể loại thành công');
    }

    public function editProcess(EditCategoryRequest $request) {
        $request->validated($request->all());

        Category::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return Redirect::route('category.admin.show')
                        ->with('successMessage', 'Cập nhật thể loại thành công');
    }

    public function addProcess(AddCategoryRequest $request) {
        $request->validated($request->all());

        Category::insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return Redirect::route('category.admin.show')
                        ->with('successMessage', 'Thêm thể loại thành công');
    }
}
