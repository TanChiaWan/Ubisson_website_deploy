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
                                            <a href="{{ route('dashboard_bgorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}">BG</a>
                                            <a href="{{ route('dashboard_bporg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}"  class="active">BP</a>
                                            <a href="{{ route('dashboard_choorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}">Cholesterol</a>
                        </div>
                    </div>

                    <div class="button_evt_date">
                        <select class="event_slt" name="event_type" id="event_type" onchange="location = this.value;">
                            <option value="{{ route('dashboard_bporg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}"selected>Blood Pressure</option>
                            <option value="{{ route('dashboard_bgorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}" >Blood Glucose</option>
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
                                        <canvas id="chartMenu"></canvas>
                                      </div>
                                  
                                      <script defer>
                                        
                                         document.addEventListener('DOMContentLoaded', function() {
                                        // Data for morning and evening values for each day
                                        const data = {
                                          labels: ["29-5-2023"
   ,"30-5-2023", "31-5-2023",  "1-6-2023", "2-6-2023", "3-6-2023", "4-6-2023",],
                                          morningValues: [90, 110, 100, 90, 120, 100, 90],
                                          eveningValues: [80, 70, 70, 80, 60, 60, 50]
                                        };
                                  
                                        // Create a new Chart object
                                        const chartMenu = new Chart(document.getElementById('chartMenu'), {
                                          type: 'bar',
                                          data: {
                                            labels: data.labels,
                                            datasets: [
                                              {
                                                label: 'Systolic',
                                                data: data.morningValues,
                                                backgroundColor: 'rgba(126,203,204,0.5)',
                                                borderColor: 'rgba(126,203,204, 1)',
                                                borderWidth: 1
                                              },
                                              {
                                                label: 'Diastolic',
                                                data: data.eveningValues,
                                                backgroundColor: 'rgba(14,111,197, 0.5)',
                                                    borderColor: 'rgba(14,111,197, 1)',
                                                borderWidth: 1
                                              }
                                            ]
                                          },
                                          options: {
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
    y: {
      title: {
        display: true,
        text: 'Blood Pressure Level (mmHg)',
        color: '#000000',
        font: {
          size: 14,
          weight: 'bold'
        }},
      grid: {
        display: false
      },
        min: 0,
        max: 150,
    }
    }
  },
                                    });
                                  });
                                      </script>
                                    </div>
                                  </div>
                                  
                            

                            <div class="container_hyper_events">
                                <canvas id="chartMenu2"></canvas>   
                                <script defer>
                                   document.addEventListener('DOMContentLoaded', function() {
                                    // Data values for each day
                                    const data = {
                                          labels: ["29-5-2023"
   ,"30-5-2023", "31-5-2023",  "1-6-2023", "2-6-2023", "3-6-2023", "4-6-2023",],
                                          systolicValues: [90, 110, 100, 90, 120, 100, 90],
                                          diastolicValues: [80, 70, 70, 80, 60, 60, 50]
                                        };
                                
                                        // Create a new Chart object
                                        const chartMenu2 = new Chart(document.getElementById('chartMenu2'), {
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
                                                  text: 'Date',
                                                  color: '#000000',
                                                  font: {
                                                    size: 14,
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
                                                    size: 14,
                                                    weight: 'bold'
                                                  }
                                                },
                                                grid: {
                                                  display: false
                                                },
                                                min: 0,
                                                max: 150
                                              }
                                            }
                                          }
                                        });
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


</body>
</html>
@endsection 