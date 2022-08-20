<?php

namespace DummyNamespace\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DummyNamespace\Entities\DummyEntity;

class DummyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = DummyEntity::all();

        return view("DummySlug::index" , compact('list'));
    }
}