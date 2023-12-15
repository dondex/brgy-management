<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Documents;
use App\Models\Residents;
use App\Models\Users;

class DocumentController extends Controller
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

    public function getDocuments(){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $documents_data = Documents::with('resident')->latest()->get();

        return view('admin.document')->with(['documents_data' => $documents_data]);
    }

    public function requestDocument(Request $request){
        if(session()->missing('user_id')){
            return redirect('/login');
        }

        $rules = [
            'doc_type' => 'required|in:bc,cor,coi',
            'purpose' => 'required',
            'delivery' => 'required',
        ];

        $attribNames = [
            'doc_type' => 'Document Type',
            'purpose' => 'Purpose',
            'delivery' => 'Delivery',
        ];

        $this->validate($request, $rules, [], $attribNames);

        $resident_id = Users::with('resident')->where('user_id', '=', $request->user_id)->first();

        $documents = new Documents();
        $documents->resident_id = $resident_id->resident->resident_id;
        $documents->doc_type = $request->doc_type;
        $documents->purpose = $request->purpose;
        $documents->status = 'pending';
        $documents->delivery = $request->delivery;
        $documents->schedule = now();
        $documents->save();

        session()->flash('request-success');
        return back();
    }

    public function approveDocument(Request $request){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $delivery_type = Documents::where('document_id', '=', $request->document_id)->pluck('delivery')->first();

        if($delivery_type == 'email'){
            $rules = [
                'document' => 'required',
            ];

            $attribNames = [
                'document' => 'document',
            ];

            $this->validate($request, $rules, [], $attribNames);
        }

        $documents = Documents::findOrFail($request->document_id);
        $documents->status = 'approved';
        $documents->save();

        $resident_email = Residents::with(['document' => function ($query) use ($request) {$query->where('document_id', '=', $request->document_id); }])->pluck('email')->first();

        if($delivery_type == 'email'){
            $docPath = $request->file('document')->path();

            Mail::send('mail.acceptrequestmail', ['content' => 'na'], function ($message) use ($resident_email, $docPath) {
                $message->to($resident_email)->subject('Document Request Approved!')->attach($docPath, ['as' => 'doc.pdf', 'mime' => 'application/pdf']);
            });

            unlink($docPath);
        }else{
            Mail::send('mail.acceptrequestpick', ['content' => 'na'], function ($message) use ($resident_email) {
                $message->to($resident_email)->subject('Document Request Approved!');
            });
        }

        session()->flash('approve-success');
        return back();
    }

    public function declineDocument(Request $request){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $resident_email = Residents::with(['document' => function ($query) use ($request) {$query->where('document_id', '=', $request->document_id); }])->pluck('email')->first();

        $documents = Documents::findOrFail($request->document_id);
        $documents->status = 'declined';
        $documents->save();

        Mail::send('mail.declinerequest', ['content' => 'na'], function ($message) use ($resident_email) {
            $message->to($resident_email)->subject('Document Request Declined!');
        });

        session()->flash('decline-success');
        return back();
    }

    public function canRequestDocs(){
        if(session()->missing('user_id')){
            return redirect('/login');
        }else{
            $isVerified = Residents::where('user_id', '=', session('user_id'))->pluck('verified')->first();

            if($isVerified == 'yes'){
                return view('resident.document');
            }else{
                session()->flash('wait-verification');
                return back();
            }
        }
    }
}
