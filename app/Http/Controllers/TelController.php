<?php

namespace App\Http\Controllers;

use App\Models\Tel;
use Exception;
use Illuminate\Http\Request;

class TelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tel::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'phone' => 'required|min:10',
            ], [
                'name.required' => 'Name is required!',
                'phone.required' => 'Min 10 digit phone is required!',
            ]);
            Tel::create($request->all());
            return response()->json([
                'msg' => 'Contact Created',
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tel  $tel
     * @return \Illuminate\Http\Response
     */
    public function show(Tel $tel)
    {
        return $tel;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tel  $tel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tel $tel)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'phone' => 'required|min:10',
            ],[
                'name.required' => 'Name is required!',
                'phone.required' => 'Min 10 digit phone is required!',
            ]);
            $tel->update();
            return response()->json([
                'msg' => 'Contact Updated',
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tel  $tel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tel $tel)
    {
        try {
            $tel->delete();
            return response()->json([
                'msg' => 'Contact Deleted',
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
