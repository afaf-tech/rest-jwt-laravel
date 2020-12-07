<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Session;
use App\User;

class SessionController extends Controller
{
    //

    public function list(){
        return response([
            'status'=> 'OK',
            'data'=> Session::all()
        ], 200);
    }

    public function detail($id_session){
        $check = Session::firstWhere('id', $id_session);
        if(!$check){
            return response([
                'status' => 'Not Found',
                'message' => "Data Not Found"
            ], 404);
        }
        return response([
            'status'=> 'OK',
            'data'=> $check
        ], 200);
    }

    public function create(Request $request){
        // dd($request->json()->all()['name']);

        $validator = \Validator::make($request->all(),  [
            'userID' => 'required',
            'name' => 'required',
            'description' => 'required',
            'start' => 'required',
            'duration' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'status'=>"Error Request",
                'error' => $validator->messages()
            ],422) ;
        }

        if (!User::where('id', '=', $request->userID)->exists()) {
            return response([
                'status' => 'Not Found',
                'message' => "User ID Not Found"
            ], 404);
         }
        $date = strtotime($request->start);
        $insert = new Session;
        $insert->userID = $request->userID;
        $insert->name = $request->name;
        $insert->description = $request->description;
        $insert->start = date('Y-m-d H:i:s',$date);
        $insert->duration = $request->duration;
        $insert->save();
        return response([
            'status'=> 'OK',
            'message'=> 'Data Successfully Saved!',
            'data'=> $insert
        ], 200);
    }

    public function update(Request $request, $id_session){
        $check = Session::firstWhere('id', $id_session);
        if($check){
            $date = strtotime($request->start);

            $data = Session::find($id_session);
            $data->userID = $request->userID;
            $data->name = $request->name;
            $data->description = $request->description;
            $data->start = date('Y-m-d H:i:s',$date);
            $data->duration = $request->duration;
            $data->save();
            return response([
                'status'=> 'OK',
                'message'=> 'Data Successfully Updated!',
                'data'=> $data
            ], 200);
        }else{
            return response([
                'status' => 'Not Found',
                'message' => "Data Not Found"
            ], 404);        }
    }

    public function delete($id_session){
        $check = Session::firstWhere('id', $id_session);
        if ($check){
            Session::destroy($id_session);
            return response([
                'status'=> 'OK',
                'message'=> 'Data Succesfully Deleted!'
            ]);
        }else{
            return response([
                'status' => 'Not Found',
                'message' => "Data Not Found"
            ], 404);
        }
    }
}
