<?php

namespace Techademia\Http\Controllers;

use Techademia\Category;
use Illuminate\Http\Request;
use Techademia\Http\Requests;

/**
 * Class CategoryController
 * @package Techademia\Http\Controllers
 */
class CategoryController extends Controller
{

    /**
     * Constructor
     */
    public function __construct() {}

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
        $this->validate($request, [
            'title'     => 'required',
        ]);

        $data = $request->all();
        Category::create($data);

        return redirect()->back()->with('status', 'success!');
    }
}
