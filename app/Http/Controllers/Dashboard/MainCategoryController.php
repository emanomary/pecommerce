<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainCategoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id','desc')->paginate(PAGINATION_COUNT);
        return view('dashboard.maincategories.index',compact('categories'));
    }

    public function create()

    {
        //$categories = Category::select('id','parent_id')->get();
        $categories = Category::parent()->get();
        return view('dashboard.maincategories.create',compact('categories'));
    }

    public function store(MainCategoryRequest $request)
    {
        try{
            DB::beginTransaction();

            $this->changeStatus($request);

            if ($request->type == 1)
                $request->request->add(['parent_id' => null]);

            $category = Category::create($request->except('_token'));

            //save translations
            $category->name = $request->name;
            $category->save();

           DB::commit();
            return redirect()->route('maincategories.index')->with(['success' => __('messages.successAddCategory')]);

        }catch (\Exception $ex)
        {
            DB::rollBack();
            return redirect()->route('maincategories.index')->with(['error' => __('messages.errorAddCategory')]);
        }

    }

    public function edit($id)
    {
        $category = Category::find($id);

        if(!$category)
            return redirect()->route('maincategories.index')->with(['error' => __('messages.errorNotFoundMainCategory')]);

        return view('dashboard.maincategories.edit',compact('category'));

    }

    public function update($id,MainCategoryRequest $request)
    {
        try{
            //update database
            //update status
            $this->changeStatus($request);

            $category = $this->getCategoryById($id);

            if(!$category)
                return redirect()->route('maincategories.index')->with(['error' => __('messages.errorNotFoundMainCategory')]);

            DB::beginTransaction();

            $category->update($request->all());
            //save translations
            $category->name = $request->name;
            $category->save();

            DB::commit();

            return redirect()->route('maincategories.index')->with(['success' => __('messages.successUpdateCategory')]);

        }catch(\Exception $ex)
        {
            return redirect()->route('maincategories.index')->with(['error' => __('messages.errorUpdateCategory')]);
        }

    }

    public function delete($id)
    {
        try{
            $category = $this->getCategoryById($id);

            if(!$category)
                return redirect()->route('maincategories.index')->with(['error' => __('messages.errorNotFoundMainCategory')]);

            $category->delete();

            return redirect()->route('maincategories.index')->with(['success' => __('messages.successDeleteCategory')]);
        }catch (\Exception $ex)
        {
            return redirect()->route('maincategories.index')->with(['error' => __('messages.errorUpdateCategory')]);
        }

    }

    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    public function changeStatus($request)
    {
        if (!$request->has('is_active'))
             $status = $request->request->add(['is_active' => 0]);
        else
            $status = $request->request->add(['is_active' => 1]);
    }
}
