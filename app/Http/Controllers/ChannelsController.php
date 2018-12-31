<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ChannelsController extends Controller
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
        $things_id = $_GET['id'];
        $channels = \DB::table('channels')
            ->select('channels.id', 'channels.name', 'channels.description', 'channels.type_id', 'type.name as type_name', 'channels.value')
            ->join('type', 'channels.type_id', '=', 'type.id')
            ->where('things_id', $things_id)
            ->get();
        return view('channels.index')->with('channels', $channels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ids = explode('=', request()->headers->get('referer'));
        $id = $ids[1];
        $types = \DB::table('type')->get();
        return view('channels.form_create', compact('types', 'id'));
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
        $insert = \DB::table('channels')->insert([
            'name' => request('name'),
            'description' => request('description'),
            'created_at' => date('Y-m-d H:i:s'),
            'type_id' => request('type'),
            'things_id' => request('things_id')
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
}
