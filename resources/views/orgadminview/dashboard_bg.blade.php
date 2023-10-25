@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DASHBOARD_BG</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Min">
        <meta name="keywords" content="Dashboard">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS -->
        <link rel="stylesheet" href="../../css/stylemin2.css">

        <!--Bootstrap-->
        <link href="../../bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        

    </head>

<body>
    <!--Side Bar-->
    <div class="closed_sidebar">&#9776; Menu</div>
        <!--<div class="container">-->
            <div class="row">
                <!--side bar-->
                <div class="col-sm-3">
                    
                </div>

            <!--content-->
            <!--Body-->
            <div class="col-sm-9">
                <div class="content">
                    <div class="topnav1">
                    <a href="{{ route('dashboard_generalorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}" class="active">DashBoard</a>
                              <a href="{{ route('patient', ['patientId' => $patient->patient_id,'organization_id' => $organizationid]) }}" >About Patient</a>
                              <a href="{{ route('logbook_bgorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}" >Logbook</a>
                        <a href="{{ route('healthdataorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}">Health Data</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="tabtitle">
                            <a href="{{ route('dashboard_generalorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}" >General</a>
                                            <a href="{{ route('dashboard_bgorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}"class="active">BG</a>
                                            <a href="{{ route('dashboard_bporg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}"  >BP</a>
                                            <a href="{{ route('dashboard_choorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}">Cholesterol</a>
                        </div>
                    </div>

                    <div class="button_evt_date">
                        <select class="event_slt" name="event_type" id="event_type" onchange="location = this.value;">
                            <option value="{{ route('dashboard_bporg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}">Blood Pressure</option>
                            <option value="{{ route('dashboard_bgorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}" selected>Blood Glucose</option>
                            <option value="{{ route('dashboard_choorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}">Cholesterol</option>
                        </select>
                            
                            
                                <input type="date" class="date_hyper" id="date_start" name="date_start"
                                    value="2023-05-16"
                                    min="2000-01-01" max="2050-12-31">
                        </div>
                                
                                <!--Blood Glucose Event-->
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="container_hyper_events">
                                <canvas id="time_in_range"></canvas>   
                                </div>
                    
                                <script defer>
                                  
                                

                                    document.addEventListener('DOMContentLoaded', function() {
                                      // Data values for each day
                                      
                                      const data = [
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
        labels: data.map(row => row.area),
        datasets: [
          {
            label: '',
            data: data.map(row => row.count),
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
              size: 24,
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
          subtitle: {
            display: true,
            text: "Date Range: " + tir_date_range,
            font: {
                size: 12
            },
            padding: {
                bottom: 20
            }
          }
        },
        responsive: true,
      }
    }
  );
                               
                                                                  });
                                  </script>    
                            </div>
                        </div>


                                    <div class="container_hyper_events">
                                        <canvas id="bg_comparison"></canvas>   
                                        <script defer>
                                            document.addEventListener('DOMContentLoaded', function() {
                                            // Data values for each day
                                            const data = [
    { date: "29-5-2023", before_meal_reading: 5.6, after_meal_reading: 4.6},
    { date: "30-5-2023", before_meal_reading: 5.3, after_meal_reading: 4.5},
    { date: "31-5-2023", before_meal_reading: 5.7, after_meal_reading: 4.8},
    { date: "1-6-2023", before_meal_reading: 6, after_meal_reading: 4.9},
    { date: "2-6-2023", before_meal_reading: 6.8, after_meal_reading: 5},
    { date: "3-6-2023", before_meal_reading: 5.9, after_meal_reading: 5.5},
    { date: "4-6-2023", before_meal_reading: 5.0, after_meal_reading: 5.2},
  ]

  var bg_week_range = "Mon 29-5-2023 -- Sun 4-6-2023"
    

  new Chart(
    document.getElementById('bg_comparison'),
    {
        type: 'line',
        data: {
            labels: data.map(row => row.date),
            backgroundColor: [
                "#D0D9E8",
                "#F6D8D8",
            ],
            datasets: [
                {
                    label: 'Average Before Meal Readings',
                    data: data.map(row => row.before_meal_reading),
                    borderColor: '#3F6AB1',
                    borderWidth: 3
                },
                {
                    label: 'Average After Meal Readings',
                    data: data.map(row => row.after_meal_reading),
                    borderColor: '#36AD4A',
                    borderWidth: 3
                }
            ],
        },
        options: {
          scales: {
            y: {
      title: {
        display: true,
        text: 'Blood GLucose Level (mmol/L)',
        color: '#000000',
        font: {
          size: 14,
          weight: 'bold'
        }},
      grid: {
        display: false
      }, suggestedMin: 3.5, suggestedMax: 7.5},
              x: {
      title: {
        display: true,
        text: 'Date',
        color: '#000000',
        font: {size: 14,
          weight: 'bold'
        }
      },
      grid: {
        display: false
      }
    },
              
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
                  size: 24,
                  color: 'black'
                }
            },
            subtitle: {
                display: true,
                text: "Week: " + bg_week_range,
                font: {
                    size: 12
                },
                padding: {
                    bottom: 20
                }
            }
          }
        },
      
    }
  );
                                        });
                                        </script>      
                                    </div>
                                </div>
        </div>



                    

                    
        <!--</div>-->
    </div>

    <!--jQuery CDN - Slim version (=without AJAX)-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
    <!--Popper.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    
    <!--Bootstrap.js-->
    <script src="../../bootstrap/bootstrap.min.js"></script>

    <!--HyperReportChart.js-->
    
</body>
</html>
@endsection 