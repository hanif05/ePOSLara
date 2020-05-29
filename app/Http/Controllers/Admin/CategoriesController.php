<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session['title'] = \Lang::get('title.categories');
        request()->session()->put($session);

        if (request()->search) {
            if (request()->search != null) {
                $data = Category::where('name', 'like', '%'.request()->search.'%')->paginate(10);
            }
        } else {
            $data = Category::orderBy('created_at', 'desc')->paginate(10);
        }
        
        $dataAll = Category::where('parent_id', 0)->orderBy('created_at', 'desc')->get();

        return view('admin.categories.index', compact('data', 'dataAll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $data['name'] = $request->category_name;
        $data['slug'] = Str::slug($data['name']);
        $data['parent_id'] = $request->parent_id;
        
        if (Category::create($data)) {
            $notif = [
                'status' => 'success',
                'head' => \Lang::get('validation.success'),
                'message' => \Lang::get('validation.category_success')
            ];
        }
        return redirect()->route('categories.index', app()->getLocale())->with($notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, Category $category)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $lang, Category $category)
    {
        $data['name'] = $request->category_name;
        $data['slug'] = Str::slug($data['name']);
        $data['parent_id'] = $request->id_parent;

        if ($category->update($data)) {
            $notif = [
                'status' => 'success',
                'head' => \Lang::get('validation.success'),
                'message' => \lang::get('validation.category_update'),
            ];
        }
        return redirect()->route('categories.index', $lang)->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, Category $category)
    {
        if ($category->delete()) {
            $notif = [
                'status' => 'success',
                'head' => \Lang::get('validation.success'),
                'message' => \lang::get('validation.category_delete'),
            ];

            return response()->json($notif);
        }
        
    }
}
