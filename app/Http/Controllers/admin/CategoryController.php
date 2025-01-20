<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\CategoryTranslation;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $query = $request->get('query'); // Get the search query
    // Perform the search query
    $category = Category::where('name', 'LIKE', "%$query%")
                       ->paginate(5);

    // If it's an AJAX request, return only the view without the full page
    if ($request->ajax()) {
        return response()->json([
            'html' => view('admin.category.category_search', compact('category'))->render()
        ]);
    }

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

        $this->createTranslations($category, $request->name);

        return redirect()->route('categories.index')->with('success', 'Category has been created successfully');
    }
    private function createTranslations($category, $name)
    {
        $translator = new GoogleTranslate();
        $languages = ['hi', 'pa'];  // Specify the languages you want to support (e.g., Hindi, Punjabi)

        // Translate the category name to each language and store in category_translations table
        foreach ($languages as $locale) {
            $translator->setTarget($locale);
            $translatedName = $translator->translate($name);

            CategoryTranslation::updateOrCreate(
                ['category_id' => $category->id, 'locale' => $locale],
                ['name' => $translatedName]
            );
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $translations = $category->translations;
        return view('admin.category.category_edit', compact('category','translations'));
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

        $this->updateTranslations($category, $request->name);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    private function updateTranslations($category, $name)
    {
        $translator = new GoogleTranslate();
        $languages = ['hi', 'pa']; // Languages to update (e.g., Hindi, Punjabi)

        foreach ($languages as $locale) {
            $translator->setTarget($locale);
            $translatedName = $translator->translate($name);

            CategoryTranslation::updateOrCreate(
                ['category_id' => $category->id, 'locale' => $locale],
                ['name' => $translatedName]
            );
        }
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
