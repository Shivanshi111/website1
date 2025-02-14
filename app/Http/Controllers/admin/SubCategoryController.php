<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategories;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
  public function index()
{
    $subcategories = Subcategories::with('category')->paginate(5);
    return view('admin.category.subcategory', compact('subcategories'));
}


    public function create()
    {
        // Fetch all categories for the dropdown
        $categories = Category::all();
        return view('admin.category.create_subcategory', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
        ]);

        try {
            $subcategory = new Subcategories();
            $subcategory->name = $request->name;
            $subcategory->slug = \Str::slug($request->name);
            $subcategory->status = $request->status;
            $subcategory->categories_id = $request->categories_id;
            $subcategory->save();

            return redirect()->route('subcategories.index')->with('success', 'Sub Category has been created successfully');
        } catch (\Exception $e) {
            return redirect()->route('subcategories.index')->with('error', 'Failed to create subcategory: ' . $e->getMessage());
        }
    }
    public function edit($id){
        $subcategories = Subcategories::findOrFail($id);
        $categories = Category::all();
        return view('admin.category.edit_subcategory', compact('subcategories','categories'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
        ]);
        try{
            $subcategory = Subcategories::findOrFail($id);
            $subcategory->name = $request->name;
            $subcategory->slug = \Str::slug($request->name);
            $subcategory->status = $request->status;
            $subcategory->categories_id = $request->categories_id;
            $subcategory->save();
            return redirect()->route('subcategories.index')->with('success', 'Sub Category has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('subcategories.index')->with('error', 'Failed to update subcategory, Please fill Some different name');
        }
    }
    public function destroy($id){
        try{
            $subcategory = Subcategories::findOrFail($id);
            $subcategory->delete();
            return redirect()->route('subcategories.index')->with('success', 'Sub Category has been deleted successfully');
        }
        catch (\Exception $e) {
            return redirect()->route('subcategories.index')->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
