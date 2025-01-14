<?php



namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    public function index()
    {
        $brand = Brand::latest()->paginate(5);
        return view('admin.brand.brand_list', compact('brand'));
    }

    public function create()
    {
        return view('admin.brand.create_brand');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->status = $request->status;
        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
    }



    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.brand_edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $brand = Brand::findOrFail($id);
        $slug = Str::slug($request->input('name'), '-');
        $brand->name = $request->name;
        $brand->slug = $slug;
        $brand->status = $request->status;
        $brand->save();

        return redirect()->route('brand.index')->with('success', 'brand updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $brand = Brand::find($id);
            $brand->delete();
            return redirect()->route('brand.index')->with('success', 'Category has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('brand.index')->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }
}
