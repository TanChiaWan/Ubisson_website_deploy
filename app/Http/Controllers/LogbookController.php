<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\Patient;
class LogbookController extends Controller
{



    public function filterLogbook(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $patientId = $request->input('patientId');
    
        if ($patientId) {
            // Execute the query if $patientId is provided
            $filteredLogbookData = DB::select("
                SELECT *, DATE_FORMAT(bg_logbook_date, '%Y-%m-%d') as formatted_date
                FROM logbooks
                WHERE patient_id_FK = :patientId
                AND bg_logbook_date BETWEEN :startDate AND :endDate
            ", [
                'patientId' => $patientId,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
    
            // You can return the filtered data as JSON or in any other format you prefer
            return response()->json($filteredLogbookData);
        } else {
            $filteredLogbookData = DB::select("
                SELECT *, DATE_FORMAT(bg_logbook_date, '%Y-%m-%d') as formatted_date
                FROM logbooks
                WHERE bg_logbook_date BETWEEN :startDate AND :endDate
            ", [
                
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
            // Handle the case when $patientId is not provided
            return response()->json(['message' => 'No patientId provided'], 400);
        }
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
    
    
    $results = Logbook::whereBetween('bg_level', [$criteria1, $criteria2])->get();

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
    
    
    $results = Logbook::whereBetween('bg_level', [$criteria1, $criteria2])->get();

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


    public function report() {
        // Logic to generate the report, if needed
        return view('logbook.report');
    }
}
