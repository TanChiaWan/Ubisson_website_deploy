@extends('layouts.patapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard General</title>
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
                        <button type="submit"  class="btn btn-secondary m-2 mb-4 active">General</button>
                  </form>
                  <form action="{{ route('dashboard_bg') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-2 mb-4">BG</button>
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
                        <button type="submit"  class="btn btn-light m-2 mb-4">Cholesterol</button>
                  </form>
                  
              </div>
            </div>

           
           
            
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body p-0">
                    <div class="table-responsive table" style="overflow-y: hidden; border-radius: 6px;">
                      <table class="table text-nowrap mb-0 align-middle">
                          <thead class="text-dark fs-4">
                              <tr style="background-color: #7ecbcc">
                                <th class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0"> </h6>
                                </th>
                                <th class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0">Previous</h6>
                                </th>
                                <th class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0">Current</h6>
                                </th>
                              </tr>
                          </thead>
                          <tbody>
    <tr>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">Carbs (Avg. g/day)</p>
        </td>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">{{ isset($secondlatestcarbon) ? $secondlatestcarbon : '0' }}</p>
        </td>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">{{ isset($latestcarbon) ? $latestcarbon : '0' }}</p>
        </td>
    </tr>

    <tr>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">Weight (kg)</p>
        </td>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">{{ isset($secondlatestweight) ? $secondlatestweight : '0' }}</p>
        </td>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">{{ isset($latestweight) ? $latestweight : '0' }}</p>
        </td>
    </tr>

    <tr>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">BMI</p>
        </td>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">{{ isset($secondLatestBMI) ? $secondLatestBMI : '0' }}</p>
        </td>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">{{ isset($latestBMI) ? $latestBMI : '0' }}</p>
        </td>
    </tr>

    <tr>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">Activity (Avg. min/day)</p>
        </td>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">{{ isset($secondlatestactivity) ? $secondlatestactivity : '0' }}</p>
        </td>
        <td class="border-bottom-0">
            <p class="mb-0 fw-normal">{{ isset($latestactivity) ? $latestactivity : '0' }}</p>
        </td>
    </tr>
</tbody>

                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    
                      <b><h4 class="w-100 text-center">HBA1C</h4></b>
                      <div class="row">
                      <div class="col-md-6 chart-container" style='margin-left:0;'>
                        <canvas id="doughnutChart1"></canvas>
                        <div class="chart-percentage col-md-6"></div> <!-- Add a div for displaying the percentage -->
                        <div class="chart-label">Previous</div> <!-- Add a div for displaying the label -->
                      </div>
                    
                      <div class="col-md-6 chart-container" style='margin-left:0;'>
                        <canvas id="doughnutChart2"></canvas>
                        <div class="chart-percentage col-md-6"></div> <!-- Add a div for displaying the percentage -->
                        <div class="chart-label">Current</div> <!-- Add a div for displaying the label -->
                      </div>
</div>
                    
                     

                      <script type="module">
  // Assuming $healthdata contains your data, sorted by date in descending order
  var latestData = <?php echo json_encode($healthdata->firstWhere('date', $healthdata->max('date'))); ?>;
  var secondLatestData = <?php echo json_encode($healthdata->where('date', '<', $healthdata->max('date'))->sortByDesc('date')->first()); ?>;

  if (typeof latestData !== 'undefined' && typeof secondLatestData !== 'undefined') {
    // Display charts with data
    var data1 = {
      labels: [],
      datasets: [{
        data: [parseFloat(secondLatestData.a1cpercentage), 100 - parseFloat(secondLatestData.a1cpercentage)],
        backgroundColor: ['#7ecbcc', '#b8cccd']
      }]
    };

    var options1 = {
      responsive: false,
      cutoutPercentage: 80,
      title: {
        display: true,
        text: '',
      },
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: '#333',
          fontSize: 8,
          padding: 5
        }
      }
    };

    var ctx1 = document.getElementById('doughnutChart1').getContext('2d');
    var doughnutChart1 = new Chart(ctx1, {
      type: 'doughnut',
      data: data1,
      options: options1
    });

    var data2 = {
      labels: [],
      datasets: [{
        data: [parseFloat(latestData.a1cpercentage), 100 - parseFloat(latestData.a1cpercentage)],
        backgroundColor: ['#7ecbcc', '#b8cccd']
      }]
    };

    var options2 = {
      responsive: false,
      title: {
        display: true,
        text: 'Doughnut Chart 2'
      },
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: '#333',
          fontSize: 8,
          padding: 5
        }
      }
    };

    var ctx2 = document.getElementById('doughnutChart2').getContext('2d');
    var doughnutChart2 = new Chart(ctx2, {
      type: 'doughnut',
      data: data2,
      options: options2
    });

    // Update the percentage label for Chart 1
    var chart1Percentage = document.querySelector('#doughnutChart1 + .chart-percentage');
    chart1Percentage.innerText = parseFloat(secondLatestData.a1cpercentage) + '%';

    // Update the percentage label for Chart 2
    var chart2Percentage = document.querySelector('#doughnutChart2 + .chart-percentage');
    chart2Percentage.innerText = parseFloat(latestData.a1cpercentage) + '%';
  } else {
    // Display charts with all values as 0
    var data1 = {
      labels: [],
      datasets: [{
        data: [0, 100],
        backgroundColor: ['#7ecbcc', '#b8cccd']
      }]
    };

    var options1 = {
      responsive: false,
      cutoutPercentage: 80,
      title: {
        display: true,
        text: '',
      },
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: '#333',
          fontSize: 8,
          padding: 5
        }
      }
    };

    var ctx1 = document.getElementById('doughnutChart1').getContext('2d');
    var doughnutChart1 = new Chart(ctx1, {
      type: 'doughnut',
      data: data1,
      options: options1
    });

    var data2 = {
      labels: [],
      datasets: [{
        data: [0, 100],
        backgroundColor: ['#7ecbcc', '#b8cccd']
      }]
    };

    var options2 = {
      responsive: false,
      title: {
        display: true,
        text: 'Doughnut Chart 2'
      },
      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: '#333',
          fontSize: 8,
          padding: 5
        }
      }
    };

    var ctx2 = document.getElementById('doughnutChart2').getContext('2d');
    var doughnutChart2 = new Chart(ctx2, {
      type: 'doughnut',
      data: data2,
      options: options2
    });

    // Update the percentage label for Chart 1
    var chart1Percentage = document.querySelector('#doughnutChart1 + .chart-percentage');
    chart1Percentage.innerText = '0%';

    // Update the percentage label for Chart 2
    var chart2Percentage = document.querySelector('#doughnutChart2 + .chart-percentage');
    chart2Percentage.innerText = '0%';
  }
</script>

                      <!-- <script type="module">
  // Assuming $healthdata contains your data, sorted by date in descending order
  var latestData = <?php echo json_encode($healthdata->firstWhere('date', $healthdata->max('date'))); ?>;
  var secondLatestData = <?php echo json_encode($healthdata->where('date', '<', $healthdata->max('date'))->sortByDesc('date')->first()); ?>;


  var data1 = {
    labels: [],
    datasets: [{
      data: [parseFloat(secondLatestData.a1cpercentage), 100 - parseFloat(secondLatestData.a1cpercentage)],
      backgroundColor: ['#7ecbcc', '#b8cccd']
    }]
  };

  var options1 = {
    responsive: false,
    cutoutPercentage: 80,
    title: {
      display: true,
      text: '',
    },
    legend: {
      display: true,
      position: 'bottom',
      labels: {
        fontColor: '#333',
        fontSize: 8,
        padding: 5
      }
    }
  };

  var ctx1 = document.getElementById('doughnutChart1').getContext('2d');
  var doughnutChart1 = new Chart(ctx1, {
    type: 'doughnut',
    data: data1,
    options: options1
  });

  var data2 = {
    labels: [],
    datasets: [{
      data: [parseFloat(latestData.a1cpercentage), 100 - parseFloat(latestData.a1cpercentage)],
      backgroundColor: ['#7ecbcc', '#b8cccd']
    }]
  };

  var options2 = {
    responsive: false,
    title: {
      display: true,
      text: 'Doughnut Chart 2'
    },
    legend: {
      display: true,
      position: 'bottom',
      labels: {
        fontColor: '#333',
        fontSize: 8,
        padding: 5
      }
    }
  };

  var ctx2 = document.getElementById('doughnutChart2').getContext('2d');
  var doughnutChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: data2,
    options: options2
  });

  // Update the percentage label for Chart 1
  var chart1Percentage = document.querySelector('#doughnutChart1 + .chart-percentage');
  chart1Percentage.innerText = parseFloat(secondLatestData.a1cpercentage) + '%';

  // Update the percentage label for Chart 2
  var chart2Percentage = document.querySelector('#doughnutChart2 + .chart-percentage');
  chart2Percentage.innerText = parseFloat(latestData.a1cpercentage) + '%';
</script> -->


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