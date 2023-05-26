<?php

namespace App\Http\Controllers;

use App\Models\Personalform;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;

class GaltechController extends Controller
{
    public function login()
    {

        return view("login");
    }

    public function checkLogin(Request $request)
    {
        $userdata = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $userdata = array(
            'email' => $request->email,
            'password' => $request->password
        );

        // attempt to do the login
        // dd($userdata);
        if (Auth::attempt($userdata)) {
            if (auth()->user()->status == 0) {
                return Redirect::to('/dashboard');
            } else {
                Auth::logout();
                return Redirect::to('/');
            }
        } else {
            // validation not successful, send back to form
            return Redirect::to('/')->withErrors('Invalid email or password.');
        }
    }

    // public function checkLogout(){
    //     Auth::logout();
    //     return Redirect::to ('/');
    // }

    public function logout()
    {
        Auth::logout(); // logging out user
        return Redirect::to('/'); // redirection to login screen
    }


    public function dashboard()
    {
        return view("dashboard");
    }
    public function add()
    {

        return view("addstudent");
    }

    public function list()
    {
        $student = Personalform::all();
        return view('liststudent', compact('student'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required',
            'phonenumber' => 'required|min:10|max:10',
            'emailaddress' => 'required||regex:/(.+)@(.+)\.(.+)/i',
            'country' => 'required',
            'language' => 'required',
            'username' => 'required',
            'emailaddress1' => 'required||regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'min:6',
            'confirmpassword' => 'required_with:password|same:password|min:6',
            'schoolname' => 'required',
            'boardname' => 'required',
            'universityname' => 'required',
            'coursename' => 'required',
            'experience1' => 'required',
            'position1' => 'required',
            'experience2' => 'required',
            'position2' => 'required',
            'experience3' => 'required',
            'position3' => 'required',
            'fileup' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Validation error occur',
                'error' => $validator->errors()->toArray(),
            ]);
        } else {
            // New filename create
            $fileName = time() . '.' . $request->fileup->extension();
            // // File save to upload folder
            $request->fileup->move(public_path('uploads'), $fileName);

            $data = $request->except('_token');
            $data['fileup'] = $fileName;

            // Create new data
            Personalform::create($data);
            return response()->json([
                'status' => 200,
                'message' => 'Successfully created the student'
            ]);
        };
    }

    public function edit($id)
    {
        $stud = Personalform::find($id);
        //  dd($stud);
        return view('edit', compact('stud'));
    }

    public function update(Request $request, $id)
    {
        $stud = Personalform::find($id);

        $data = $request->except('_token');
        // dd($data);

        $stud->update($data);
        return redirect('/liststudent');
    }


    public function delete($id)
    {
        $stud = Personalform::find($id);
        $stud->delete();
        return redirect('/liststudent');
    }

    //     // get the user by email
    // $user = User::where ('email', request ('email'))->first ();

    // // check if the user exists and the password matches
    // if ($user && Hash::check (request ('password'), $user->password)) {
    // // login the user and redirect to home page
    // Auth::login ($user);
    // return redirect ('/dashboard');
    // } else {
    // // return an error message
    // return back ()->with ('error', 'Invalid credentials');
    // }
    public function userregistration()
    {
        return view('/userregistration');
    }

    public function usercreate(Request $request)
     {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'lastname' => 'required',
            'phonenumber' => 'required|min:10|max:10',
            'email' => 'required|unique:users,email',
              'password' => 'required',
            'confirmpassword' => 'required_with:password|same:password|',
            'address' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Validation error occur',
                'error' => $validator->errors()->toArray(),
            ]);
        } else {
            $data = $request->except('_token','confirmpassword');
        //     // Create new data

            $data['password'] = Hash::make($request->password);
            User::create($data);
            return response()->json([
                'status' => 200,
                'message' => 'Successfully created the student'
            ]);
        };


        // ($request->all());
        // $data = $request->except('_token', 'confirmpassword');
        // $data['password'] = Hash::make($request->password);
        // User::create($data);
        // return redirect('/userregistration');
    }
}
