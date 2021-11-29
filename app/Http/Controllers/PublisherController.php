<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class PublisherController extends Controller
{
    public function readPublisher($id){
        return Publisher::findOrFail($id);
    }

    public function createPublisher(Request $request){
        $data = $request->all();
        
        try{
            $publisher = new Publisher;
            $publisher->name = $data['name'];
            $publisher->description = $data['description'];
            $publisher->url = $data['url'];

            $publisher->save();
            $status ="succes";
            return response()->json(compact('succes', 'publisher' ),200);

        } catch(\Throwable $th){
            $status = "failed";
            return response()->json(compact('status', 'th'),401);
        }
    }

    public function updatePublisher(Request $request){
        $data = $request->all();
        
        try{
            $publisher = Publisher::findOrFail($id);
            $publisher->name = $data['name'];
            $publisher->description = $data['description'];
            $publisher->url = $data['url'];

            $publisher->save();
            $status ="succes";
            return response()->json(compact('succes', 'publisher' ),200);

        } catch(\Throwable $th){
            $status = "failed";
            return response()->json(compact('status', 'th'),401);
        }
    }
}
