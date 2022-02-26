<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['airports' =>Airport::all()]);
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
    public function store(Request $request)
    {
        $success = false;
        $msg     = 'Record could not be created.';
        $model   = null;
        try {

            $request->validate([
                'name' => 'required',
                'code' => 'required',
                'city' => 'required',
            ]);

            $model = Airport::create($request->post());

            if($model){
                $success = true;
                $msg     = 'Record created successfully';
            }

        }catch(Exception $e){
            $msg = $e->getMessage();
        }
        return response()->json(['success'=>$success,'msg'=>$msg,'model'=>$model]);

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
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $success = false;
        $msg     = 'Record could not be edited.';
        $model   = null;
        try {

            $request->validate([
                'id' => 'required',
                'name' => 'required',
                'code' => 'required',
                'city' => 'required',
            ]);

            $model = Airport::find($request->get('id'));

            if($model){
                $request->only('name','code','city');
                $model->update($request->post());
                $success = true;
                $msg     = 'Record edited successfully';
            }

        }catch(Exception $e){
            $msg = $e->getMessage();
        }
        return response()->json(['success'=>$success,'msg'=>$msg,'model'=>$model]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = false;
        $msg     = 'Record could not be deleted.';
        try {

            $model = Airport::find($id);

            if($model){
                $model->delete();
                $success = true;
                $msg     = 'Record deleted successfully';
            }else{
                $msg = 'Record not found';
            }

        }catch(Exception $e){
            $msg = $e->getMessage();
        }
        return response()->json(['success'=>$success,'msg'=>$msg]);
    }
}
