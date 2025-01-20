<?php



namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Models\BrandTranslation;
use Stichoza\GoogleTranslate\GoogleTranslate;


class BrandsController extends Controller
{
    public function index(Request $request)
    {
        // $brand = Brand::latest()->paginate(5);
        $query = $request->get('query'); // Get the search query
        // Perform the search query
        $brand = Brand::where('name', 'LIKE', "%$query%")
                           ->paginate(5);
    
        // If it's an AJAX request, return only the view without the full page
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.brand.brand_search', compact('brand'))->render()
            ]);
        }
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
        $this->createTranslations($brand, $request->name);
        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
    }
    private function createTranslations($brand, $name)
{
    $translator = new GoogleTranslate();
    $languages = ['hi', 'pa'];

    foreach ($languages as $locale) {
        $translator->setTarget($locale);
        $translatedName = $translator->translate($name);

        BrandTranslation::updateOrCreate(
            ['brand_id' => $brand->id, 'locale' => $locale],
            ['name' => $translatedName]
        );
    }
}



    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $translations = $brand->translations()->get();
        return view('admin.brand.brand_edit', compact('brand','translations'));
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
        $this->createTranslations($brand, $request->name);
        return redirect()->route('brand.index')->with('success', 'brand updated successfully.');
    }
    private function updateTranslations($brand, $name)
{
    $translator = new GoogleTranslate();
    $languages = ['hi', 'pa'];

    foreach ($languages as $locale) {
        $translator->setTarget($locale);
        $translatedName = $translator->translate($name);

        BrandTranslation::updateOrCreate(
            ['brand_id' => $brand->id, 'locale' => $locale],
            ['name' => $translatedName]
        );
    }
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
