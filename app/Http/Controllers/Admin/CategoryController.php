<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Can;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorys = Category::paginate(5);
        return view("admin.categories.index", ["categorys" => $categorys]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $superCategory = Category::where('type', 0)->get();
        return view("admin.categories.create", ["superCategory" => $superCategory]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'          => ["required", "min:3", "unique:categories,name"],
            'description'   => ["required", "min:20"],
            'type'          => ['required']
        ]);

        Category::create($request->all());
        return to_route("admin.categories.create")->with("success", "Create Category Successfully!!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $category)
    {
        //
        $category = Category::find($category);
        if (is_null($category)) {
            return to_route("admin.categories.index")->with("alert", "The Category Is Not Exists");
        }
        return view("admin.categories.show", ["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $category)
    {
        //
        $superCategory = [];

        $category = Category::find($category);
        if (is_null($category)) {
            return to_route("admin.categories.index")->with("alert", "The Category Is Not Exists");
        }



        if ($category->type == 0) {
            $subCount = Category::where("type", $category->id)->count();
            if ($subCount == 0) {
                $superCategory = Category::where('type', 0)->where("id", "!=", $category->id)->get();
            }
        } else {
            $superCategory = Category::where('type', 0)->get();
        }



        return view("admin.categories.edit", ["category" => $category, "superCategory" => $superCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $category)
    {
        //
        $category = Category::find($category);
        if (is_null($category)) {
            return to_route("admin.categories.index")->with("alert", "The Category Is Not Exists");
        }

        $request->validate([
            'name'          => ["required", "min:3", Rule::unique("categories", "name")->ignore($category->id)],
            'description'   => ["required", "min:20"],
            'type'          => ['required']
        ]);

        $category->update($request->all());

        return to_route("admin.categories.edit", ["category" => $category->id])->with("success", "Update Category Successfully!!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $category)
    {
        //
        $category = Category::find($category);
        if (is_null($category)) {
            return to_route("admin.categories.index")->with("alert", "The Category Is Not Exists");
        }
        if ($category->type == 0) {
            $subCount = Category::where("type", $category->id)->count();
            if ($subCount == 0) {
                $category->delete();

                return to_route("admin.categories.index")->with("success", "Delete Category Successfully!!!");
            } else {
                return to_route("admin.categories.index")->with("alert", "I Can't Delete Super Category Successfully!!!");
            }
        } else {
            $category->delete();
            return to_route("admin.categories.index")->with("success", "Delete Category Successfully!!!");
        }
    }

    public function search(Request $request)
    {
        $search = htmlspecialchars($request->input("search"));
        $categorys = Category::where("name", "LIKE", "%{$search}%")
            ->paginate(5)
            ->appends(["search" => $search]); // يحافظ على الكلمة عند التنقل بين الصفحات

        if ($categorys->total() === 0) {
            return to_route("admin.categories.index")
                ->with("alert", "Not Found Any Categories Like $search");
        }

        return view("admin.categories.index", ["categorys" => $categorys])
            ->with("alert", "Found Categories Like $search");
    }
}
