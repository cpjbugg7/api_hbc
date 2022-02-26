<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['airlines' =>Airline::all()]);

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
            ]);

            if(is_null($this->checkCode($request->code))){

                $model = Airline::create($request->post());
                if($model){
                    $success = true;
                    $msg     = 'Record created successfully';
                }
            }else{
                $msg .= ' Code in use';
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
            ]);

            $model = Airline::find($request->get('id'));

            if($model){

                if(is_null($this->checkCode($request->code,$model->getKey()))){
                    $request->only('name','code');
                    $model->update($request->post());
                    $success = true;
                    $msg     = 'Record edited successfully';
                }else{
                    $msg .= ' Code in use';
                }
            }

        }catch(Exception $e){
            $msg = $e->getMessage();
        }
        return response()->json(['success'=>$success,'msg'=>$msg,'model'=>$model]);

    }

    /**
     * @param $code
     * @param null $id
     * @return mixed
     */
    public function checkCode($code, $id = null){

        return Airline::where('code',$code)
            ->where(function ($q) use ($id){
                if(!is_null($id)){
                    $q->where('id','!=',$id);
                }
            })
            ->first();
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

            $model = Airline::find($id);

            if($model){
                $model->delete();
                $success = true;
                $msg     = 'Record deleted successfully';
            }else{
                $msg .= ' Record not found';
            }

        }catch(Exception $e){
            $msg = $e->getMessage();
        }
        return response()->json(['success'=>$success,'msg'=>$msg]);

    }
}
