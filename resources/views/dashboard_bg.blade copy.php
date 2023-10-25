@extends('layouts.patapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard Blood Glucose</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Min">
        <meta name="keywords" content="Dashboard">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                <form action="{{ route('dashboard_general') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-primary m-1 active">Dashboard</button>
                  </form>
                <form action="{{ route('aboutpatient') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">About Patient</button>
                  </form>
                  <form action="{{ route('logbook_bg') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Logbook</button>
                  </form>
                  <form action="{{ route('healthdata') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Health Data</button>
                  </form>
                  <form action="{{ route('remark') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Remarks</button>
                  </form>
                  <form action="{{ route('medicationreport') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Medication</button>
                  </form>
                </div>
            </div>
            </div>
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
        <div class="card">
          <div class="card-body">
            <!-- Inner Tab -->
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
              <form action="{{ route('dashboard_general') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-2 mb-4">General</button>
                  </form>
                  <form action="{{ route('dashboard_bg') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-secondary m-2 mb-4 active">BG</button>
                  </form>
                  <form action="{{ route('dashboard_bp') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-2 mb-4">BP</button>
                  </form>
                  <form action="{{ route('dashboard_cho') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-2 mb-4 ">Cholesterol</button>
                  </form>
              </div>
            </div>

           
            <div class="col-sm-12 d-flex justify-content-center">
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <button class="btn btn-outline-primary" id="btn-today">Today</button>
                  <button class="btn btn-outline-primary" id="btn-yesterday">Yesterday</button>
                  <button class="btn btn-outline-primary" id="btn-3-days">Since 3 days</button>
                  <button class="btn btn-outline-primary" id="btn-7-days">Since 7 days</button>
                  <button class="btn btn-outline-primary" id="btn-14-days">Since 14 days</button>
                  <button class="btn btn-outline-primary" id="btn-30-days">Since 30 days</button>
                  </div>
                
                 
                </div>
                <div class="tab_nav my-3">
                  <label for="date-range">Select Date Range:</label>
                  <input type="text" id="date-range" name="date-range" class="tabnav2" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-bottom: 2vh;margin-top: 2vh; margin-left: 1vw; margin-right: 1vw; width: 20vw;">

                

                </div>
                
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div id="chart-container w-100 text-center">
                            <canvas id="time_in_range"></canvas>
                        </div>
                        <script type="module">
                          const data1 = [
                            { area: "Hyper", count: 10 },
                            { area: "Normal", count: 5 },
                            { area: "Hypo", count: 2 }
                          ];

                          var tir_date_range = "Mon 29-5-2023 -- Fri 9-6-2023"

                          new Chart(
                            document.getElementById('time_in_range'),
                            {
                              type: 'pie',
                              data: {
                                labels: data1.map(row => row.area),
                                datasets: [
                                  {
                                    label: '',
                                    data: data1.map(row => row.count),
                                    backgroundColor: [
                                      "#EC1F28",
                                      "#67C56D",
                                      "#668DC4"
                                    ],
                                    hoverOffset: 20
                                  }
                                ]
                              },
                              options: {
                                plugins: {
                                  title: {
                                    display: true,
                                    text: "Time in Range",
                                    font: {
                                      size: 18,
                                      color: 'black'
                                    }
                                  },
                                  legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                      generateLabels: function(chart) {
                                        const data = chart.data;
                                        if (data.labels.length && data.datasets.length) {
                                          return data.labels.map(function(label, i) {
                                            const value = data.datasets[0].data[i];
                                            const total = data.datasets[0].data.reduce((acc, val) => acc + val);
                                            const percentage = ((value / total) * 100).toFixed(2);
                                            return {
                                              text: `${label}: ${percentage}%`,
                                              fillStyle: data.datasets[0].backgroundColor[i],
                                              hidden: isNaN(data.datasets[0].data[i]) || chart.getDatasetMeta(0).data[i].hidden,
                                              index: i
                                            };
                                          });
                                        }
                                        return [];
                                      }
                                    }
                                  },
                                  tooltip: {
                                    callbacks: {
                                      label: function(context) {
                                        const value = context.parsed;
                                        const total = context.dataset.data.reduce((acc, val) => acc + val);
                                        const percentage = ((value / total) * 100).toFixed(2);
                                        return `${percentage}%`;
                                      }
                                    }
                                  },
                                },
                                responsive: true,
                              }
                            }
                          );
                      </script>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                  <div class="card-body p-0">
                      <div id="chart-container w-100 text-center">
                          <canvas id="bg_comparison"></canvas>
                      </div>
                      
                      <script type="module">

const data2 = [
  @foreach ($logbook->groupBy('bg_logbook_date')->sortBy(function ($items, $date) {
    return strtotime($date);
  })->take(7) as $date => $logbooks)
    {
      label: '{{ date("Y-m-d", strtotime($date)) }}',
      @php
        $afterReading = null;
        $beforeReading = null;
      @endphp
      @php
    $readings = ['After' => null, 'Before' => null];
@endphp

@foreach ($logbooks as $logbook)
    @php
        $period = Str::startsWith($logbook->bg_period, 'After') ? 'After' : 'Before';
        $readings[$period] = $logbook->bg_level;
    @endphp
@endforeach


      after_meal_reading: '{{ $afterReading }}',
      before_meal_reading: '{{ $beforeReading }}',
    },
  @endforeach
];


const chart = new Chart(
  document.getElementById('bg_comparison'),
  {
    type: 'line',
    data: {
      labels: data2.map(row => row.label),
      backgroundColor: [
        "#D0D9E8",
        "#F6D8D8",
      ],
      datasets: [
        {
          label: 'Average Before Meal Readings',
          data: data2.map(row => row.before_meal_reading || null),
          borderColor: '#3F6AB1',
          borderWidth: 3
        },
        {
          label: 'Average After Meal Readings',
          data: data2.map(row => row.after_meal_reading || null),
          borderColor: '#36AD4A',
          borderWidth: 3
        }
      ],
    },
    options: {
      scales: {
        y: { grid: {display: false}, suggestedMin:0 , suggestedMax: 9 },
        x: { grid: {display: false} },
      },
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'top',
        },
        title: {
          display: true,
          text: "Average Blood Glucose Level",
          font: {
            size: 18,
            color: 'black'
          }
        },
      },
      aspectRatio: 1,
    },
  }
);

const dateRangeInput = document.getElementById('date-range');
flatpickr(dateRangeInput, {
        dateFormat: 'Y-m-d',
        mode: 'range',
        onChange: function(selectedDates, dateStr, instance) {
            filterChartData(selectedDates);
        }
    });
    const btnToday = document.getElementById('btn-today');
  const btnYesterday = document.getElementById('btn-yesterday');
  const btn3Days = document.getElementById('btn-3-days');
  const btn7Days = document.getElementById('btn-7-days');
  const btn14Days = document.getElementById('btn-14-days');
  const btn30Days = document.getElementById('btn-30-days');

    btnToday.addEventListener('click', function() {
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
    const today = new Date();
    dateRangeInput._flatpickr.setDate([today, tomorrow]); // Update the date range input
    filterChartData([today, tomorrow]);
  });

  btnYesterday.addEventListener('click', function() {
  const today = new Date();
  today.setDate(today.getDate() - 1); // Setting yesterday as one day before today
  const yesterday = new Date();
  yesterday.setDate(today.getDate() - 1); // Setting yesterday as one day before today
  dateRangeInput._flatpickr.setDate([yesterday, today]); // Update the date range input
  filterChartData([yesterday, today]);
});
  btn3Days.addEventListener('click', function() {
    const today = new Date();
    const threeDaysAgo = new Date(today);
    threeDaysAgo.setDate(today.getDate() - 3);
    dateRangeInput._flatpickr.setDate([threeDaysAgo, today]); // Update the date range input
    filterChartData([threeDaysAgo, today]);
  });

  btn7Days.addEventListener('click', function() {
    const today = new Date();
    const sevenDaysAgo = new Date(today);
    sevenDaysAgo.setDate(today.getDate() - 7);
    dateRangeInput._flatpickr.setDate([sevenDaysAgo, today]); // Update the date range input
    filterChartData([sevenDaysAgo, today]);
  });

  btn14Days.addEventListener('click', function() {
    const today = new Date();
    const fourteenDaysAgo = new Date(today);
    fourteenDaysAgo.setDate(today.getDate() - 14);
    dateRangeInput._flatpickr.setDate([fourteenDaysAgo, today]); // Update the date range input
    filterChartData([fourteenDaysAgo, today]);
  });

  btn30Days.addEventListener('click', function() {
    const today = new Date();
    const thirtyDaysAgo = new Date(today);
    thirtyDaysAgo.setDate(today.getDate() - 30);
    dateRangeInput._flatpickr.setDate([thirtyDaysAgo, today]); // Update the date range input
    filterChartData([thirtyDaysAgo, today]);
  });
    function filterChartData(selectedDates) {
        const filteredData = data2.filter(row => {
            const date = new Date(row.label);
            return date >= selectedDates[0] && date <= selectedDates[1];
        });

        const labels = filteredData.map(row => row.label);
        const beforeMealData = filteredData.map(row => row.before_meal_reading || null);
        const afterMealData = filteredData.map(row => row.after_meal_reading || null);

        chart.data.labels = labels;
        chart.data.datasets[0].data = beforeMealData;
        chart.data.datasets[1].data = afterMealData;
        chart.update();
    }
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