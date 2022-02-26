<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Models\Airline;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $msg        = 'You dont have permissions';
        $success    = false;
        $items      = [];
        if(Auth::user()->can('read_flight')){
            $items      = Flight::with('airline','departure','destination')->get();
            $msg        = 'Permission granted';
            $success    = true;
        }
        return response()->json(['flights' =>$items,'msg'=>$msg,'success'=>$success]);

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

            if(Auth::user()->can('create_flight')){
                $request->validate([
                    'code'              => 'required',
                    'type'              => 'required',
                    'departure_id'      => 'required',
                    'departure_time'    => 'required',
                    'destination_id'    => 'required',
                    'arrival_time'      => 'required',
                    'airline_id'        => 'required',
                ]);

                if(is_null($this->checkCode($request->code))){

                    $request->only('code','type','departure_id','departure_time','destination_id','arrival_time','airline_id');
                    $model = Flight::create($request->post());
                    if($model){
                        $success = true;
                        $msg     = 'Record created successfully';
                    }
                }else{
                    $msg .= ' Code in use';
                }
            }else{
                $msg .= ' You dont have permissions';
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

        return Flight::where('code',$code)
            ->where(function ($q) use ($id){
                if(!is_null($id)){
                    $q->where('id','!=',$id);
                }
            })
            ->first();
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

            if(Auth::user()->can('update_flight')){
                $request->validate([
                    'code'              => 'required',
                    'type'              => 'required',
                    'departure_id'      => 'required',
                    'departure_time'    => 'required',
                    'destination_id'    => 'required',
                    'arrival_time'      => 'required',
                    'airline_id'        => 'required',
                ]);

                $model = Flight::find($request->get('id'));

                if($model){

                    if(is_null($this->checkCode($request->code,$model->getKey()))){
                        $request->only('code','type','departure_id','departure_time','destination_id','arrival_time','airline_id');
                        $model->update($request->post());
                        $success = true;
                        $msg     = 'Record edited successfully';
                    }else{
                        $msg .= ' Code in use';
                    }
                }
            }else{
                $msg .= ' You dont have permissions';
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

            if(Auth::user()->can('delete_flight')){
                $model = Flight::find($id);
                if($model){
                    $model->delete();
                    $success = true;
                    $msg     = 'Record deleted successfully';
                }else{
                    $msg = 'Record not found';
                }
            }else{
                $msg .= ' You dont have permissions';
            }




        }catch(Exception $e){
            $msg = $e->getMessage();
        }
        return response()->json(['success'=>$success,'msg'=>$msg]);
    }
}
