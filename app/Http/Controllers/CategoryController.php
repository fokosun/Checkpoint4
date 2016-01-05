<?php

namespace Techademia\Http\Controllers;

use Auth;
use Validator;
use Techademia\Category;
use Illuminate\Http\Request;
use Techademia\Http\Requests;
use Techademia\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title'         => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        $data = $request->all();
        Category::create($data);

        return redirect()->back()->with('status', 'success!');
    }
}
