<?php

namespace App\Http\Controllers;

use App\Models\BookedApiRecord;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    //
    public function Statistics(Request $request){
        $date = $request->date; 
        if($date != 'null,null'){
            $date = explode(',',$date);
            $data =   BookedApiRecord::whereBetween('appointment_start_date', $date)->get();
        }else{
            $data =   BookedApiRecord::all();
        }
      
      $tcoIds = User::where('role','tco')->get('id')->pluck('id');
      $salesIds = User::where('role','sales')->get('id')->pluck('id');
      $Consultations = $data->count();
      $Cancelled  = $data->where('outcome', 'cancelled')->count();
      $DidNotAttend = $data->where('outcome', 'did not attend')->count();
      $NotSuitable = $data->where('outcome', 'not suitable')->count();
      $AttendedAndSuitable = $data->where('outcome', 'attended and suitable')->count();
      $TotalNumberofConverted = $data->where('converted_by_id', '!=' , null)->count();
      $TotalValueofConverted = $data->where('converted_by_id', '!=' , null)->sum('value');
      $TotalValueofTCO = $data->whereIn('tco_id', $tcoIds)->sum('value');
      //Total Value of After Sales conversions
      //$TotalValueofASC = $TotalValueofConverted - $TotalValueofTCO;
      $TotalValueofASC = $data->whereIn('converted_by_id', $salesIds)->sum('value');
      //Patients Converted on first visit
      $FirstVisitConverted = $data->where('converted_by_id', '!=' , null)->where('called_day_before_id', null)->count();
      //Patients Converted by AftersAles
     // $AfterSalesConverted = $data->where('converted_by_id', '!=' , null)->where('called_day_before_id', '!=' , null)->count();
      $AfterSalesConverted =   $data->whereIn('converted_by_id', $salesIds)->count();
     //$TotalValueofConvertedPrecentage = ($TotalValueofConverted / $TotalNumberofConverted) * 100;

     //Conversions CONVERTED BY,PATIENTS SEEN,PATIENTS CONVERTED,CONVERSION PERCENTAGE,CONVERSION VALUE
  

     $Conversions = BookedApiRecord::all()->where('converted_by_id', '!=' , null)->when($date,  function ($query, $date) {
        if($date != 'null,null'){
            return $query->whereBetween('appointment_start_date', $date);
        }
    })->groupBy('converted_by_id')->map(function ($item, $key) {
        return [
            'converted_by_id' => $key,
            'converted_by_name' => User::find($key)->name,
            'patients_seen' => $item->count(),
            'patients_converted' => $item->where('outcome', 'attended and suitable')->count(),
            'conversion_percentage' => ($item->where('outcome', 'attended and suitable')->count() / $item->count()) * 100,
            'conversion_value' => $item->sum('value'),
        ];
    });
    $ConversionsTotalValue = $Conversions->sum('conversion_value');
    //Consultations by practitioner CONSULTATION WITH, PATIENTS SEEN, PATIENTS CONVERTED, CONVERSION PERCENTAGE, CONVERSION VALUE
    $ConsultationsByPractitioner = BookedApiRecord::all()->when($date,  function ($query, $date) {
        if($date != 'null,null'){
            return $query->whereBetween('appointment_start_date', $date);
        }
    })->groupBy('practitioner_id')->map(function ($item, $key) {
        return [
            'practitioner_id' => $key,
            'practitioner_name' => $item->first()->practitioner_name,
            'patients_seen' => $item->count(),
            'patients_converted' => $item->where('outcome', 'attended and suitable')->count(),
            'conversion_percentage' => ($item->where('outcome', 'attended and suitable')->count() / $item->count()) * 100,
            'conversion_value' => $item->sum('value'),
        ];
    });
    $ConsultationsByPractitionerTotalValue = $ConsultationsByPractitioner->sum('conversion_value');

      return [
            'Consultations' => $Consultations,
            'Cancelled' => $Cancelled,
            'DidNotAttend' => $DidNotAttend,
            'NotSuitable' => $NotSuitable,
            'AttendedAndSuitable' => $AttendedAndSuitable,
            'TotalNumberofConverted' => $TotalNumberofConverted,
            'TotalValueofConverted' => $TotalValueofConverted,
            'TotalValueofTCO' => $TotalValueofTCO,
            'TotalValueofASC' => $TotalValueofASC,
            'FirstVisitConverted' => $FirstVisitConverted,
            'AfterSalesConverted' => $AfterSalesConverted,
            'Conversions' => $Conversions,
            'ConversionsTotalValue' => $ConversionsTotalValue,
            'ConsultationsByPractitioner' => $ConsultationsByPractitioner,
            'ConsultationsByPractitionerTotalValue' => $ConsultationsByPractitionerTotalValue,
            //'TotalValueofConvertedPrecentage' => $TotalValueofConvertedPrecentage,

      ];
    
    }
}
