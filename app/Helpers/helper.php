<?php
use App\Models\Category;


function getCategories(){
    return Category::orderBy('name','DESC')->with('subcategories')->orderBy('id','DESC')->where('status',1)->get();
}
?>