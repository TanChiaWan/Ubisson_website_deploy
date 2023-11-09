@extends('layouts.orgapp') 
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
                    <a href="{{ route('dashboard_generalorg') }}" class="btn btn-primary m-1 active">Dashboard</a>
    <a href="{{ route('aboutpatientorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">About Patient</a>
    <a href="{{ route('logbook_bgorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Logbook</a>
    <a href="{{ route('healthdataorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Health Data</a>
    <a href="{{ route('remarkorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Remarks</a>
    <a href="{{ route('medicationreportorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Medication</a>
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
                <a href="{{ route('dashboard_generalorg') }}" class="btn btn-light m-2 mb-4">Dashboard</a>
              <a href="{{ route('dashboard_bgorg') }}" class="btn btn-light m-2 mb-4">BG</a>
              <a href="{{ route('dashboard_bporg') }}" class="btn btn-light m-2 mb-4">BP</a>
              <a href="{{ route('dashboard_choorg') }}" class="btn btn-primary m-2 mb-4 active">Cholesterol</a>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div id="chart-container w-100 text-center">
                                <canvas id="cholesterol1"  height="500"></canvas>
                            </div>
                            <script defer>
  document.addEventListener('DOMContentLoaded', function() {
    const datepicker = flatpickr("#date-range", {
      mode: "range",
      dateFormat: "Y-m-d",
      onChange: function(selectedDates) {
        if (selectedDates.length === 2) {
          const startDate = selectedDates[0];
          const endDate = selectedDates[1];
          updateCharts(startDate, endDate);
        }
      }
    });
    // Data for morning and evening values for each day
    const data = {
      labels: [
        @foreach ($healthdata->sortBy('date')->take(7) as $healthdatas)
        '{{ date("Y-m-d", strtotime($healthdatas->date)) }}',
        @endforeach
      ],
      ldlValues: [{{ implode(', ', $healthdata->pluck('ldlc')->toArray()) }}],
      hdlValues: [{{ implode(', ', $healthdata->pluck('hdl')->toArray()) }}],
      tgValues: [{{ implode(', ', $healthdata->pluck('tg')->toArray()) }}],
      tcValues: [{{ implode(', ', $healthdata->pluck('tc')->toArray()) }}]
    };

    const maxValue = Math.max(
      ...data.ldlValues,
      ...data.hdlValues,
      ...data.tgValues,
      ...data.tcValues
    );

    // Create a new Chart object
    const chartMenu = createChartMenu('cholesterol1', data, maxValue);
    const chartMenu2 = createChartMenu2('cholesterol2', data, maxValue);

    // Initialize Flatpickr datepicker
    

    function createChartMenu(chartId, data, maxValue) {
      return new Chart(document.getElementById(chartId), {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [
            {
              label: 'LDL',
              data: data.ldlValues,
              backgroundColor: 'rgba(0,173,181, 0.5)',
              borderColor: 'rgba(0,173,181, 1)',
              borderWidth: 1
            },
            {
              label: 'HDL',
              data: data.hdlValues,
              backgroundColor: 'rgba(153, 153, 153, 0.5)',
              borderColor: 'rgba(153,153,153, 1)',
              borderWidth: 1
            },
            {
              label: 'TG',
              data: data.tgValues,
              backgroundColor: 'rgba(255, 22, 22, 0.5)',
              borderColor: 'rgba(255, 22, 22, 1)',
              borderWidth: 1
            },
            {
              label: 'TC',
              data: data.tcValues,
              backgroundColor: 'rgba(14,111,197, 0.5)',
              borderColor: 'rgba(14,111,197, 1)',
              borderWidth: 1
            }
          ]
        },
        options: {
         
          responsive: true,
          maintainAspectRatio: false,
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
                text: 'Cholesterol Level (mmol/L)',
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
              max: maxValue
            }
          }
        },
      });
    }
    function createChartMenu2(chartId, data, maxValue) {
      return new Chart(document.getElementById(chartId), {
        type: 'line',
                                    data: {
                                        labels: data.labels,
                                        datasets: [
                                            {
                                                label: 'LDL',
                                                data: data.ldlValues,
                                                backgroundColor: 'rgba(0,173,181, 0.5)',
                                                borderColor: 'rgba(0,173,181, 1)',
                                                borderWidth: 1
                                            },
                                            {
                                                label: 'HDL',
                                                data: data.hdlValues,
                                                backgroundColor: 'rgba(153, 153, 153, 0.5)',
                                                borderColor: 'rgba(153,153,153, 1)',
                                                borderWidth: 1
                                            },
                                            {
                                                label: 'TG',
                                                data: data.tgValues,
                                                backgroundColor: 'rgba(255, 22, 22, 0.5)',
                                                borderColor: 'rgba(255, 22, 22, 1)',
                                                borderWidth: 1
                                            },
                                            {
                                                label: 'TC',
                                                data: data.tcValues,
                                                backgroundColor: 'rgba(14,111,197, 0.5)',
                                                borderColor: 'rgba(14,111,197, 1)',
                                                borderWidth: 1
                                            }
                                        ]
                                    },
                                    options: {
                                       
                                        responsive: true,
                                        maintainAspectRatio: false,
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
                                                    text: 'Cholesterol Level (mmol/L)',
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
                                                max: maxValue
                                              }
          }
        },
      });
    }
    function updateCharts(startDate, endDate) {
      // Filter the data based on the selected date range
      const filteredData = {
        labels: [],
        ldlValues: [],
        hdlValues: [],
        tgValues: [],
        tcValues: []
      };

      data.labels.forEach((date, index) => {
        const currentDate = new Date(date);
        if (currentDate >= startDate && currentDate <= endDate) {
          filteredData.labels.push(date);
          filteredData.ldlValues.push(data.ldlValues[index]);
          filteredData.hdlValues.push(data.hdlValues[index]);
          filteredData.tgValues.push(data.tgValues[index]);
          filteredData.tcValues.push(data.tcValues[index]);
        }
      });

      // Update the chart data and redraw
      chartMenu.data.labels = filteredData.labels;
      chartMenu.data.datasets[0].data = filteredData.ldlValues;
      chartMenu.data.datasets[1].data = filteredData.hdlValues;
      chartMenu.data.datasets[2].data = filteredData.tgValues;
      chartMenu.data.datasets[3].data = filteredData.tcValues;
      chartMenu.update();

      chartMenu2.data.labels = filteredData.labels;
      chartMenu2.data.datasets[0].data = filteredData.ldlValues;
      chartMenu2.data.datasets[1].data = filteredData.hdlValues;
      chartMenu2.data.datasets[2].data = filteredData.tgValues;
      chartMenu2.data.datasets[3].data = filteredData.tcValues;
      chartMenu2.update();
    }

    // Button event listeners
    const btnToday = document.getElementById('btn-today');
    const btnYesterday = document.getElementById('btn-yesterday');
    const btn3Days = document.getElementById('btn-3-days');
    const btn7Days = document.getElementById('btn-7-days');
    const btn14Days = document.getElementById('btn-14-days');
    const btn30Days = document.getElementById('btn-30-days');

    btnToday.addEventListener('click', function() {
      const today = new Date();
      const yesterday = new Date(today);
      yesterday.setDate(today.getDate() - 1);
      datepicker.setDate([yesterday, today]); // Update the date range input
      updateCharts(yesterday, today);
    });

    btnYesterday.addEventListener('click', function() {
      const yesterday = new Date();
      const daybeforeyesterday = new Date(yesterday);
      daybeforeyesterday.setDate(yesterday.getDate() - 1);
      datepicker.setDate([daybeforeyesterday, yesterday]); // Update the date range input
      updateCharts(daybeforeyesterday, yesterday);
    });

    btn3Days.addEventListener('click', function() {
      const today = new Date();
      const threeDaysAgo = new Date(today);
      threeDaysAgo.setDate(today.getDate() - 3);
      datepicker.setDate([threeDaysAgo, today]); // Update the date range input
      updateCharts(threeDaysAgo, today);
    });

    btn7Days.addEventListener('click', function() {
      const today = new Date();
      const sevenDaysAgo = new Date(today);
      sevenDaysAgo.setDate(today.getDate() - 7);
      datepicker.setDate([sevenDaysAgo, today]); // Update the date range input
      updateCharts(sevenDaysAgo, today);
    });

    btn14Days.addEventListener('click', function() {
      const today = new Date();
      const fourteenDaysAgo = new Date(today);
      fourteenDaysAgo.setDate(today.getDate() - 14);
      datepicker.setDate([fourteenDaysAgo, today]); // Update the date range input
      updateCharts(fourteenDaysAgo, today);
    });

    btn30Days.addEventListener('click', function() {
      const today = new Date();
      const thirtyDaysAgo = new Date(today);
      thirtyDaysAgo.setDate(today.getDate() - 30);
      datepicker.setDate([thirtyDaysAgo, today]); // Update the date range input
      updateCharts(thirtyDaysAgo, today);
    });
  });
</script>


                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div id="chart-container w-100 text-center">
                                <canvas id="cholesterol2"  height="500"></canvas>
                            </div>
                           
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
