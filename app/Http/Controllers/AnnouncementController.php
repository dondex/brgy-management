<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcements;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
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

    public function getLandingAnnouncements(){
        $announcements_data = Announcements::latest()->take(10)->get();

        return view('resident.home')->with(['announcements_data' => $announcements_data]);
    }

    public function getAnnouncements(){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $announcements_data = Announcements::latest()->get();

        return view('admin.announcement')->with(['announcements_data' => $announcements_data]);
    }

    public function postAnnouncement(Request $request){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'img' => 'required|image',
        ];

        $attribNames = [
            'title' => 'Title',
            'description' => 'Description',
            'img' => 'Image',
        ];

        $this->validate($request, $rules, [], $attribNames);

        $img_path = $request->file('img')->store('posts', 'public');

        $announcements = new Announcements();
        $announcements->title = $request->title;
        $announcements->description = $request->description;
        $announcements->image = $img_path;
        $announcements->save();

        session()->flash('announcement-success');
        return back();
    }

    public function updateAnnouncement(Request $request){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'img' => 'image',
        ];

        $attribNames = [
            'title' => 'Title',
            'description' => 'Description',
            'img' => 'Image',
        ];

        $this->validate($request, $rules, [], $attribNames);

        if(!empty($request->img)){
            $old_img = Announcements::where('announcement_id', '=', $request->announcement_id)->pluck('image')->first();
            Storage::delete('public/' . $old_img);
            $img_path = $request->file('img')->store('posts', 'public');
        }

        $announcements = Announcements::findOrFail($request->announcement_id);
        $announcements->title = $request->title ?? $announcements->title;
        $announcements->description = $request->description ?? $announcements->description;
        $announcements->image = $img_path ?? $announcements->image;
        $announcements->save();

        session()->flash('update-success');
        return back();
    }

    public function deleteAnnouncement(Request $request){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $announcements = Announcements::findOrFail($request->announcement_id)->delete();

        session()->flash('delete-success');
        return back();
    }
}
