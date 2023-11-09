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
        
        <style>
  .chart-container {
    display: inline-block;
    margin-right: 20px; /* Add spacing between the charts */
    vertical-align: top; /* Align the charts at the top */
  }
</style>
        

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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6" >
                                <div  style="margin-left: 1vw;margin-bottom: 2vh;">
                                    <canvas id="time_in_range"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div  style="margin-right: 1vw;margin-bottom: 2vh;">
                                    <canvas id="second_pie_chart" ></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="chart-container">
                            <canvas id="time_in_range" style="height: 426px; width: 426px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="chart-container">
                            <canvas id="second_pie_chart" style="height: 426px; width: 426px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        
        <script>
    document.addEventListener("DOMContentLoaded", function () {
        const data1 = [
            { area: "Hyper", count: 0, percentage: 0 },
            { area: "Normal", count: 0, percentage: 0 },
            { area: "Hypo", count: 0, percentage: 0 },
        ];
        const totalCount1 = data1.reduce((sum, item) => sum + item.count, 0);

        // Convert counts to percentages
        data1.forEach(item => {
            item.percentage = (item.count / totalCount1) * 100;
        });

        const data2 = [
            { area: "Hyper", count: 0, percentage: 0 },
            { area: "Normal", count: 0, percentage: 0 },
            { area: "Hypo", count: 0, percentage: 0 },
        ];
        const totalCount2 = data2.reduce((sum, item) => sum + item.count, 0);

        // Convert counts to percentages
        data2.forEach(item => {
            item.percentage = (item.count / totalCount2) * 100;
        });

        // Assuming $logbook->bg_level and $patients->targetBG_low_BC and $patients->targetBG_high_BC are available

        const dateRangeInput = document.getElementById('date-range');
        const logbook = {!! json_encode($logbook) !!};
        const patient = {!! json_encode($patient) !!};
        let chart1 = null;
        let chart2 = null;

        // Set up Flatpickr datepicker
        flatpickr(dateRangeInput, {
            mode: "range",
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                // Get the selected date range
                const [startDate, endDate] = selectedDates;

                // Filter the logbook data based on the selected date range
                const filteredLogbook = logbook.filter(entry => {
                    const entryDate = new Date(entry.bg_logbook_date);
                    return entryDate >= startDate && entryDate <= endDate;
                });

                // Update data1 with the filtered logbook data
                updateData1(filteredLogbook);

                // Update data2 with the filtered logbook data
                updateData2(filteredLogbook);

                // Destroy the existing charts if they exist
                if (chart1) {
                    chart1.destroy();
                }
                if (chart2) {
                    chart2.destroy();
                }

                // Update the charts with the filtered data
                chart1 = createChart(data1, "time_in_range", "Time in Range (Before Consumption)");
                chart2 = createChart(data2, "second_pie_chart", "Time in Range (After Consumption)");
            }
        });

        // Initialize data1 with all logbook data
        updateData1(logbook);

        // Initialize data2 with all logbook data
        updateData2(logbook);

        // Initialize the charts with data1 and data2
        chart1 = createChart(data1, "time_in_range", "Time in Range (Before Consumption)");
        chart2 = createChart(data2, "second_pie_chart", "Time in Range (After Consumption)");

        function updateData1(logbookData) {
            // Reset data1
            data1.forEach(item => {
                item.count = 0;
                item.percentage = 0;
            });

            // Loop through logbookData and update data1 based on the filter criteria
            logbookData.forEach(entry => {
                const bgLevel = parseFloat(entry.bg_level);
                const targetLow = parseFloat(patient.targetBG_low_BC);
                const targetHigh = parseFloat(patient.targetBG_high_BC);

                if (bgLevel > targetHigh) {
                    data1[0].count++; // Increment Hyper count
                } else if (bgLevel < targetLow) {
                    data1[2].count++; // Increment Hypo count
                } else {
                    data1[1].count++; // Increment Normal count
                }
            });

            // Calculate the total count for data1
            const totalCount1 = data1.reduce((total, item) => total + item.count, 0);

            // Calculate and update the percentages for data1
            data1.forEach(item => {
                item.percentage = ((item.count / totalCount1) * 100).toFixed(2);
            });
        }

        function updateData2(logbookData) {
            // Reset data2
            data2.forEach(item => {
                item.count = 0;
                item.percentage = 0;
            });

            // Loop through logbookData and update data2 based on the filter criteria
            logbookData.forEach(entry => {
                const bgLevel = parseFloat(entry.bg_level);
                const targetLow = parseFloat(patient.targetBG_low_AC);
                const targetHigh = parseFloat(patient.targetBG_high_AC);

                if (bgLevel > targetHigh) {
                    data2[0].count++; // Increment Hyper count
                } else if (bgLevel < targetLow) {
                    data2[2].count++; // Increment Hypo count
                } else {
                    data2[1].count++; // Increment Normal count
                }
            });

            // Calculate the total count for data2
            const totalCount2 = data2.reduce((total, item) => total + item.count, 0);

            // Calculate and update the percentages for data2
            data2.forEach(item => {
                item.percentage = ((item.count / totalCount2) * 100).toFixed(2);
            });
        }

        function createChart(data, chartId, chartTitle) {
            return new Chart(document.getElementById(chartId), {
                type: "bar",
                data: {
                    labels: ["Combined"],
                    datasets: [
                        {
                            label: "Hyper",
                            data: [data[0].percentage], // Use percentage data
                            backgroundColor: "#EC1F28",
                        },
                        {
                            label: "Normal",
                            data: [data[1].percentage], // Use percentage data
                            backgroundColor: "#67C56D",
                        },
                        {
                            label: "Hypo",
                            data: [data[2].percentage], // Use percentage data
                            backgroundColor: "#668DC4",
                        },
                    ],
                },
                options: {
                    indexAxis: 'y',
                    maintainAspectRatio: false,
                    plugins: {
                        datalabels: {
                            display: true,
                            anchor: 'start',
                            align: 'top',
                            color: 'black',
                            font: {
                                weight: 'bold'
                            },
                            formatter: function (value, context) {
                                return value.toFixed(2) + '%'; // Display percentages with two decimal places
                            }
                        },
                        title: {
                            display: true,
                            text: chartTitle,
                            font: {
                                size: 18,
                                color: "black",
                            },
                        },
                        legend: {
                            display: true,
                            position: "top",
                        },
                    },
                    scales: {
                        x: {
                            ticks: { mirror: true },
                            stacked: true,
                            display: false,
                        },
                        y: {
                            ticks: { mirror: true },
                            stacked: true,
                            beginAtZero: true,
                            display: false,
                        },
                    },
                },
            });
        }
    });
</script>



    

      

    



<div class="tab_nav my-3">
                  <label for="date-range">Select Date Range:</label>
                  <input type="text" id="date-range2" name="date-range" class="tabnav2" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-bottom: 2vh;margin-top: 2vh; margin-left: 1vw; margin-right: 1vw; width: 20vw;">

                

                </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-md-6">
                    <canvas id="bg_comparison" style="height: 400px; width: 400px;"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="bg_comparison2" style="height: 400px; width: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateRangeInput = document.getElementById('date-range2');

        flatpickr(dateRangeInput, {
            mode: 'range',
            dateFormat: 'Y-m-d',
            onClose: function (selectedDates, dateStr, instance) {
                filterDataByDate(selectedDates, chart1, initialLogbookData1);
                filterDataByDate(selectedDates, chart2, initialLogbookData2);
            }
        });

        // Initialize the first chart with the "Before Meal" logbook data
        const initialLogbookData1 = [
            @foreach ($logbook as $logbooks)
            @if ($logbooks->patient_id_FK === $patient->patient_id && strpos($logbooks->bg_period, 'Before') === 0)
            {
                date: '{{ date("Y-m-d", strtotime($logbooks->bg_logbook_date)) }}',
                level: '{{ $logbooks->bg_level }}',
                period: '{{ $logbooks->bg_period }}',
            },
            @endif
            @endforeach
        ];

        const chart1 = initializeChart(initialLogbookData1, 'bg_comparison');

        // Initialize the second chart with the "After Meal" logbook data
        const initialLogbookData2 = [
            @foreach ($logbook as $logbooks)
            @if ($logbooks->patient_id_FK === $patient->patient_id && strpos($logbooks->bg_period, 'After') === 0)
            {
                date: '{{ date("Y-m-d", strtotime($logbooks->bg_logbook_date)) }}',
                level: '{{ $logbooks->bg_level }}',
                period: '{{ $logbooks->bg_period }}',
            },
            @endif
            @endforeach
        ];

        const chart2 = initializeChart(initialLogbookData2, 'bg_comparison2');

        function filterDataByDate(selectedDates, chart, initialData) {
            const [startDate, endDate] = selectedDates;

            // Filter the initial logbook data based on the selected date range
            const filteredData = initialData.filter(entry => {
                const entryDate = new Date(entry.date);
                return entryDate >= startDate && entryDate <= endDate;
            });

            // Update the chart with the filtered data
            updateChart(chart, filteredData);
        }

        function initializeChart(data, chartId) {
            const groupedData = groupDataByDate(data);
            const averages = calculateAverages(groupedData);
            const dates = Object.keys(groupedData);
            dates.sort((a, b) => new Date(a) - new Date(b));
            const formattedDates = dates.map(date => {
                const dateParts = date.split('-');
                return `${dateParts[0]}-${dateParts[1]}-${dateParts[2]}`;
            });

            return new Chart(
                document.getElementById(chartId),
                {
                    type: 'line',
                    data: {
                        labels: formattedDates,
                        datasets: [
                            {
                                label: `Average Blood Glucose Level (${chartId === 'bg_comparison' ? 'Before' : 'After'} Meal)`,
                                data: averages,
                                borderColor: '#3F6AB1',
                                borderWidth: 3
                            },
                        ],
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                title: {
                                    display: true,
                                    text: 'Blood Glucose Level (mmol/L)',
                                    color: '#000000',
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    }
                                },
                                grid: {
                                    display: false
                                },
                                suggestedMin: 3.5,
                                suggestedMax: 7.5
                            },
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
                        },
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: `Average Blood Glucose Level (${chartId === 'bg_comparison' ? 'Before' : 'After'} Consumption)`,
                                font: {
                                    size: 18,
                                    color: 'black'
                                }
                            },
                        }
                    },
                }
            );
        }

        function updateChart(chart, data) {
            const groupedData = groupDataByDate(data);
            const averages = calculateAverages(groupedData);
            const dates = Object.keys(groupedData);
            dates.sort((a, b) => new Date(a) - new Date(b));
            const formattedDates = dates.map(date => {
                const dateParts = date.split('-');
                return `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
            });

            chart.data.labels = formattedDates;
            chart.data.datasets[0].data = averages;
            chart.update();
        }

        function groupDataByDate(data) {
            const groupedData = {};

            data.forEach(entry => {
                const date = entry.date;
                if (!groupedData[date]) {
                    groupedData[date] = [];
                }
                groupedData[date].push(parseFloat(entry.level));
            });

            return groupedData;
        }

        function calculateAverages(groupedData) {
            const averages = [];

            for (const date in groupedData) {
                if (groupedData.hasOwnProperty(date)) {
                    const readings = groupedData[date];
                    const average = readings.reduce((acc, val) => acc + val, 0) / readings.length;
                    averages.push(average.toFixed(2));
                }
            }

            return averages;
        }
    });
</script>


            </div>



            
          </div>
        </div>
      </div>
                      </body>

</html>
@endsection 