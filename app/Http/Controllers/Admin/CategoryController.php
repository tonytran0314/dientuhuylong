<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.dynamic.categories.add', [
        ]);
    }

    // ========================================= POST ========================================= //

    public function deleteProcess(Request $request) {
        $request->validate([
            'category_id' => 'required|numeric'
        ]);
        $id = $request->category_id;

        Category::where('id', $id)->forceDelete();

        return redirect(route('category.admin.show'))->with('successMessage', 'Đã xóa thể loại thành công');
    }

    public function editProcess(Request $request) {
        $request->validate([
            'name' => 'required|regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\.\&\(\)\-\"\'\d,\s]+)$/'
        ]);

        $id = $request->id;
        $name = $request->name;
        $slug = Str::slug($request->name);

        Category::where('id', $id)->update([
            'name' => $name,
            'slug' => $slug
        ]);

        return redirect(route('category.admin.show'))->with('successMessage', 'Cập nhật thể loại thành công');
    }

    public function addProcess(Request $request) {
        $request->validate([
            'name' => 'required|regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\.\&\(\)\-\"\'\d,\s]+)$/'
        ]);

        $name = $request->name;
        $slug = Str::slug($request->name);

        Category::insert([
            'name' => $name,
            'slug' => $slug
        ]);

        return redirect(route('category.admin.show'))->with('successMessage', 'Thêm thể loại thành công');
    }
}
