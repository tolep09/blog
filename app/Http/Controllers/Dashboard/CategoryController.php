<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Category;
use App\Helpers\CustomUrl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryPost;
use App\Http\Requests\UpdateCategoryPut;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(3);
        return view('dashboard.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create')->with('category', new Category());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryPost $scp)
    {
        $urlClean = '';
        if ($scp->url_clean == '')
        {
            $urlClean = $scp->title;
        } else
        {
            $urlClean = $scp->url_clean;
        }

        $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($urlClean, '-', true));

        $request = $scp->validated();
        $request['url_clean'] = $urlClean;

        //dd($request['url_clean']);

        $validator = Validator::make($request, StoreCategoryPost::myRules());

        if ($validator->fails()) {
            return redirect('dashboard/categories/create')
                        ->withErrors($validator)
                        ->withInput();
        }


        Category::create($request);

        return back()->with('message', 'Categoria guardada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryPut $ucp, Category $category)
    {
        $category->update($ucp->validated());

        return back()->with('message', 'Categoria ' . $category->id . ' actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('message', 'Categoria ' . $category->id . ' eliminada con éxito');
    }
}
