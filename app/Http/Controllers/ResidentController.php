<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residents;
use Illuminate\Support\Facades\Storage;

class ResidentController extends Controller
{
    private function checkSession(){
        if(session()->missing('user_id')){
            return redirect('/login');
        }

        if(session()->has('type')){
            if(session('type') == 'resident'){
                return redirect('/home');
            }
        }
    }

    public function getResidents(){
        if ($this->checkSession()) {
            return $this->checkSession();
        }
        
        $residents_data = Residents::where('verified', '=', 'yes')->orderBy('firstname', 'desc')->get();

        return view('admin.resident')->with(['residents_data' => $residents_data]);
    }

    public function getResidentProfile(){
        if(session()->missing('user_id')){
            return redirect('/login');
        }

        $profile_data = Residents::where('user_id', '=', session('user_id'))->first()->get();

        return view('resident.profile')->with(['profile_data' => $profile_data]);
    }

    public function updateProfile(Request $request){
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
            'valid_id' => 'image',
            'email' => 'required|email|max:50',
            'username' => 'required|max:50',
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
        ];

        $this->validate($request, $rules, [], $attribNames);

        if(!empty($request->valid_id)){
            $old_validId = Residents::where('resident_id', '=', $request->resident_id)->pluck('valid_id')->first();
            Storage::delete('public/' . $old_validId);
            $validId_path = $request->file('valid_id')->store('ids', 'public');
        }

        $residents = Residents::findOrFail($request->resident_id);
        $residents->firstname = $request->firstname ?? $residents->firstname;
        $residents->middlename = $request->middlename ?? $residents->middlename;
        $residents->lastname = $request->lastname ?? $residents->lastname;
        $residents->address = $request->address ?? $residents->address;
        $residents->birthdate = $request->birthdate ?? $residents->birthdate;
        $residents->nationality = $request->nationality ?? $residents->nationality;
        $residents->gender = $request->gender ?? $residents->gender;
        $residents->civil_status = $request->civil_status ?? $residents->civil_status;
        $residents->occupation = $request->occupation ?? $residents->occupation;
        $residents->phone = $request->phone ?? $residents->phone;
        $residents->email = $request->email ?? $residents->email;
        $residents->valid_id = $validId_path ?? $residents->valid_id;
        $residents->four_ps = $request->four_ps ?? $residents->four_ps;
        $residents->verified = 'pending';
        $residents->save();

        session()->flash('update-success');
        return back();
    }
}
