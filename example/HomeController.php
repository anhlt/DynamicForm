<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->session()->get('_old_input');
        if(!$value)
            $value = [];

        $form = new FormDemo($value);
        return view('home', [
            'form' => $form
        ]);
    }

    public function save(Request $request)
    {
        $form = new FormDemo();
        $this->validate($request, $form->rules(), [], $form->field2label());

        return redirect()->back();
    }
}
