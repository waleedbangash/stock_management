<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.signup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'ad_name' => 'required',
            'ad_email'=>'required|unique:users,email',
            'ad_password'=>'required'
         ]);
         $ad_password=$request->ad_password;
         $conform_password=$request->conform_password;

         if($ad_password != $conform_password)
         {
            $request->session()->flash('msgs','your password doesnt maitch');
            return redirect('admin-signup');
           }
           else
           {
            $data=new User();
            $data->name=$request->ad_name;
            $data->email=$request->ad_email;
            $data->password=bcrypt($ad_password);
             $data->save();
           return redirect('admin-signup')->with('msg', 'you are success fully registerd please login ');
           }



    }
    public function adminlogin()
    {
        return view('admin.login');
    }
    public function adminstore(Request $request)
    {
        $this->validate($request,[
            'ad_email'=>'required|email',
            'ad_password'=>'required'
        ]);

        $email=$request->input('ad_email');
        $password=$request->input('ad_password');
       $data=User::where('email',$email)->first();

       if(!is_null($data))
       {

         if (Hash::check($request->ad_password, $data->password))
            {

                $request->session()->put('admin',$data);
                return redirect('admin-dashboard');
            }
            else
            {

                return redirect('admin-login')->with('msg','your emial or password is incorrct');
            }
        }
        else
            {

                return redirect('admin-login')->with('msg','pleas give the valid email and password');
            }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('admin');
        return redirect('admin-login')->with('msg','you are logout from the site');
    }
}
