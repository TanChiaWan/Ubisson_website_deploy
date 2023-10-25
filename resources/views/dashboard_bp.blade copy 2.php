@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DASHBOARD_BG</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Min">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        

    </head>
<body>
<div class="container-fluid">
        <!-- Outer Tab -->
        <div class="d-flex justify-content-center">
          <div class="card d-inline-block">
            <div class="card-body py-1 px-4">
              <div class="row text-center">
                <div class="col-md-12 p-0">
                <a href="{{ route('dashboard_general', ['patientId' => $patient->patient_id]) }}" class="btn btn-primary m-1 ">Dashboard</a>
                    <a href="{{ route('aboutpatient', ['patientId' => $patient->patient_id]) }}" class="btn btn-light m-1 btn-pagenav-notselected">About Patient</a>
                    <a href="{{ route('logbook_bg', ['patientId' => $patient->patient_id]) }}" class="btn btn-light m-1 btn-pagenav-notselected">Logbook</a>
                    <a href="{{ route('healthdata', ['patientId' => $patient->patient_id]) }}" class="btn btn-light m-1 btn-pagenav-notselected">Health Data</a>
                </div>
            </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <!-- Inner Tab -->
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
              <a href="{{ route('dashboard_general', ['patientId' => $patient->patient_id]) }}" class="btn btn-light m-2 mb-4 ">General</a>
                  <a href="{{ route('dashboard_bg', ['patientId' => $patient->patient_id]) }}" class="btn btn-light m-2 mb-4" >BG</a>
                  <a href="{{ route('dashboard_bp', ['patientId' => $patient->patient_id]) }}" class="btn btn-secondary m-2 mb-4 active">BP</a>
                  <a href="{{ route('dashboard_cho', ['patientId' => $patient->patient_id]) }}" class="btn btn-light m-2 mb-4">Cholesterol</a>
              </div>
            </div>

            <div class="row mb-3">
            <div class="col-md-4 text-center">
                    <p class="fs-4 fw-semibold">Patient: {{ $patient->patient_name }} ({{ $patient->patient_age }} y/o)</p>
                </div>
                <div class="col-md-4 text-center">
                    <p class="fs-4 fw-semibold">Gender: {{ $patient->patient_gender }}</p>
                </div>
                <div class="col-md-4 text-center">
                    <p class="fs-4 fw-semibold">Diabetes Type: {{ $patient->diabetes_type }}</p>
                </div>
            </div>     
            <div class="tab_nav" >
                  <label for="date-range">Select Date Range:</label>
                  <input type="text" id="date-range" name="date-range" class="tabnav2" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-bottom: 2vh;margin-top: 2vh; margin-left: 1vw; margin-right: 1vw; width: 20vw;">

                  <label for="sort-dropdown">Sort By:</label>
                  <select id="sort-dropdown" class="tabnav3" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-top: 2vh; margin-left: 1vw; width: 10vw;">
                      <option value="newest">Newest</option>
                      <option value="oldest">Oldest</option>
                  </select>

                </div>
  
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div id="chart-container w-100 text-center">
                            <canvas id="bp_comparison"></canvas>
                        </div>
                        <script defer>
  document.addEventListener('DOMContentLoaded', function() {
    // Data values for each day
    const data = {
      labels: [
        @foreach ($healthdata->sortBy('date')->take(7) as $healthdatas)
        '{{ date("d-m-Y", strtotime($healthdatas->date)) }}',
        @endforeach
      ],
      systolicValues: [{{ implode(', ', $healthdata->pluck('sbp')->toArray()) }}],
      diastolicValues: [{{ implode(', ', $healthdata->pluck('dbp')->toArray()) }}],
    };

    // Find the maximum value between systolic and diastolic values
    const maxValue = Math.max(...data.systolicValues, ...data.diastolicValues);

    // Create a new Chart object
    const chartMenu2 = new Chart(document.getElementById('bp_comparison'), {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [
          {
            label: 'Systolic',
            data: data.systolicValues,
            backgroundColor: 'rgba(126,203,204,0.5)',
            borderColor: 'rgba(126,203,204, 1)',
            borderWidth: 1
          },
          {
            label: 'Diastolic',
            data: data.diastolicValues,
            backgroundColor: 'rgba(14,111,197, 0.5)',
            borderColor: 'rgba(14,111,197, 1)',
            borderWidth: 1
          }
        ]
      },
      options: {
        aspectRatio: 2.5,
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: ''
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Days',
              color: '#000000',
              font: {
                size: 12,
                weight: 'bold'
              }
            },
            grid: {
              display: false
            }
          },
          y: {
            title: {
              display: true,
              text: 'Blood Pressure Level (mmHg)',
              color: '#000000',
              font: {
                size: 12,
                weight: 'bold'
              }
            },
            grid: {
              display: false
            },
            min: 0,
            max: maxValue // Set the maximum value dynamically
          }
        }
      }
    });
  });
</script>


                    </div>
                </div>
            </div>
            
            </div>



            
          </div>
        </div>
      </div>
</body>
</html>
@endsection 