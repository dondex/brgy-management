<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Residents;
use App\Models\Documents;
use App\Models\Users;
use App\Models\Announcements;

class DashboardController extends Controller
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

    public function getDashboard(){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $unverified_residents = Residents::where('verified', '=', 'pending')->latest()->get();
        $count_approved = Documents::where('status', '=', 'approved')->count();
        $count_pending = Documents::where('status', '=', 'pending')->count();
        $count_declined = Documents::where('status', '=', 'declined')->count();
        $count_residents = Residents::count();
        $count_announcements = Announcements::count();
        $count_fourPs = Residents::where('four_ps', '=', 'yes')->count();

        return view('admin.dashboard')->with(['unverified_residents' => $unverified_residents, 'count_approved' => $count_approved, 'count_pending' => $count_pending, 'count_declined' => $count_declined, 'count_residents' => $count_residents, 'count_announcements' => $count_announcements, 'count_fourPs' => $count_fourPs]);
    }

    public function acceptVerify(Request $request){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $resident_email = Residents::where('resident_id', '=', $request->resident_id)->pluck('email')->first();

        $residents = Residents::findOrFail($request->resident_id);
        $residents->verified = 'yes';
        $residents->save();

        echo $resident_email;

        Mail::send('mail.acceptverify', ['content' => 'na'], function ($message) use ($resident_email) {
            $message->to($resident_email)->subject('Account Verification Approved!');
        });

        session()->flash('verify-success');
        return back();
    }

    public function declineVerify(Request $request){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $resident_email = Residents::where('resident_id', '=', $request->resident_id)->pluck('email')->first();

        $residents = Residents::findOrFail($request->resident_id);
        $residents->verified = 'no';
        $residents->save();

        Mail::send('mail.declineverify', ['content' => 'na'], function ($message) use ($resident_email) {
            $message->to($resident_email)->subject('Account Verification Declined!');
        });

        session()->flash('verify-decline');
        return back();
    }
}
?>