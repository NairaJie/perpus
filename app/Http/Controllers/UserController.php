<?php

namespace App\Http\Controllers;


use Carbon\Carbon; use App\Models\User; 
use Illuminate\Support\Str; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //untuk mengatur register
    public function registerUser(Request $request){
        //buat variable data 
        $data = $request->only(['name', 'email', 'password']);

        //validasi dri data user input
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|string|max:100',
                'email'=> 'required|string|email',
                'password' => 'required|string|min:6'
            ]
            );

            //jika validatornya gagal maka muncul error
            if($validator->fails()){
                $erros =$validator->errors();
                return response()->json(compact('error'), 401);
            }

            // buat user sesuai data tersebut
            $user = new User();
            $user -> name = $request->name;
            $user -> email = $request->email;
            $user -> password = Hash::make($request -> password);
            $user -> save ();

           return response()->json(compact('user'),200);

    }

    //fungsi login user
    public function loginUser(Request $request){
        
        //mencari user dri inputan user menggunakan email
        $user = User::where('email', $request['email'])->first();

        //auth attemp untuk mengecek apakah data sesuai (email dn password)
        if($user&&Hash::check($request->password,$user->password)){
            $token = Str::random(60);
            $user -> remember_token = $token;
            $user->save();
            return response()->json([
                "status"=>200,
                "message" => "success",
                "token" =>$token,
                "user"=>$user
            ],200);
        }
    }

    //fungsi logout, menghapus token dri databse
    public function logoutUser(Request $request){
         //cari 
         $user = User::where('remember_token', $request->bearerToken())->first();

         // klo user ada jdiin null 
         If($user){ 
             $user -> remember_token = null;
             $user -> save();
             return response()->json([
                 "status"=>200,
                 "message"=>"succeess",
             ],200);
         }
         return response()->json([
             "status"=>401,
             "message" => 'falied'
         ],401);

     }

     //fungsi untuk mendapatkan data 
     public function getUser($id){
         $user = User::find($id);
         return response()-> json(compact('user'),200);
     }

     //update user 
     public function updateUser($id, Request $request){
         $user = User::find($id);
         $input = $request->all();

         if (isset($request->name)){
             $user->name = $input['name'];
         }
         if (isset($request->email)){
             $user->email = $input['email'];
         }

         // cek ada apa ga 
         // dik dri adanya response dg key tertentu
         if($request->has('photo')){
             if(isset($user->profile_photo_path) || empty($user->profile_photo_path)){
                 Storage::disk('public')->delete($user->profile_photo_path);
             }
             $urlPath = $request->file('photo')->store('image/'.$id,'public');
             $user->profile_photo_path = $urlPath;
         }

         //save ke database
         $user->save();

         return response()->json(compact('user'),200);

     }

    //delete user 
    public function deleteUser($id){
        $user = User::find($id);
        $result = $user->delete();
          
        // menghaps gambar user 
        if(isset($user->profile_photo_path)|| !empty($user->profile_photo_path)){
            Storage::disk('public')->delete($user -> profilr_photo_path);
        }

        return response()->json(compact('result', 'user'), 200);
    }
}
