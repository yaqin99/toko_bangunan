<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth ; 


class UserController extends Controller
{
    public function signUp(){

         request()->validate([
             'nama' => 'required' , 
             'username' => 'required' , 
             'email' => 'required',
             'password' => 'required',
              
         ]);
         
        
         $dataAdmin = User::select('*')->where('name' , request()->nama)->first();
         $email = User::select('*')->where('email' , request()->email)->first();
         
         if ($dataAdmin  
         ) {
             return back()->with('exist' , 'Admin Sudah Ada');
         }
         if ($email  
         ) {
           
             return back()->with('email' , 'Email Sudah Ada');
         }
 
         $password = bcrypt(request()->password);
 
         $data = User::create([
            'name' => request()->nama , 
            'email' => request()->email , 
            'username' => request()->username , 
            'password' => $password , 
         ]);
         if($data){
             return redirect('/signIn')->with('success' , 'Admin Berhasil di Tambahkan');
         } else {
             return back()->with('fail' , 'Data Gagal di Tambahkan');
         }
     }



     public function signIn(Request $request)
     {
        $credentials =   $request->validate([
             'email' => 'required',
             'password' => ['required'],
         ]);
        //  $login = Auth::attempt($credentials ) ; 
        //  dd($request->username);
        //  if (auth()->attempt(['username' => $request->username , 'password' => $request->password])) {
            
        //     dd('berhasil');
        //     //  return redirect()->route('admin.adminDashboard');
        //  } 
         if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }  
        return back()->with('salah' , 'Login Gagal');

         
     }

     public function logOut(){
        Auth::logout();
        //$request dan request() itu sama aja 
    request()->session()->invalidate();
 
    request()->session()->regenerateToken();
 
    return redirect('/');
     }
}
