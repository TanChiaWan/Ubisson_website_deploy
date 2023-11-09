<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\patient;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{



    public function filterLogbook(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Filter your logbook data based on the date range and return it as JSON
    $filteredLogbook = Logbook::whereBetween('bg_logbook_date', [$startDate, $endDate])->get();

    return response()->json($filteredLogbook);
}
public function filterLogbookorg(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Filter your logbook data based on the date range and return it as JSON
    $filteredLogbook = Logbook::whereBetween('bg_logbook_date', [$startDate, $endDate])->get();

    return response()->json($filteredLogbook);
}
    


    public function updateLogbook(Request $request, $logbook_id)
    {
  
        $affectedRows = Logbook::where('logbook_id', $logbook_id)
            ->update(['bg_period' => $request->input('newPeriod')]);
            
      

        return response()->json(['message' => 'Logbook entry updated successfully']);
    }

   public function search(Request $request) {
    
    $request->validate([
        'criteria_1_glucose_hyper' => 'nullable|numeric|dependent_filled:criteria_2_glucose_hyper',
        'criteria_2_glucose_hyper' => 'nullable|numeric|dependent_filled:criteria_1_glucose_hyper',
        'criteria_1_pressure_hyper' => 'nullable|numeric|dependent_filled:criteria_2_pressure_hyper',
        'criteria_2_pressure_hyper' => 'nullable|numeric|dependent_filled:criteria_1_pressure_hyper',
    ]);

    $criteria1 = (float)$request->input('criteria_1_glucose_hyper');
$criteria2 = (float)$request->input('criteria_2_glucose_hyper');

    $criteria3 = $request->input('criteria_1_pressure_hyper');
    $criteria4 = $request->input('criteria_2_pressure_hyper');
    $patients = Patient::all();
    $period = $request->input('period_glucose_hyper');
    $duration = $request->input('duration_glucose_hyper');
    $startDate = null;
    $endDate = null;
    $startDate2 = null;
    $endDate2 = null;
    $duration2 = $request->input('duration_glucose_hyper2');
    if ($duration === 'yesterday') {
        $startDate = now()->subDay(1)->setTime(0, 0, 0);
        $endDate = now()->subDay(1)->setTime(23, 59, 59);
    } elseif ($duration === 'since 3 days') {
        $startDate = now()->subDays(3)->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'since a week') {
        $startDate = now()->subWeek()->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'since 2 weeks') {
        $startDate = now()->subWeeks(2)->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'today') {
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();
    }
    
    if ($duration2 === 'yesterday') {
        $startDate2 = now()->subDay(1)->setTime(0, 0, 0);
        $endDate2 = now()->subDay(1)->setTime(23, 59, 59);
    } elseif ($duration2 === 'since 3 days') {
        $startDate2 = now()->subDays(3)->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'since a week') {
        $startDate2 = now()->subWeek()->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'since 2 weeks') {
        $startDate2 = now()->subWeeks(2)->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'today') {
        $startDate2 = now()->startOfDay();
        $endDate2 = now()->endOfDay();
    }
    $results = Logbook::select('bg_level','bg_logbook_date','patient_id_FK','bg_period')->get();


        
  

    if ($startDate && $endDate) {
        $formattedStartDate = $startDate->format('Y-m-d H:i:s');
    $formattedEndDate = $endDate->format('Y-m-d H:i:s');
  
    $results = $results->whereBetween('bg_logbook_date', [$formattedStartDate, $formattedEndDate]);
    }

    if ($period !== 'all time') {
        $results = $results->where('bg_period', $period);
    }

    $results2 = Logbook::where(function ($query) use ($criteria3, $criteria4) {
        $query->whereBetween('bp_level2', [$criteria3, $criteria4])
            ->orWhereBetween('bp_level', [$criteria3, $criteria4]);
    })->get();

    if ($startDate2 && $endDate2) {
        $formattedStartDate = $startDate2->format('Y-m-d');
    $formattedEndDate = $endDate2->format('Y-m-d');

    $results2 = $results2->whereBetween('bp_logbook_date', [$formattedStartDate, $formattedEndDate]);
   
    }


    return view('hyper', [
        'results' => $results,
        'criteria1' => $criteria1,
        'criteria2' => $criteria2,
        'criteria3' => $criteria3,
        'criteria4' => $criteria4,
    
        'patients' => $patients,
        'results2' => $results2,
    ])->with('chartData', [
        'bg_level' => $results->pluck('bg_level')->toArray(),
        'bp_level' => $results2->pluck('bp_level')->toArray(),
        'bp_level2' => $results2->pluck('bp_level2')->toArray(),
    ]);
}

public function search2(Request $request) {
    $request->validate([
        'criteria_1_glucose_hyper' => 'nullable|numeric|dependent_filled:criteria_2_glucose_hyper',
        'criteria_2_glucose_hyper' => 'nullable|numeric|dependent_filled:criteria_1_glucose_hyper',
        'criteria_1_pressure_hyper' => 'nullable|numeric|dependent_filled:criteria_2_pressure_hyper',
        'criteria_2_pressure_hyper' => 'nullable|numeric|dependent_filled:criteria_1_pressure_hyper',
    ]);

    $criteria1 = $request->input('criteria_1_glucose_hyper');
    $criteria2 = $request->input('criteria_2_glucose_hyper');
    $criteria3 = $request->input('criteria_1_pressure_hyper');
    $criteria4 = $request->input('criteria_2_pressure_hyper');
    $patients = Patient::all();
    $period = $request->input('period_glucose_hyper');
    $duration = $request->input('duration_glucose_hyper');
    $startDate = null;
    $endDate = null;
    $startDate2 = null;
    $endDate2 = null;
    $duration2 = $request->input('duration_glucose_hyper2');
    if ($duration === 'yesterday') {
        $startDate = now()->subDay(1)->setTime(0, 0, 0);
        $endDate = now()->subDay(1)->setTime(23, 59, 59);
    } elseif ($duration === 'since 3 days') {
        $startDate = now()->subDays(3)->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'since a week') {
        $startDate = now()->subWeek()->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'since 2 weeks') {
        $startDate = now()->subWeeks(2)->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'today') {
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();
    }
    
    if ($duration2 === 'yesterday') {
        $startDate2 = now()->subDay(1)->setTime(0, 0, 0);
        $endDate2 = now()->subDay(1)->setTime(23, 59, 59);
    } elseif ($duration2 === 'since 3 days') {
        $startDate2 = now()->subDays(3)->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'since a week') {
        $startDate2 = now()->subWeek()->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'since 2 weeks') {
        $startDate2 = now()->subWeeks(2)->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'today') {
        $startDate2 = now()->startOfDay();
        $endDate2 = now()->endOfDay();
    }
    
    
    $results = Logbook::select('bg_level','bg_logbook_date','patient_id_FK','bg_period')->get();

    if ($startDate && $endDate) {
        $formattedStartDate = $startDate->format('Y-m-d H:i:s');
    $formattedEndDate = $endDate->format('Y-m-d H:i:s');

    $results = $results->whereBetween('bg_logbook_date', [$formattedStartDate, $formattedEndDate]);
    
    }

    if ($period !== 'all time') {
        $results = $results->where('bg_period', $period);
    }

    $results2 = Logbook::where(function ($query) use ($criteria3, $criteria4) {
        $query->whereBetween('bp_level2', [$criteria3, $criteria4])
            ->orWhereBetween('bp_level', [$criteria3, $criteria4]);
    })->get();

    if ($startDate2 && $endDate2) {
        $formattedStartDate = $startDate2->format('Y-m-d');
    $formattedEndDate = $endDate2->format('Y-m-d');

    $results2 = $results2->whereBetween('bp_logbook_date', [$formattedStartDate, $formattedEndDate]);
   
    }


    return view('hypo', [
        'results' => $results,
        'criteria1' => $criteria1,
        'criteria2' => $criteria2,
        'criteria3' => $criteria3,
        'criteria4' => $criteria4,
        'patients' => $patients,
        'results2' => $results2,
    ])->with('chartData', [
        'bg_level' => $results->pluck('bg_level')->toArray(),
        'bp_level' => $results2->pluck('bp_level')->toArray(),
        'bp_level2' => $results2->pluck('bp_level2')->toArray(),
    ]);
}

public function searchorg(Request $request) {
    $user = session('authenticated_user');
    $organizationid = session('organizationid');
    $patients = patient::where('organizationid_FK',$organizationid)->first();
    $patientid = $patients->patient_id;
    $request->validate([
        'criteria_1_glucose_hyper' => 'nullable|numeric|dependent_filled:criteria_2_glucose_hyper',
        'criteria_2_glucose_hyper' => 'nullable|numeric|dependent_filled:criteria_1_glucose_hyper',
        'criteria_1_pressure_hyper' => 'nullable|numeric|dependent_filled:criteria_2_pressure_hyper',
        'criteria_2_pressure_hyper' => 'nullable|numeric|dependent_filled:criteria_1_pressure_hyper',
    ]);

    $criteria1 = (float)$request->input('criteria_1_glucose_hyper');
$criteria2 = (float)$request->input('criteria_2_glucose_hyper');

    $criteria3 = $request->input('criteria_1_pressure_hyper');
    $criteria4 = $request->input('criteria_2_pressure_hyper');
  
    $period = $request->input('period_glucose_hyper');
    $duration = $request->input('duration_glucose_hyper');
    $startDate = null;
    $endDate = null;
    $startDate2 = null;
    $endDate2 = null;
    $duration2 = $request->input('duration_glucose_hyper2');
    if ($duration === 'yesterday') {
        $startDate = now()->subDay(1)->setTime(0, 0, 0);
        $endDate = now()->subDay(1)->setTime(23, 59, 59);
    } elseif ($duration === 'since 3 days') {
        $startDate = now()->subDays(3)->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'since a week') {
        $startDate = now()->subWeek()->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'since 2 weeks') {
        $startDate = now()->subWeeks(2)->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'today') {
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();
    }
    
    if ($duration2 === 'yesterday') {
        $startDate2 = now()->subDay(1)->setTime(0, 0, 0);
        $endDate2 = now()->subDay(1)->setTime(23, 59, 59);
    } elseif ($duration2 === 'since 3 days') {
        $startDate2 = now()->subDays(3)->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'since a week') {
        $startDate2 = now()->subWeek()->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'since 2 weeks') {
        $startDate2 = now()->subWeeks(2)->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'today') {
        $startDate2 = now()->startOfDay();
        $endDate2 = now()->endOfDay();
    }
    $results = Logbook::select('bg_level', 'bg_logbook_date', 'patient_id_FK', 'bg_period')
    ->where('patient_id_FK', $patientid)
    ->get();


    
    $results2 = Logbook::select('bp_level','bp_logbook_date','patient_id_FK') ->where('patient_id_FK', $patientid)->get();    
  

    if ($startDate && $endDate) {
        $formattedStartDate = $startDate->format('Y-m-d H:i:s');
    $formattedEndDate = $endDate->format('Y-m-d H:i:s');
  
    $results = $results->whereBetween('bg_logbook_date', [$formattedStartDate, $formattedEndDate]);
    }

    if ($period !== 'all time') {
        $results = $results->where('bg_period', $period);
    }




    if ($startDate2 && $endDate2) {
        $formattedStartDate = $startDate2->format('Y-m-d');
    $formattedEndDate = $endDate2->format('Y-m-d');

    $results2 = $results2->whereBetween('bp_logbook_date', [$formattedStartDate, $formattedEndDate]);
   
    }


    return view('/orgadminview/hyper', [
        'results' => $results,
        'criteria1' => $criteria1,
        'criteria2' => $criteria2,
        'criteria3' => $criteria3,
        'criteria4' => $criteria4,
        'user' => $user,
        'patients' => $patients,
        'results2' => $results2,
    ])->with('chartData', [
        'bg_level' => $results->pluck('bg_level')->toArray(),
        'bp_level' => $results2->pluck('bp_level')->toArray(),
        'bp_level2' => $results2->pluck('bp_level2')->toArray(),
    ]);
}

public function search2org(Request $request) {
    $bgLevels = $request->input('bg_level');
    $bpLevels = $request->input('bp_level');
    $bpLevels2 = $request->input('bp_level2');
    $period = $request->input('period');
    $bg_period = $request->input('bg_period');
    $bg_logbook_date = $request->input('bg_logbook_date');
    $bp_logbook_date = $request->input('bp_logbook_date');
    $user = session('authenticated_user');
    $organizationid = session('organizationid');
    $patients = patient::where('organizationid_FK',$organizationid)->first();
    $patientid = $patients->patient_id;
    $request->validate([
        'criteria_1_glucose_hyper' => 'nullable|numeric|dependent_filled:criteria_2_glucose_hyper',
        'criteria_2_glucose_hyper' => 'nullable|numeric|dependent_filled:criteria_1_glucose_hyper',
        'criteria_1_pressure_hyper' => 'nullable|numeric|dependent_filled:criteria_2_pressure_hyper',
        'criteria_2_pressure_hyper' => 'nullable|numeric|dependent_filled:criteria_1_pressure_hyper',
    ]);

    $criteria1 = $request->input('criteria_1_glucose_hyper');
    $criteria2 = $request->input('criteria_2_glucose_hyper');
    $criteria3 = $request->input('criteria_1_pressure_hyper');
    $criteria4 = $request->input('criteria_2_pressure_hyper');
    $period = $request->input('period_glucose_hyper');
    $duration = $request->input('duration_glucose_hyper');
    $startDate = null;
    $endDate = null;
    $startDate2 = null;
    $endDate2 = null;
    $duration2 = $request->input('duration_glucose_hyper2');
    if ($duration === 'yesterday') {
        $startDate = now()->subDay(1)->setTime(0, 0, 0);
        $endDate = now()->subDay(1)->setTime(23, 59, 59);
    } elseif ($duration === 'since 3 days') {
        $startDate = now()->subDays(3)->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'since a week') {
        $startDate = now()->subWeek()->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'since 2 weeks') {
        $startDate = now()->subWeeks(2)->setTime(0, 0, 0);
        $endDate = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration === 'today') {
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();
    }
    
    if ($duration2 === 'yesterday') {
        $startDate2 = now()->subDay(1)->setTime(0, 0, 0);
        $endDate2 = now()->subDay(1)->setTime(23, 59, 59);
    } elseif ($duration2 === 'since 3 days') {
        $startDate2 = now()->subDays(3)->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'since a week') {
        $startDate2 = now()->subWeek()->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'since 2 weeks') {
        $startDate2 = now()->subWeeks(2)->setTime(0, 0, 0);
        $endDate2 = now()->setTime(23, 59, 59); // Adjusted end date
    } elseif ($duration2 === 'today') {
        $startDate2 = now()->startOfDay();
        $endDate2 = now()->endOfDay();
    }
    
    
    $results = Logbook::select('bg_level','bg_logbook_date','patient_id_FK','bg_period')->where('patient_id_FK', $patientid)->get();
    $results2 = Logbook::select('bp_level','bp_logbook_date','patient_id_FK') ->where('patient_id_FK', $patientid)->get();

    if ($startDate && $endDate) {
        $formattedStartDate = $startDate->format('Y-m-d H:i:s');
    $formattedEndDate = $endDate->format('Y-m-d H:i:s');

    $results = $results->whereBetween('bg_logbook_date', [$formattedStartDate, $formattedEndDate]);
    
    }

    if ($period !== 'all time') {
        $results = $results->where('bg_period', $period);
    }

  

    if ($startDate2 && $endDate2) {
        $formattedStartDate = $startDate2->format('Y-m-d');
    $formattedEndDate = $endDate2->format('Y-m-d');

    $results2 = $results2->whereBetween('bp_logbook_date', [$formattedStartDate, $formattedEndDate]);
   
    }
   
    return view('/orgadminview/hypo', compact(
        'bgLevels',
        'bpLevels',
        'bpLevels2',
        'bg_logbook_date',
        'bp_logbook_date',
        'period',
        'bg_period',
        'criteria1',
        'criteria2',
        'criteria3',
        'criteria4',
        'results',
        'user',
        'patients',
        'results2'
    ))->with('chartData', [
        'bg_level' => $results->pluck('bg_level')->toArray(),
        'bp_level' => $results2->pluck('bp_level')->toArray(),
        'bp_level2' => $results2->pluck('bp_level2')->toArray(),
    ]);
}


    public function report() {
        // Logic to generate the report, if needed
        return view('logbook.report');
    }
    public function markAsRead(Request $request) {
        $logbookId = $request->input('logbookId');
        $type = $request->input('type'); // 'bp_read' or 'bg_read'
    
        $logbook = Logbook::find($logbookId);
    
        // Add the user's ID to the specified field
        $user = Auth::user();
        if (!is_array($logbook->{$type})) {
            $logbook->{$type} = [];
        }
    
        $logbook->{$type} = array_unique(array_merge($logbook->{$type}, [$user->professional_id]));
        $logbook->save();
    
        return response()->json([
            'success' => true,
            'isRead' => in_array($user->professional_id, $logbook->{$type}),
        ]);
    }
    
    
}
