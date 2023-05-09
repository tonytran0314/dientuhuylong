<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\Admin\Product\AddProductRequest;
use App\Http\Requests\Admin\Product\DeleteProductRequest;
use App\Http\Requests\Admin\Product\EditProductRequest;
use App\Http\Requests\Admin\Product\HideProductRequest;
use App\Http\Requests\Admin\Product\RestoreProductRequest;

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
            'hiddenProducts' => Product::onlyTrashed()->orderBy('id', 'desc')->paginate(5),
            'prodCount' => Product::onlyTrashed()->count()
        ]);
    }

    public function byCategory($category_id){
        return view('admin.dynamic.products.byCategory', [
            'prodByCate' => Product::where('category_id', $category_id)->orderBy('id', 'desc')->paginate(5),
            'prodCount' => Product::where('category_id', $category_id)->count()
        ]);
    }

    public function add(){
        return view('admin.dynamic.products.add', [
            'allCategories' => Category::all()
        ]);
    } 

    // ========================================= POST ========================================= //

    public function deleteProcess(DeleteProductRequest $request) {
        $request->validated($request->all());

        Product::where('id', $request->delete_product_id)->forceDelete();

        return Redirect::route('product.admin.hidden')
                        ->with('successMessage', 'Đã xóa sản phẩm thành công');
    }

    public function restore(RestoreProductRequest $request) {
        $request->validated($request->all());

        Product::withTrashed()->where('id', $request->restore_product_id)->restore();

        return Redirect::route('product.admin.hidden')
                        ->with('successMessage', 'Khôi phục sản phẩm thành công');
    }

    public function hideProcess(HideProductRequest $request) {
        $request->validated($request->all());

        Product::where('id', $request->product_id)->delete();

        return Redirect::route('product.admin.show')
                        ->with('successMessage', 'Ẩn sản phẩm thành công');
    }

    public function editProcess(EditProductRequest $request) {
        $request->validated($request->all());

        $image = $request->current_image;

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $image = uniqid(). '.' .$extension;
            $request->image->move(public_path('storage'), $image);
        }
        
        Product::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'image' => $image
        ]);

        return Redirect::route('product.admin.show')
                        ->with('successMessage', 'Cập nhật sản phẩm thành công');
    }

    public function addProcess(AddProductRequest $request) {
        $request->validated($request->all());

        $extension = $request->file('image')->extension();
        $image = uniqid(). '.' .$extension;

        $request->image->move(public_path('storage'), $image);

        Product::insert([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
            'image' => $image,
            'price' => $request->price,
            'category_id' => $request->category
        ]);

        return redirect(route('product.admin.show'))->with('successMessage', 'Thêm sản phẩm thành công');
    }
}
