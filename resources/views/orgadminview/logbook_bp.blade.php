@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Logbook (Pressure)</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@6.0" type="text/javascript"></script>
            <link href="../assets/css/datatables3.css" rel="stylesheet">
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
                <a href="{{ route('dashboard_generalorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Dashboard</a>
                <a href="{{ route('aboutpatientorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">About Patient</a>
                <a href="{{ route('logbook_bgorg') }}" class="btn btn-primary m-1 active">Logbook</a>
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
                    <a href="{{ route('logbook_bgorg') }}" class="btn btn-light m-1">BG</a>
                    <a href="{{ route('logbook_bporg') }}" class="btn btn-secondary m-1 active">BP</a>
                    </div>
                </div>
                <div class="col-sm-12 d-flex justify-content-center mt-2">
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <button class="btn btn-outline-primary" id="btn-today">Today</button>
                  <button class="btn btn-outline-primary" id="btn-yesterday">Yesterday</button>
                  <button class="btn btn-outline-primary" id="btn-3-days">Since 3 days</button>
                  <button class="btn btn-outline-primary" id="btn-7-days">Since 7 days</button>
                  <button class="btn btn-outline-primary" id="btn-14-days">Since 14 days</button>
                  <button class="btn btn-outline-primary" id="btn-30-days">Since 30 days</button>
                  </div>
                
                
                </div>
                <div class="tab_nav mt-3" >
    <label for="date-range">Select Date Range:</label>
    <input type="text" id="date-range" name="date-range" class="tabnav2" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-bottom: 2vh;margin-top: 2vh; margin-left: 1vw; margin-right: 1vw; width: 20vw;">

    <label for="sort-dropdown">Sort By:</label>
    <select id="sort-dropdown" class="tabnav3" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-top: 2vh; margin-left: 1vw; width: 10vw;">
        <option value="newest">Newest</option>
        <option value="oldest">Oldest</option>
    </select></div>

    
                <!-- table -->
                <div class="table-responsive table" style="overflow-y: hidden;">
                    <table class="table text-nowrap mb-0 align-middle datatable" >
                      <thead class="text-dark fs-4">
                        <tr style="background-color: #7ecbcc;">
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Date</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Blood Pressure Level</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Pulse</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Period</h6>
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody class='tablebody' id="data-list">
                        
                                                       
                      </tbody>
                    </table>
                  </div>
                  
            </div>
        </div>
      </div>


   
      <script>
  document.addEventListener('DOMContentLoaded', function() {
    const dateRangeInput = document.getElementById('date-range');
    flatpickr(dateRangeInput, {
      mode: 'range',
      dateFormat: 'Y-m-d',
      onClose: function(selectedDates, dateStr, instance) {
        filterDataByDate(selectedDates);
      }
    });

    const sortDropdown = document.getElementById('sort-dropdown');
    const dataList = document.getElementById('data-list');
    const btnToday = document.getElementById('btn-today');
  const btnYesterday = document.getElementById('btn-yesterday');
  const btn3Days = document.getElementById('btn-3-days');
  const btn7Days = document.getElementById('btn-7-days');
  const btn14Days = document.getElementById('btn-14-days');
  const btn30Days = document.getElementById('btn-30-days');
    // Function to render the data items in the UI
   // Function to render the data items in the UI
  function renderData(items) {
  dataList.innerHTML = ''; // Clear existing items

  const startDate = dateRangeInput._flatpickr.selectedDates[0];
  const endDate = dateRangeInput._flatpickr.selectedDates[1];

  items.forEach(item => {
    const itemDate = new Date(item.date);

    if (!startDate || !endDate || (itemDate >= startDate && itemDate <= endDate)) {
      
  const tr = document.createElement('tr');
  const tdDate = document.createElement('td');
  const tdLevel = document.createElement('td');
  const tdPulse = document.createElement('td');
  const tdPeriod = document.createElement('td');

  const pDate = document.createElement('p');
  const pLevel = document.createElement('p');
  const pPulse = document.createElement('p');
  const pPeriod = document.createElement('p');

  const level = parseInt(item.level);
      const level2 = parseInt(item.level.split('/')[1]);
      const color = (level >= 140 && level2 >= 90) ? '#EC1F28' : ((level < 140 && level2 < 90 && level >= 90 && level2 >= 60) ? '#67C56D' : '#668DC4');
      pLevel.style.color = color;
  pDate.textContent = item.date;
  pDate.classList.add('mb-0', 'fw-normal');
  
  pLevel.textContent = item.level;
  pLevel.classList.add('txt_num','mb-0', 'fw-normal');
  pPulse.textContent = item.pulse;
  pPulse.classList.add('mb-0', 'fw-normal');
  pPeriod.textContent = item.period;
  pPeriod.classList.add('mb-0', 'fw-normal');
  
  // Add additional classes to tdDate
  tdDate.classList.add('border-bottom-0');
  tdLevel.classList.add('border-bottom-0');
  tdPulse.classList.add('border-bottom-0');
  tdPeriod.classList.add('border-bottom-0');
 
  tdDate.appendChild(pDate);
  tdLevel.appendChild(pLevel);
  tdPulse.appendChild(pPulse);
  tdPeriod.appendChild(pPeriod);

  
  tr.appendChild(tdDate);
  tr.appendChild(tdLevel);
  tr.appendChild(tdPulse);
  tr.appendChild(tdPeriod);

  

  dataList.appendChild(tr);
  }

    });
  }


    const logbookData = [
      @foreach ($logbook as $logbooks)
        @if ($logbooks->patient_id_FK === $patient->patient_id)
          {
            date: '{{ $logbooks->bp_logbook_date }}',
            level: '{{ $logbooks->bp_level }}/{{ $logbooks->bp_level2 }}',
            period: '{{ $logbooks->bp_period }}',
            pulse: '{{ $logbooks->bp_pulse }}',
            
          },
        @endif
        
        
      @endforeach
    ];

    // Function to filter the data based on the selected date range
  // Function to filter the data based on the selected date range

  function filterDataByDate(selectedDates) {
  const startDate = selectedDates[0];
  const endDate = selectedDates[1];

  const filteredData = logbookData.filter(item => {
    const itemDate = new Date(item.date);
    return itemDate >= startDate && itemDate <= endDate;
  });

  renderData(filteredData);
  sortData(sortDropdown.value);
  }



    // Function to sort the data based on the selected option

    function sortData(option) {
      let sortedData;

      if (option === 'newest') {
        sortedData = logbookData.slice().sort((a, b) => new Date(b.date) - new Date(a.date));
      } else if (option === 'oldest') {
        sortedData = logbookData.slice().sort((a, b) => new Date(a.date) - new Date(b.date));
      }

      renderData(sortedData);
    }

    sortDropdown.addEventListener('change', function() {
      const selectedOption = this.value;
      sortData(selectedOption);
    });
    btnToday.addEventListener('click', function() {
  const yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    const today = new Date();
    dateRangeInput._flatpickr.setDate([yesterday, today]); // Update the date range input
    filterDataByDate([yesterday, today]);
  });

  btnYesterday.addEventListener('click', function() {
    const yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    const daybeforeyesterday = new Date();
    daybeforeyesterday.setDate(daybeforeyesterday.getDate() - 2);
    dateRangeInput._flatpickr.setDate([yesterday, daybeforeyesterday]); // Update the date range input
    filterDataByDate([yesterday, daybeforeyesterday]);
  });

  btn3Days.addEventListener('click', function() {
    const today = new Date();
    const threeDaysAgo = new Date(today);
    threeDaysAgo.setDate(today.getDate() - 3);
    dateRangeInput._flatpickr.setDate([threeDaysAgo, today]); // Update the date range input
    filterDataByDate([threeDaysAgo, today]);
  });

  btn7Days.addEventListener('click', function() {
    const today = new Date();
    const sevenDaysAgo = new Date(today);
    sevenDaysAgo.setDate(today.getDate() - 7);
    dateRangeInput._flatpickr.setDate([sevenDaysAgo, today]); // Update the date range input
    filterDataByDate([sevenDaysAgo, today]);
  });

  btn14Days.addEventListener('click', function() {
    const today = new Date();
    const fourteenDaysAgo = new Date(today);
    fourteenDaysAgo.setDate(today.getDate() - 14);
    dateRangeInput._flatpickr.setDate([fourteenDaysAgo, today]); // Update the date range input
    filterDataByDate([fourteenDaysAgo, today]);
  });

  btn30Days.addEventListener('click', function() {
    const today = new Date();
    const thirtyDaysAgo = new Date(today);
    thirtyDaysAgo.setDate(today.getDate() - 30);
    dateRangeInput._flatpickr.setDate([thirtyDaysAgo, today]); // Update the date range input
    filterDataByDate([thirtyDaysAgo, today]);
  });
    // Initial sorting based on the default selected option
    const initialSelectedOption = sortDropdown.value;
    sortData(initialSelectedOption);
  });
  const DATATABLES_URL = 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js';
   $(document).ready(function() {
        // Load DataTables library dynamically
        loadScript(DATATABLES_URL, function() {
            $('.datatable').DataTable({
              lengthMenu: [5, 10, 25, 100], // Define the available entries options
            });
        });
    });

    // Function to dynamically load a script
    function loadScript(url, callback) {
        var script = document.createElement('script');
        script.src = url;
        script.onload = callback;
        document.head.appendChild(script);
    }

</script>        
                                         

</body>
</html>
@endsection 