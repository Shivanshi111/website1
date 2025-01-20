<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategories;
use App\Models\SubcategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CategoryTranslation;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SubCategoryController extends Controller
{
  public function index(Request $request)
{
    // $subcategories = Subcategories::with('category')->paginate(5);
    $query = $request->get('query'); // Get the search query
    // Perform the search query
    $subcategories = Subcategories::with('category')
    ->where('name', 'LIKE', "%$query%")
    ->paginate(5);

    // If it's an AJAX request, return only the view without the full page
    if ($request->ajax()) {
        return response()->json([
            'html' => view('admin.category.subcategory_search', compact('subcategories'))->render()
        ]);
    }
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

            $this->createTranslations($subcategory, $request->name);

            return redirect()->route('subcategories.index')->with('success', 'Sub Category has been created successfully');
        } catch (\Exception $e) {
            return redirect()->route('subcategories.index')->with('error', 'Failed to create subcategory: ' . $e->getMessage());
        }
    }
    private function createTranslations($subcategory, $name)
    {
        $translator = new GoogleTranslate();
        $languages = ['hi', 'pa'];  // Specify the languages you want to support (e.g., Hindi, Punjabi)

        foreach ($languages as $locale) {
            $translator->setTarget($locale);
            $translatedName = $translator->translate($name);

            SubcategoryTranslation::updateOrCreate(
                ['subcategory_id' => $subcategory->id, 'locale' => $locale],
                ['name' => $translatedName]
            );
        }
    }
    public function edit($id){
        $subcategories = Subcategories::findOrFail($id);
        $categories = Category::all();
        $translations = $subcategories->translations()->get();  
        return view('admin.category.edit_subcategory', compact('subcategories','categories','translations'));
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

            $this->createTranslations($subcategory, $request->name);
            return redirect()->route('subcategories.index')->with('success', 'Sub Category has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('subcategories.index')->with('error', 'Failed to update subcategory, Please fill Some different name');
        }
    }
    private function updateTranslations($subcategory, $name)
    {
        $translator = new GoogleTranslate();
        $languages = ['hi', 'pa']; // Languages to update (e.g., Hindi, Punjabi)

        foreach ($languages as $locale) {
            $translator->setTarget($locale);
            $translatedName = $translator->translate($name);

            SubcategoryTranslation::updateOrCreate(
                ['subcategory_id' => $subcategory->id, 'locale' => $locale],
                ['name' => $translatedName]
            );
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
