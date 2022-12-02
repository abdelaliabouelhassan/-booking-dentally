<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConvestionCollection;
use App\Models\BookedApiRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CollectBookedData extends Controller
{
    //

    public function store(Request $request){
        $record = new BookedApiRecord();
        $patient_birthday = $request->details['day'] . '-' . $request->details['month'] . '-' . $request->details['year'];
        $record->treatment_id = $request->treatments['id'];
        $record->treatment_name = $request->treatments['name'];
        $record->practitioner_id = $request->practitioner['id'];
        $record->practitioner_name = $request->practitioner['name'];
        $record->site_id = $request->practitioner['site_id'];
        $record->practitioner_image = $request->practitioner['image'];
        $record->appointment_start_date = Carbon::parse($request->availableTime['start_time']);
        $record->appointment_end_date =  Carbon::parse($request->availableTime['finish_time']);
        $record->appointment_duration = $request->availableTime['available_duration'];
        $record->patient_id = $request->details['id'];
        $record->patient_title = $request->details['title'];
        $record->patient_first_name = $request->details['first_name'];
        $record->patient_last_name = $request->details['last_name'];
        $record->patient_email = $request->details['email'];
        $record->patient_phone = $request->details['phone_number'];
        $record->patient_address = $request->details['address'];
        $record->patient_postcode = $request->details['postcode'];
        $record->patient_birthday =  $patient_birthday;
        $record->patient_image = $request->details['image'];
        $record->save();
        return response()->json(['success' => 'Record saved successfully.']);
    }

    public function check(Request $request){
      $record = BookedApiRecord::where('patient_email', $request->email)->orWhere('patient_phone',$request->phone)->first();
        if($record){
            return response()->json(['found' =>  true]);
        }else{
            return response()->json(['found' =>  false]);
        }
    }


    public function convestion(Request $request){
        $practitioners = $request->practitioner;
        $search = $request->search;
        $tco = $request->tco;
        $convention_user = $request->convention_user;
        $outcome = $request->outcome;
        $data = BookedApiRecord::where('patient_first_name', 'like', '%' . $search . '%')
        ->orWhere('practitioner_name', 'like', '%' . $search . '%')
        ->orWhere('patient_email', 'like', '%' . $search . '%')
        ->orWhere('patient_phone', 'like', '%' . $search . '%')
        ->orWhere('treatment_name', 'like', '%' . $search . '%')
        ->orWhere('practitioner_name', 'like', '%' . $search . '%')
        ->latest()->get()->when($practitioners, function ($query) use ($practitioners) {
            return $query->whereIn('practitioner_id', $practitioners);
        })
        ->when($tco, function ($query) use ($tco) {
            return $query->whereIn('tco_id', $tco);
        })
        ->when($convention_user, function ($query) use ($convention_user) {
            return $query->whereIn('converted_by_id', $convention_user);
        })
        ->when($outcome, function ($query) use ($outcome) {
            return $query->whereIn('outcome', $outcome);
        });
       
        return response()->json(ConvestionCollection::collection($data),200);
    }


    public function getTCO(){
      $tcos = User::where('role','tco')->get();
      return response()->json($tcos,200);
    }

    public function getConvetionUsers() {
        $conventionUsers = User::where('role','tco')->orWhere('role','sales')->get();
        return response()->json($conventionUsers,200);
    }

   
}
