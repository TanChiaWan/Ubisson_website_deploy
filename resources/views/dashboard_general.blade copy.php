@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Health Data</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Min">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS -->
        <link rel="stylesheet" href="../css/stylemin2.css">

        <!--Bootstrap-->
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
        
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
                              <a href="{{ route('dashboard_general', ['patientId' => $patient->patient_id]) }}"  class="active">DashBoard</a>
                              <a href="{{ route('aboutpatient', ['patientId' => $patient->patient_id]) }}" >About Patient</a>
                              <a href='{{ route('logbook_bg', ['patientId' => $patient->patient_id]) }}'>Logbook</a>
                              <a href={{ route('healthdata', ['patientId' => $patient->patient_id]) }}>Health Data</a>
                            </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                      <div class="row">
                                        <div class="col-sm-12">
                                            <div class="tabtitle">
                                                <a href="{{ route('dashboard_general', ['patientId' => $patient->patient_id]) }}" class="active">General</a><a href="{{ route('dashboard_bg', ['patientId' => $patient->patient_id]) }}">BG</a><a href="{{ route('dashboard_bp', ['patientId' => $patient->patient_id]) }}"  >BP</a><a href="{{ route('dashboard_cho', ['patientId' => $patient->patient_id]) }}">Cholesterol</a>
                                            </div>
                                        </div>
                                    </div>
                
                             

                                        <div class="tab_title">
                                            <p> Full Name: {{ $patient->patient_name }}</p>
                                            <p>Gender:{{ $patient->patient_gender }} </p>
                                            <p>Diabetes Type: {{ $patient->diabetes_type }}  </p>  
                                        </div>
                                        
                                    </div>
                               
                                        
                                
                                    <div class="border_Health_Data">
                                      <table>
                                        <tr>
                                          <th class="txtline1">Previous</th>
                                          <th class="txtline1">Current</th>
                                        </tr>
                                      </table>
                                    </div>
                                    <div class="container_Health_Data">
                                      <table>
                                        <tr>
                                          <th>Carbs (Avg. g/day)</th>
                                          <td class="txt_no">5.6</td>
                                          <td class="txt_no">5.2</td>
                                        </tr>
                                        <tr>
                                          <th>Weight (kg)</th>
                                          <td class="txt_no">60</td>
                                          <td class="txt_no">55</td>
                                        </tr>
                                        <tr>
                                          <th>BMI</th>
                                          <td class="txt_no">-</td>
                                          <td class="txt_no">-</td>
                                        </tr>
                                      
                                      </table>
                                    </div>
                                 </form>

                                  <br>

                                  <div class="border_Health_Data2">
                                  <table>
                                    <tr><th class="txtline2">HbA1c</th></tr>
                                    </table>
                                  </div>
                                 
                                    <div class="col-sm-5" style='padding-right:0;'>
                                      <div class="container_hyper_events1">
                                        <canvas id="doughnutChart"></canvas>
                                      </div>
                                    </div>
                                      <div class="col-sm-6"style='padding-left:0;'>
                                        <div class="container_hyper_events2">
                                        <canvas id="doughnutChart2"></canvas>
                                      </div>
                                    </div>
                              
                                      <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                          const data = {
                                            datasets: [{
                                              data: [70, 30],
                                              backgroundColor: ['#FFCE56', '#E8E8E8']
                                            }]
                                          };
                                    
                                          const options = {
                                            cutoutPercentage: 80,
                                            rotation: -0.5 * Math.PI,
                                            animation: {
                                              animateRotate: false
                                            },
                                            legend: {
                                              display: false
                                            },
                                            plugins: {
                                              subtitle: {
                                                display: true,
                                                text: 'Previous (Date)',

                                                position: 'bottom',
                                                fontSize: 50,
                                                padding: 5,
                                                weight: 'bold',
                                                color: '#000000',
                                              },
                                              title: {
                                                display: true,
                                                text: '70%',
                                                position: 'bottom',
                                                fontSize: 70,
                                                padding: 2,
                                                weight: 'bold',
                                                color: '#000000',
                                              },
                                              datalabels: {
                                                formatter: (value, ctx) => {
                                                  const dataset = ctx.chart.data.datasets[0];
                                                  const total = dataset.data.reduce((acc, data) => acc + data, 0);
                                                  const percentage = Math.round((value / total) * 100) + '%';
                                                  return percentage;
                                                },
                                                color: '#000000',
                                                font: {
                                                  size: 55,
                                                  weight: 'bold'
                                                },
                                                anchor: 'center'
                                              }
                                            },
                                            tooltips: {
                                              enabled: false
                                            },
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            aspectRatio: 1
                                          };
                                    
                                          const centerTextPlugin = {
                                            id: 'centerText',
                                            afterDraw: (chart) => {
                                              const { ctx, chartArea } = chart;
                                              const centerX = (chartArea.left + chartArea.right) / 2;
                                              const centerY = (chartArea.top + chartArea.bottom) / 2;
                                    
                                              drawCenterText(ctx, centerX, centerY, '70%');
                                            }
                                          };
                                    
                                          Chart.register(centerTextPlugin);
                                    
                                
                                          Chart.unregister(centerTextPlugin);
                                          const doughnutChart = new Chart(document.getElementById('doughnutChart'), {
                                            type: 'doughnut',
                                            data: data,
                                            options: options,
                                            plugins: [centerTextPlugin]
                                          });
                                    
                                          function drawCenterText(ctx, centerX, centerY, text) {
                                            ctx.save();
                                            ctx.font = '16px Arial';
                                            ctx.fillStyle = '#000000';
                                            ctx.textAlign = 'center';
                                            ctx.textBaseline = 'middle';
                                            ctx.fillText(text, centerX, centerY);
                                            ctx.restore();
                                          }
                                        });
                                      </script>
                               
                                      <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                          const data2 = {
                                            datasets: [{
                                              data: [40, 60],
                                              backgroundColor: ['#36A2EB', '#E8E8E8']
                                            }]
                                          };
                                    
                                          const options2 = {
                                            cutoutPercentage: 80,
                                            rotation: -0.5 * Math.PI,
                                            animation: {
                                              animateRotate: false
                                            },
                                            legend: {
                                              display: false
                                            },
                                            plugins: {
                                              subtitle: {
                                                display: true,
                                                text: 'Current (Date)',
                                                position: 'bottom',
                                                fontSize: 50,
                                                padding: 5,
                                                weight: 'bold',
                                                color: '#000000',
                                              },
                                              title: {
                                                display: true,
                                                text: '40%',
                                                position: 'bottom',
                                                fontSize: 55,
                                                padding: 2,
                                                weight: 'bold',
                                                color: '#000000',
                                              },
                                              datalabels: {
                                                formatter: (value, ctx) => {
                                                  const dataset = ctx.chart.data.datasets[0];
                                                  const total = dataset.data.reduce((acc, data) => acc + data, 0);
                                                  const percentage = Math.round((value / total) * 100) + '%';
                                                  return percentage;
                                                },
                                                color: '#000000',
                                                font: {
                                                  size: 55,
                                                  weight: 'bold'
                                                },
                                                anchor: 'center'
                                              }
                                            },
                                            tooltips: {
                                              enabled: false
                                            },
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            aspectRatio: 1
                                          };
                                    
                                          const centerTextPlugin2 = {
                                            id: 'centerText2',
                                            afterDraw: (chart) => {
                                              const { ctx, chartArea } = chart;
                                              const centerX = (chartArea.left + chartArea.right) / 2;
                                              const centerY = (chartArea.top + chartArea.bottom) / 2;
                                    
                                              drawCenterText(ctx, centerX, centerY, '40%');
                                            }
                                          };
                                    
                                          Chart.register(centerTextPlugin2);
                                    
                                     
                                          Chart.unregister(centerTextPlugin2);
                                          const doughnutChart2 = new Chart(document.getElementById('doughnutChart2'), {
                                            type: 'doughnut',
                                            data: data2,
                                            options: options2,
                                            plugins: [centerTextPlugin2]
                                          });
                                    
                                          function drawCenterText(ctx, centerX, centerY, text) {
                                            ctx.save();
                                            ctx.font = '16px Arial';
                                            ctx.fillStyle = '#000000';
                                            ctx.textAlign = 'center';
                                            ctx.textBaseline = 'middle';
                                            ctx.fillText(text, centerX, centerY);
                                            ctx.restore();
                                          }
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
    <script src="../bootstrap/bootstrap.min.js"></script>


</body>
</html>
@endsection 