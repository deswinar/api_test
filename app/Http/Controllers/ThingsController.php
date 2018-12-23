<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ThingsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $things = \DB::table('things')->where('user_id', $user_id)->get();
        return view('things.index', compact('things'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('things.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $insert = \DB::table('things')->insert([
            'name' => request('name'),
            'description' => request('description'),
            'hardware' => request('hardware'),
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $user_id
        ]);
        return redirect('things');
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
    public function edit()
    {
        $id = $_GET['id'];
        $user_id = Auth::user()->id;
        $thing = \DB::table('things')->where('id', '=', $id)->where('user_id', $user_id)->first();
        // print_r($thing);die;
        return view('things.form_create')->with('thing',$thing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = \DB::table('things')->where('id', '=', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'hardware' => $request->hardware,
                'updated_at' => date('Y-m-d'),
            ]);
        return redirect('things');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function channels(){
        $id = $_GET['id'];
        $channels = \DB::table('channels')->where('id', $id)->get();
        return view('things.channels.index')->with('channels', $channels);
    }
}
