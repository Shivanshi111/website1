<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::latest()->paginate(5);
        return view('admin.category.category_list', compact('category'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $slug = Str::slug($request->input('name'), '-');

        $category = new Category;
        $category->name = $request->name;
        $category->slug = $slug;
        $category->status = $request->status;
        $category->image = $imagePath;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category has been created successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.category_edit', compact('category'));
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

        $category = Category::findOrFail($id);

        
        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            
            $imagePath = $request->file('image')->store('images', 'public');
        }

        
        $slug = Str::slug($request->input('name'), '-');

     
        $category->name = $request->name;
        $category->slug = $slug;
        $category->status = $request->status;
        $category->image = $imagePath;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }
}
