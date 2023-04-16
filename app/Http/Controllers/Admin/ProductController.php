<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    // ========================================= GET ========================================= //

    public function show() {
        return view('admin.dynamic.products.show', [
            'allProducts' => Product::orderBy('id', 'desc')->paginate(5),
            'productCount' => Product::count()
        ]);
    }

    public function detail($slug) {
        return view('admin.dynamic.products.detail', [
            'detail' => Product::slug($slug)->first()
        ]);
    }

    public function edit($slug) {
        return view('admin.dynamic.products.edit', [
            'detail' => Product::slug($slug)->first(),
            'allCategories' => Category::all()
        ]);
    }

    public function hidden() {
        return view('admin.dynamic.products.hidden', [
            'hiddenProducts' => Product::onlyTrashed()->orderBy('id', 'desc')->paginate(5)
        ]);
    }

    public function byCategory($category_id){
        return view('admin.dynamic.products.byCategory', [
            'prodByCate' => Product::where('category_id', $category_id)->orderBy('id', 'desc')->paginate(5)
        ]);
    }

    public function add(){
        return view('admin.dynamic.products.add', [
            'allCategories' => Category::all()
        ]);
    } 

    // ========================================= POST ========================================= //

    public function deleteProcess(Request $request) {
        $request->validate([
            'delete_product_id' => 'required|numeric'
        ]);

        $id = $request->delete_product_id;

        Product::where('id', $id)->forceDelete();

        return redirect(route('product.admin.hidden'))->with('successMessage', 'Đã xóa sản phẩm thành công');
    }

    public function restore(Request $request) {
        $request->validate([
            'restore_product_id' => 'required|numeric'
        ]);
        $id = $request->restore_product_id;
        Product::withTrashed()->where('id', $id)->restore();
        return redirect(route('product.admin.hidden'))->with('successMessage', 'Khôi phục sản phẩm thành công');
    }

    public function hideProcess(Request $request) {
        $request->validate([
            'product_id' => 'required|numeric'
        ]);
        $id = $request->product_id;

        Product::where('id', $id)->delete();

        return redirect(route('product.admin.show'))->with('successMessage', 'Ẩn sản phẩm thành công');
    }

    public function editProcess(Request $request) {
        $request->validate([
            'name' => 'required|regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/',
            'category' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $id = $request->id;
        $name = $request->name;
        $category = $request->category;
        $slug = Str::slug($request->name);
        $price = $request->price;
        $image = $request->current_image;

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $image = uniqid(). '.' .$extension;
            $request->image->move(public_path('storage'), $image);
        }
        
        Product::where('id', $id)->update([
            'name' => $name,
            'categoryID' => $category,
            'slug' => $slug,
            'price' => $price,
            'image' => $image
        ]);

        return redirect(route('product.admin.show'))->with('successMessage', 'Cập nhật sản phẩm thành công');
    }

    public function addProcess(Request $request) {
        $request->validate([
            'name' => 'required|regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/',
            'image' => 'required|image',
            'category' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $extension = $request->file('image')->extension();
        $image = uniqid(). '.' .$extension;
        $name = $request->name;
        $slug = Str::slug($request->name);
        $price = $request->price;
        $category_id = $request->category;

        $request->image->move(public_path('storage'), $image);

        Product::insert([
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'price' => $price,
            'category_id' => $category_id
        ]);

        return redirect(route('product.admin.show'))->with('successMessage', 'Thêm sản phẩm thành công');
    }
}
