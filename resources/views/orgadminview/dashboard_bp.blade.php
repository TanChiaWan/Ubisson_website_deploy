@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard Blood Pressure</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Min">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
              <a href="{{ route('dashboard_bporg') }}" class="btn btn-primary m-2 mb-4 active">BP</a>
              <a href="{{ route('dashboard_choorg') }}" class="btn btn-light m-2 mb-4">Cholesterol</a>
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
                          <canvas id="floating-bar-chart" height="500"></canvas>
                        </div>
                        <script type="module">
  let chart = null; // Variable to store the chart instance
  const dateRangeInput = document.getElementById('date-range');
  
  // Set up Flatpickr datepicker
  flatpickr(dateRangeInput, {
    mode: "range",
    dateFormat: "Y-m-d",
    onClose: function (selectedDates, dateStr, instance) {
      // Get the selected date range
      const [startDate, endDate] = selectedDates;

      // Filter the dataPoints based on the selected date range
      const filteredDataPoints = originalDataPoints.filter(dataPoint => {
        const date = new Date(dataPoint.label);
        return date >= startDate && date <= endDate;
      });

      // Destroy the existing chart if it exists
      if (chart) {
        chart.destroy();
      }

      // Update the chart with the filtered data
      updateChart(filteredDataPoints);
    }
  });
  const btnToday = document.getElementById('btn-today');
  const btnYesterday = document.getElementById('btn-yesterday');
  const btn3Days = document.getElementById('btn-3-days');
  const btn7Days = document.getElementById('btn-7-days');
  const btn14Days = document.getElementById('btn-14-days');
  const btn30Days = document.getElementById('btn-30-days');

  btnToday.addEventListener('click', function() {
  const yesterday = new Date();
  yesterday.setDate(yesterday.getDate() - 1);
  const today = new Date();
  dateRangeInput._flatpickr.setDate([yesterday, today]); // Update the date range input

  // Filter the dataPoints based on the selected date range
  const filteredDataPoints = originalDataPoints.filter(dataPoint => {
    const date = new Date(dataPoint.label);
    return date >= yesterday && date <= today;
  });

  updateChart(filteredDataPoints);
});

btnYesterday.addEventListener('click', function() {
  const yesterday = new Date();
  yesterday.setDate(yesterday.getDate() - 1);
  const daybeforeyesterday = new Date();
  daybeforeyesterday.setDate(yesterday.getDate() - 1);
  dateRangeInput._flatpickr.setDate([yesterday, daybeforeyesterday]); // Update the date range input

  // Filter the dataPoints based on the selected date range
  const filteredDataPoints = originalDataPoints.filter(dataPoint => {
    const date = new Date(dataPoint.label);
    return date >= daybeforeyesterday && date <= yesterday;
  });

  updateChart(filteredDataPoints);
});

btn3Days.addEventListener('click', function() {
  const today = new Date();
  const threeDaysAgo = new Date(today);
  threeDaysAgo.setDate(today.getDate() - 3);
  dateRangeInput._flatpickr.setDate([threeDaysAgo, today]); // Update the date range input

  // Filter the dataPoints based on the selected date range
  const filteredDataPoints = originalDataPoints.filter(dataPoint => {
    const date = new Date(dataPoint.label);
    return date >= threeDaysAgo && date <= today;
  });

  updateChart(filteredDataPoints);
});

btn7Days.addEventListener('click', function() {
  const today = new Date();
  const sevenDaysAgo = new Date(today);
  sevenDaysAgo.setDate(today.getDate() - 7);
  dateRangeInput._flatpickr.setDate([sevenDaysAgo, today]); // Update the date range input

  // Filter the dataPoints based on the selected date range
  const filteredDataPoints = originalDataPoints.filter(dataPoint => {
    const date = new Date(dataPoint.label);
    return date >= sevenDaysAgo && date <= today;
  });

  updateChart(filteredDataPoints);
});

btn14Days.addEventListener('click', function() {
  const today = new Date();
  const fourteenDaysAgo = new Date(today);
  fourteenDaysAgo.setDate(today.getDate() - 14);
  dateRangeInput._flatpickr.setDate([fourteenDaysAgo, today]); // Update the date range input

  // Filter the dataPoints based on the selected date range
  const filteredDataPoints = originalDataPoints.filter(dataPoint => {
    const date = new Date(dataPoint.label);
    return date >= fourteenDaysAgo && date <= today;
  });

  updateChart(filteredDataPoints);
});

btn30Days.addEventListener('click', function() {
  const today = new Date();
  const thirtyDaysAgo = new Date(today);
  thirtyDaysAgo.setDate(today.getDate() - 30);
  dateRangeInput._flatpickr.setDate([thirtyDaysAgo, today]); // Update the date range input

  // Filter the dataPoints based on the selected date range
  const filteredDataPoints = originalDataPoints.filter(dataPoint => {
    const date = new Date(dataPoint.label);
    return date >= thirtyDaysAgo && date <= today;
  });

  updateChart(filteredDataPoints);
});

  // Original dataPoints array
  const originalDataPoints = [
    @foreach ($healthdata->sortBy('date')->take(7) as $healthdatas)
    {
      label: '{{ date("Y-m-d", strtotime($healthdatas->date)) }}',
      numerator: {{ $healthdatas->sbp }},
      denominator: {{ $healthdatas->dbp }},
      pulse: {{ $healthdatas->pulse }}
    },
    @endforeach
  ];

  // Function to update the chart with filtered data
  function updateChart(filteredDataPoints) {
    // Sort the filtered dataPoints array based on the date
    filteredDataPoints.sort((a, b) => new Date(a.label) - new Date(b.label));

    const labels = filteredDataPoints.map(dataPoint => dataPoint.label);
    const pulseData = filteredDataPoints.map(dataPoint => dataPoint.pulse);

    const data = {
      labels: labels,
      datasets: [
        {
          label: 'Pulse',
          data: pulseData,
          backgroundColor: 'rgba(14, 111, 197, 0.5)',
          borderColor: 'rgba(14, 111, 197, 1)',
          borderWidth: 1,
          type: 'scatter',
          pointRadius: 4,
          pointStyle: 'circle'
        },
        {
          label: 'SBP/DBP',
          data: filteredDataPoints.map(dataPoint => ({
            x: dataPoint.label,
            y: [dataPoint.numerator, dataPoint.denominator],
            numerator: dataPoint.numerator,
            denominator: dataPoint.denominator
          })),
          backgroundColor: 'rgba(126, 203, 204, 0.5)',
          borderColor: 'rgba(126, 203, 204, 1)',
          borderWidth: 1,
          type: 'bar',
          barThickness: 8,
          borderRadius: { topLeft: 8, topRight: 8, bottomLeft: 0, bottomRight: 0 },
          stacked: false
        }
      ]
    };
    const startDate = labels[0]; // Get the start date from the filtered data
  const endDate = labels[labels.length - 1]; // Get the end date from the filtered data

    const config = {
  type: 'bar',
  data: data,
  options: {
    indexAxis: 'x',
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'top',
        labels: {
          usePointStyle: true,
          generateLabels: function(chart) {
            const originalLabels = Chart.defaults.plugins.legend.labels.generateLabels(chart);
            const modifiedLabels = originalLabels.map(label => {
              if (label.text === 'Pulse') {
                label.pointStyle = 'circle';
              }
              return label;
            });
            return modifiedLabels;
          }
        }
      },
      tooltip: {
        callbacks: {
          label: function(context) {
            const datasetLabel = context.dataset.label || '';
            const dataValue = context.parsed.y;
            if (datasetLabel === 'Pulse') {
              return datasetLabel + ': ' + dataValue;
            } else {
              const numerator = context.dataset.data[context.dataIndex].numerator;
              const denominator = context.dataset.data[context.dataIndex].denominator;
              return datasetLabel + ': ' + numerator + '/' + denominator;
            }
          }
        }
      },
      title: {
        display: true,
       
      }
    },
    scales: {
      x: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Days',
          color: '#000000',
          font: {
            size: 12,
            weight: 'bold'
          }
        },
      },
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Blood Pressure Level (mmHg)',
          color: '#000000',
          font: {
            size: 12,
            weight: 'bold'
          }
        },
        max: 200,
        grid: {
          drawBorder: false,
          color: function(context) {
            if (context.tick.value === 80 || context.tick.value === 120) {
              return 'rgba(255, 0, 0, 1)';
            }
            return 'rgba(0, 0, 0, 0.1)';
          },
          lineWidth: function(context) {
            if (context.tick.value === 80 || context.tick.value === 120) {
              return 2;
            }
            return 1;
          },
          borderDash: function(context) {
            if (context.tick.value === 80 || context.tick.value === 120) {
              return [5, 5];
            }
            return undefined;
          },
          drawTicks: false
        },
        ticks: {
          stepSize: 10
        },
       
      }
    }
  }
};

    var ctx = document.getElementById('floating-bar-chart').getContext('2d');

    // Destroy the existing chart if it exists
    if (chart) {
      chart.destroy();
    }

    // Create a new chart
    chart = new Chart(ctx, config);
  }

  // Initial chart setup
  updateChart(originalDataPoints);
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