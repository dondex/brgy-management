<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officials;

class OfficialController extends Controller
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

    public function getOfficial(Request $request){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $order = ['captain', 'secretary', 'treasurer', 'councilor', 'sk'];

        $officials_data = Officials::where('year', '=', $request->year ?? '')->orderByRaw("FIELD(position, '" . implode("','", $order) . "')")->get();
        $officials_year = Officials::distinct()->orderBy('year')->pluck('year');

        return view('admin.official')->with(['officials_data' => $officials_data, 'officials_year' => $officials_year]);
    }

    public function getOfficialPublic(){
        $order = ['captain', 'secretary', 'treasurer', 'councilor', 'sk'];

        $officials_data = Officials::where('year', '=', '')->orderByRaw("FIELD(position, '" . implode("','", $order) . "')")->get();

        return view('resident.about')->with(['officials_data' => $officials_data]);
    }

    public function updateOfficial(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'image',
        ];

        $attribNames = [
            'name' => 'Name',
            'img' => 'Image',
        ];

        $this->validate($request, $rules, [], $attribNames);

        if(!empty($request->img)){
            $img_path = $request->file('img')->store('officials', 'public');
        }

        $officials = Officials::findOrFail($request->official_id);
        $officials->name = $request->name ?? $officials->name;
        $officials->img = $img_path ?? $officials->img;
        $officials->save();

        session()->flash('update-success');
        return back();
    }

    public function archiveOfficial(Request $request){
        $rules = [
            'year' => 'numeric|required',
        ];

        $attribNames = [
            'year' => 'Year',
        ];

        $this->validate($request, $rules, [], $attribNames);

        $officials = Officials::where('status', '=', 'current')->get();

        foreach ($officials as $official) {
            $official->year = $request->year;
            $official->status = 'archived';
            $official->save();
        }

        Officials::insert([
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'captain',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'secretary',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'treasurer',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'councilor',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Dela Cruz',
                'position' => 'sk',
                'year' => '',
                'status' => 'current',
                'img' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        session()->flash('archive-success');
        return back();
    }
}
