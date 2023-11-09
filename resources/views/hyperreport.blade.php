@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="create">
    <meta name="author" content="Kong">
    <meta name="keywords" content="Organization">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>BioTectiveDRC</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
</head>

<body>
<div class="container-fluid">

    <h5 class="fw-semibold mb-4">Hyper Events</h5>
    <div class="row justify-content-end">
        <div class="col-md-5 mb-3 text-end">
            <div class="d-flex justify-content-end">
                <select class="form-select me-4" style="width: 130%;padding-right: 35px; margin-right: 30px;" name="event_type" id="event_type">
  
                    <option value="blood_glucose">Blood Glucose</option>
                    <option value="blood_pressure">Blood Pressure</option>
                </select>
                <input type="text" style="width: 204%;" class="form-select" id="date_start" name="date_start"
       value="" min="2000-01-01" max="2050-12-31" >

        
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <canvas id="chartCanvas" height='500'></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script defer>
document.addEventListener('DOMContentLoaded', function() {
    var canvas = document.getElementById('chartCanvas').getContext('2d');
    var eventSelect = document.getElementById('event_type');
    var selectedOption = eventSelect.value;
    var period = @json($period);
    var bg_period = @json($bg_period);

    var bgLevels = @json($bgLevels);
        var bgLogbookDate = @json($bg_logbook_date);
       var criteria1 = @json($criteria1);
       var criteria2 = @json($criteria2);
        // var maxAxisValue = criteria2 > 10 ? 20 : 15;
        var bpLevels = @json($bpLevels);
        var bpLevels2 = @json($bpLevels2);
        var bpLogbookDate = @json($bp_logbook_date);
    var criteria3 = @json($criteria3);
    var criteria4 = @json($criteria4);
    //     var maxBpAxisValue = criteria4 > 100 ? 200 : 150;
    //      bgLogbookDate.sort(function(a, b) {
    //     return new Date(a) - new Date(b);
    // });
    
   // Count the number of unique bgLevels
      // Count the number of each bg_period
      var sortOrder = [
        'Wakeup',
        'Before Breakfast',
        'After Breakfast',
        'Before Lunch',
        'After Lunch',
        'Before Dinner',
        'After Dinner',
        'Bedtime',
    ];
if(bg_period){ // Sort bg_period based on the custom order
    bg_period.sort(function(a, b) {
        return sortOrder.indexOf(a) - sortOrder.indexOf(b);
    });

    // Count the number of unique bgLevels

    // Count the number of each bg_period
    var periodCounts = {};

    bg_period.forEach(function(periodValue) {
        if (!periodCounts[periodValue]) {
            periodCounts[periodValue] = 1;
        } else {
            periodCounts[periodValue]++;
        }
    });

    // Extract unique bg_period values as x-axis labels
    var uniqueBgPeriods = Object.keys(periodCounts);
    var totalPatients = uniqueBgPeriods.map(function(periodValue) {
        return periodCounts[periodValue];
    });}
   

    var data = {
        labels: uniqueBgPeriods, // Use unique bg_period values as labels
        datasets: [
            {
                label: 'Total Patients',
                data: totalPatients, // Use the total patients here
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 3,
                fill: false,
                cubicInterpolationMode: 'monotone',
            },
        ]
    };

    var options = {
        maintainAspectRatio: false,
        scales: {
            x: {
                scaleLabel: {
                    display: true,
                    labelString: 'Types of BG Period'
                },
                grid: {
                    display: false
                }
            },
            y: {
                scaleLabel: {
                    display: true,
                    labelString: 'Total Patients'
                },
                grid: {
                    display: false
                },
            }
        }
    };

    var chart = new Chart(canvas, {
        type: 'bar',
        data: data,
        options: options
    });

    // Set the chart title with criteria1 and criteria2
    chart.options.plugins.title.text = `Criteria 1: ${criteria1}, Criteria 2: ${criteria2}`;
    

     var dateStartInput = document.getElementById('date_start');
    
     if(bgLogbookDate){  
        var startDate = new Date(bgLogbookDate[1]).toISOString().split('T')[0];
        var endDate = new Date(bgLogbookDate[bgLogbookDate.length - 1]).toISOString().split('T')[0];
        bgLogbookDate.sort(function(a, b) {
        return new Date(a) - new Date(b);
    });
    dateStartInput.value =  startDate + ' - ' + endDate ;}
       

    
    eventSelect.addEventListener('change', function() {
        
        
        selectedOption = eventSelect.value;
    if (selectedOption === 'blood_glucose') {
        // Blood Glucose Chart Data and Options
        if (chart) {
            chart.destroy(); // Destroy the previous chart instance
        }
        
        data = {
        labels: uniqueBgPeriods, // Use unique bg_period values as labels
        datasets: [
            {
                label: 'Total Patients',
                data: totalPatients, // Use the total patients here
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 3,
                fill: false,
                cubicInterpolationMode: 'monotone',
            },
        ]
    };

    var options = {
        maintainAspectRatio: false,
        scales: {
            x: {
                scaleLabel: {
                    display: true,
                    labelString: 'Types of BG Period'
                },
                grid: {
                    display: false
                }
            },
            y: {
                scaleLabel: {
                    display: true,
                    labelString: 'Total Patients'
                },
                grid: {
                    display: false
                },
            }
        }
    };
    if(bgLogbookDate){  
        var startDate = new Date(bgLogbookDate[1]).toISOString().split('T')[0];
        var endDate = new Date(bgLogbookDate[bgLogbookDate.length - 1]).toISOString().split('T')[0];
        bgLogbookDate.sort(function(a, b) {
        return new Date(a) - new Date(b);
    });
    dateStartInput.value =  startDate + ' - ' + endDate ;}
      
        // Set the value of the input field to show the date range
        
        chart = new Chart(canvas, {
        type: 'bar',
        data: data,
        options: options
    });
    } else if (selectedOption === 'blood_pressure') {
        // Blood Pressure Chart Data and Options
        if (chart) {
            chart.destroy(); // Destroy the previous chart instance
        }
       
       // Create an array to hold the categories and initialize counters for each category
var categories = ["Elevated", "Stage 1", "Stage 2", "Hypertensive Crisis"];
var categoryCounts = [ 0, 0, 0, 0];
if(bpLevels){for (var i = 0; i < bpLevels.length; i++) {
    var bp2 = bpLevels[i];
    var bp1 = bpLevels2[i];

   if (bp1 < 80 && bp2 >= 120 && bp2 < 130) {
        categoryCounts[0]++; // Elevated
    } else if ((bp1 >= 80 && bp1 < 90) || (bp2 >= 130 && bp2 < 140)) {
        categoryCounts[1]++; // Stage 1
    } else if ((bp1 >= 90 && bp1 <= 119) || (bp2 >= 140 && bp2 <= 179)) {
        categoryCounts[2]++; // Stage 2
    } else {
        categoryCounts[3]++; // Hypertensive Crisis
    }
}}
// Iterate through the data and categorize each data point


// Update your chart data to use the categories array as labels for the x-axis and categoryCounts for the y-axis
var data = {
    labels: categories, // Use categories as x-axis labels
    datasets: [
        {
            label: 'Number of Patients',
            data: categoryCounts, // Use categoryCounts as y-axis data
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 3,
            fill: false,
            cubicInterpolationMode: 'monotone',
        }
    ]
};

// Your options object and chart creation code remains the same
var options = {
    maintainAspectRatio: false,
    scales: {
        x: {
            scaleLabel: {
                display: true,
                labelString: 'BP Categories' // Update the x-axis label
            },
            grid: {
                display: false
            }
        },
        y: {
            max: Math.max(...categoryCounts), // Set the y-axis max based on category counts
            min: 0,
            scaleLabel: {
                display: true,
                labelString: 'Number of Patients' // Update the y-axis label
            },
            ticks: {
                min: 0,
                max: Math.max(...categoryCounts), // Set the y-axis max based on category counts
            },
            grid: {
                display: false
            },
        }
    }
};

// Create the chart
chart = new Chart(canvas, {
    type: 'bar',
    data: data,
    options: options
});
        bpLogbookDate.sort(function(a, b) {
        return new Date(a) - new Date(b);
    });
        dateStartInput.value = bpLogbookDate[1] + ' - ' + bpLogbookDate[bpLogbookDate.length - 1];
       
    }
   
   
    
});
});

</script>

</body>
</html>
@endsection
