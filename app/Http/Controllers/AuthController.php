<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use App\Models\Residents;
use App\Models\Resets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request){
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $this->validate($request, $rules);

        $userCredentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if(Auth::guard('users')->attempt($userCredentials)){
            $user = Auth::guard('users')->user();

            if($user->status === 'active'){

                if ($user->type == 'admin') {
                    session([
                        'user_id' => $user->user_id,
                        'username' => $user->username,
                        'type' => 'admin'
                    ]);

                    return redirect('/dashboard');
                } else {
                    session([
                        'user_id' => $user->user_id,
                        'username' => $user->username,
                        'type' => 'resident'
                    ]);

                    return redirect('/home');   
                }
            }else{
                session()->flash('inactive-account');
                return back();
            }
        }else{
            session()->flash('invalid-login');
            return back();
        }
    }

    public function signup(Request $request){
        $rules = [
            'firstname' => 'required|max:30',
            'middlename' => 'required|max:30',
            'lastname' => 'required|max:30',
            'address' => 'required|max:200',
            'birthdate' => 'required|date',
            'nationality' => 'required|max:30',
            'gender' => 'required|in:male,female,lgbt',
            'civil_status' => 'required|in:single,married,widowed,separated',
            'occupation' => 'required|max:30',
            'phone' => 'required|numeric',
            'four_ps' => 'required',
            'valid_id' => 'required|image',
            'email' => 'required|email|max:50|unique:residents,email',
            'username' => 'required|max:50|unique:users,username',
            'password' => 'required|max:200',
            'c_password' => 'required|same:password'
        ];

        $attribNames = [
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'lastname' => 'Lastname',
            'address' => 'Address',
            'birthdate' => 'Birthdate',
            'nationality' => 'Nationality',
            'gender' => 'Gender',
            'civil_status' => 'Civil Status',
            'occupation' => 'Occupation',
            'phone' => 'Phone',
            'four_ps' => '4ps',
            'valid_id' => 'Valid ID',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'c_password' => 'Confirm Password'
        ];

        $this->validate($request, $rules, [], $attribNames);

        $users = new Users();
        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        $users->status = 'active';
        $users->type = 'resident';
        $users->save();

        $latestUser_id = Users::pluck('user_id')->last();
        $validId_path = $request->file('valid_id')->store('ids', 'public');

        $residents = new Residents();
        $residents->user_id = $latestUser_id;
        $residents->firstname = $request->firstname;
        $residents->middlename = $request->middlename;
        $residents->lastname = $request->lastname;
        $residents->address = $request->address;
        $residents->birthdate = $request->birthdate;
        $residents->nationality = $request->nationality;
        $residents->gender = $request->gender;
        $residents->civil_status = $request->civil_status;
        $residents->occupation = $request->occupation;
        $residents->phone = $request->phone;
        $residents->email = $request->email;
        $residents->valid_id = $validId_path;
        $residents->four_ps = $request->four_ps;
        $residents->verified = 'pending';
        $residents->save();

        session()->flash('registraion-success');
        return redirect('/login');

    }

    public function sendCode(Request $request){
        $rules = [
            'email' => 'required|email',
        ];

        $this->validate($request, $rules);

        $emailexist = Residents::where('email', '=', $request->email)->first();

        if(!$emailexist){
            session()->flash('email-notexist');
            return back();
        }

        $characters = '0123456789';
        $code = '';

        for ($i = 0; $i < 6; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        $resets = new Resets();
        $resets->email = $request->email;
        $resets->code = $code;
        $resets->save();

        Mail::send('mail.sendcode', ['content' => ['code' => $code]], function ($message) use ($request) {
            $message->to($request->email)->subject('Password Reset Request');
        });

        session()->flash('send-success');
        return view('authentication.forgot')->with(['email' => $request->email]);
    }

    public function checkCode(Request $request){
        session()->forget('send-success');

        $rules = [
            'email' => 'required|email',
            'code' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $resetexists = Resets::where('email', '=', $request->email)->where('code', '=', $request->code)->latest()->first();

        if(!$resetexists){
            session()->flash('invalid-code');
            return view('authentication.forgot')->with(['email' => $request->email]);
        }

        $resetCreatedAt = Carbon::parse($resetexists['created_at']);
        $currentDateTime = Carbon::now();

        if($currentDateTime->greaterThan($resetCreatedAt->addMinutes(10))){
            session()->flash('code-expired');
            return view('authentication.forgot')->with(['email' => $request->email]);
        }else{
            session()->flash('code-success');
            return view('authentication.forgot')->with(['email' => $request->email]);
        }
    }

    public function resetPass(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|max:200',
        ];

        $this->validate($request, $rules);

        $user_id = Residents::where('email', '=', $request->email)->pluck('user_id')->first();

        $users = Users::findOrFail($user_id);
        $users->password = bcrypt($request->password);
        $users->save();

        session()->flash('reset-success');
        return redirect('/login');
    }

    public function changePass(Request $request){
        $rules = [
            'ct_password' => 'required',
            'new_password' => 'required|max:200',
            'co_password' => 'required|same:new_password'
        ];

        $attribNames = [
            'ct_password' => 'Current Password',
            'new_password' => 'New Password',
            'co_password' => 'Confirm Password'
        ];

        $this->validate($request, $rules, [], $attribNames);

        $userCredentials = [
            'username' => session('username'),
            'password' => $request->ct_password,
        ];

        if(Auth::guard('users')->attempt($userCredentials)){
            $user_id = Users::where('username', '=', session('username'))->pluck('user_id')->first();

            $users = Users::findOrFail($user_id);
            $users->password = bcrypt($request->new_password);
            $users->save();

            session()->forget('user_id');
            session()->forget('username');
            session()->forget('type');
    
            session()->flush();

            session()->flash('change-success');
            return redirect('/login');
        }else{
            session()->flash('wrong-pass');
            return back();
        }

        $this->validate($request, $rules, [], $attribNames);
    }

    public function logout(){
        session()->forget('user_id');
        session()->forget('username');
        session()->forget('type');

        session()->flush();

        return redirect('/home');
    }

    public function createAdmin(){
        $users = new Users();
        $users->username = 'admin';
        $users->password = bcrypt('admin');
        $users->status = 'active';
        $users->type = 'admin';
        $users->save();

        return redirect('/login');
    }
}
