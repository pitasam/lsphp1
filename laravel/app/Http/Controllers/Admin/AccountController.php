<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Good;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return redirect('/goods');
    }

    public function create_good()
    {
        return view('admin.create-good');
    }

    public function create_cat()
    {
        return view('admin.create-cat');
    }

    public function store_good(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required|string',
            'good_image' => 'required|image'
        ]);

        $file = $request->file('good_image');
//        $path = public_path('images/');
//        $file->move($path, $file->getClientOriginalName());

        $good = new Good();
        $good->name = $request->name;
        $good->category_id = $request->category_id;
        $good->price = $request->price;
        $good->image = $request->file('good_image');
        $good->desc = $request->desc;

        $good->save();

        return redirect('/goods');
    }

    public function store_cat(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'desc' => 'required|string',
        ]);

        $cat = new Category();
        $cat->name = $request->name;
        $cat->desc = $request->desc;

        $cat->save();

        return redirect('/goods');
    }

    public function edit($id)
    {
        if (!is_numeric($id)){
            abort(404);
        }

        $good=Good::find($id);
        $data['good'] = $good;
        return view('admin.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'desc' => 'required|min:5',
        ]);

        $good = Good::find($id);
        $good->name = $request->name;
        $good->category_id = $request->category_id;
        $good->price = $request->price;
        $good->image = $request->file('good_image');
        $good->desc = $request->desc;
        $good->save();

//        return redirect('admin/edit/'.$good->id);
        return redirect('/goods');
    }

    public function destroy($id)
    {
        $good=Good::find($id);
        $good->delete();
        //Post::destroy($id);

        return redirect('goods/');
    }


    public function edit_cat($id)
    {
        if (!is_numeric($id)){
            abort(404);
        }

        $cat=Category::find($id);
        $data['cat'] = $cat;
        return view('admin.edit-cat', $data);
    }

    public function update_cat(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'desc' => 'required|min:5',
        ]);

        $cat = Category::find($id);
        $cat->name = $request->name;
        $cat->desc = $request->desc;
        $cat->save();

//        return redirect('admin/edit/'.$good->id);
        return redirect('/goods');
    }

    public function destroy_cat($id)
    {
        $cat=Category::find($id);
        $cat->delete();
        //Post::destroy($id);

        return redirect('/goods/categories');
    }
}