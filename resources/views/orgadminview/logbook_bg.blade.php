
@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Logbook (Glucose)</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/js/app.js')
        <!--CSS -->
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
                    <a href="{{ route('logbook_bgorg') }}" class="btn btn-secondary m-1 active">BG</a>
                    <a href="{{ route('logbook_bporg') }}" class="btn btn-light m-1">BP</a>

                   
                      
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between mt-2">
                  <div class="btn-group" role="group" aria-label="Basic example">
                   <button class="btn btn-outline-primary" id="btn-today">Today</button>
                  <button class="btn btn-outline-primary" id="btn-yesterday">Yesterday</button>
                  <button class="btn btn-outline-primary" id="btn-3-days">Since 3 days</button>
                  <button class="btn btn-outline-primary" id="btn-7-days">Since 7 days</button>
                  <button class="btn btn-outline-primary" id="btn-14-days">Since 14 days</button>
                  <button class="btn btn-outline-primary" id="btn-30-days">Since 30 days</button>
                  </div>
                
                  <div class="btn-group" role="group" aria-label="First group">
                 
                  <a href="{{ route('logbook_bgorg') }}" class="btn btn-outline-secondary active" style="border-top-right-radius: 0; border-bottom-right-radius: 0;"><i class="ti ti-layout-list"></i></a>
<a href="{{ route('logbook_bg2org') }}" class="btn btn-outline-secondary" style="border-top-left-radius: 0; border-bottom-left-radius: 0;"><i class="ti ti-table"></i></a>

                  
                   
                  </div>
                </div>
                <div class="tab_nav mt-3" >
    <label for="date-range">Select Date Range:</label>
    <input type="text" id="date-range" name="date-range" class="tabnav2" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-bottom: 2vh;margin-top: 2vh; margin-left: 1vw; margin-right: 1vw; width: 20vw;">

    <label for="sort-dropdown">Sort By:</label>
    <select id="sort-dropdown" class="tabnav3" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-top: 2vh; margin-left: 1vw; width: 10vw;">
        <option value="newest">Newest</option>
        <option value="oldest">Oldest</option>
    </select>

         </div>
         
         <div class="modal fade" id="log_detail_modal" tabindex="-1">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">2023-07-13 Thursday</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body pt-0">
                        <div class="row">
                          <div class="col-md-12 d-flex justify-content-between py-3">
                            <div class="ps-4 text-center">
                              <h1 class="mb-0" style="color: red">8.2 </h1><small>mmol/L</small>
                            </div>
                            <div class="pe-4">
                              <p ><!--<i class="ti ti-building-hospital" style="font-size: large;"></i><i class="ti ti-device-mobile" style="font-size: large;"></i>--><i class="ti ti-heart-rate-monitor" style="font-size: large;"></i> <span id='period_time'><span></p>
                              <p id="period_info"><span id="period_info2" class="pe-2"></span><a href="javascript:void(0);" onclick="handleEditPeriod()"><i class="ti ti-pencil" ></i></a></p>
                              <p id="period_edit" style="display: none;">
                                  <select id="period_select">
                                    <option value="Wake up">Wake up</option>
                                    <option value="Before Breakfast">Before Breakfast</option>
                                    <option value="After Breakfast">After Breakfast</option>
                                    <option value="Before Lunch">Before Lunch</option>
                                    <option value="After Lunch">After Lunch</option>
                                    <option value="Before Dinner">Before Dinner</option>
                                    <option value="After Dinner">After Dinner</option>
                                    <option value="Bedtime">Bedtime</option>
                                  </select>
                                <a href="javascript:void(0);" onclick="saveEditPeriod({})"><i class="ti ti-check"></i></a>
                              </p>
                            </div>
                            <script>
                              
                              function handleEditPeriod(logId) {
                                
                                document.getElementById("period_info").style.display = "none";
                                document.getElementById("period_edit").style.display = "block";
                                  }
                                
                              function saveEditPeriod(logbook_id) {
                                document.getElementById("period_info").style.display = "block";
                                document.getElementById("period_edit").style.display = "none";
                                const currentDate = new Date();
  const formattedDate = currentDate.toISOString().split('T')[0]; // Extract YYYY-MM-DD
                                const periodSelect = document.getElementById('period_select').value;
                                document.getElementById("period_info2").textContent = periodSelect;
                                
                                     

                                       // Send AJAX request to update the period
    fetch(`/update_logbook/${logbook_id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ newPeriod: periodSelect })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
      // Update the table with the new period
      
    }
        console.log(data); // Log the response for debugging
    })
    .catch(error => {
        console.error('Error updating period:', error);
    });
    updateTable(logbook_id, periodSelect,formattedDate);
                              }
                              
                            
                              function updateTable(logbook_id, newPeriod, newTime) {
  const row = document.querySelector(`tr[data-logbook-id="${logbook_id}"]`);
  console.log(row);
  if (row) {
    const periodCell = row.querySelector('.period-cell');
 

    if (periodCell) {
      periodCell.textContent = newPeriod;
    }
   
  }
}
                            

                            
                            </script>
                          </div>
                          <div class="col-md-4 text-center">
                            <i class="ti ti-baguette" style="font-size: x-large;"></i>
                            <p class="mb-0" style="font-size: large;"> <small></small></p>
                            <p id="carb"><small>Carbohydrate</small></p>
                          </div>
                          <div class="col-md-4 text-center">
                            <i class="ti ti-vaccine" style="font-size: x-large;"></i>
                            <p class="mb-0" style="font-size: large;"> <small></small></p>
                            <p id="rapid"><small>Rapid acting</small></p>
                          </div>
                          <div class="col-md-4 text-center">
                            <i class="ti ti-run" style="font-size: x-large;"></i>
                            <p class="mb-0" style="font-size: large;"> <small></small></p>
                            <p id='exercise'><small>Exercise</small></p>
                          </div>
                          <div class="col-md-12 py-4">
                            <p class="fw-semibold" id='image_title'>Shakiness, Sweating, Thirsty, Dry Mouth, Weakness</p>
                            <img id='image'src="../assets/images/logbook_diaglog_img_placeholder.png" style="max-width: 20vw;">
                          </div>
                          <div class="col-md-12">
                            <textarea class="form-control" rows="3" placeholder="Send message to the patient..."></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer pt-0 pb-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success">Send</button>
                      </div>
                    </div>
                  </div>
              </div>
                <!-- table -->
                <div class="table-responsive table" style="overflow-y: hidden;">
                    <table class="table text-nowrap mb-0 align-middle datatable" >
                      <thead class="text-dark fs-4">
                        <tr style="background-color: #7ecbcc;">
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Date</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Blood Glucose Level</h6>
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


   

<!-- Add the Bootstrap JavaScript library before your custom script -->


                       
      <script defer>
  document.addEventListener('DOMContentLoaded', function() {
    const logbookData = [
  @foreach ($logbook as $logbooks)
    @if ($logbooks->patient_id_FK === $patient->patient_id)
      {
       
        date: '{{ $logbooks->bg_logbook_date }}',
        level: '{{ $logbooks->bg_level }}',
        period: '{{ $logbooks->bg_period }}',
       carb:'{{ $logbooks->carbohydrate }}',
       rapid:'{{ $logbooks->rapid }}',
       exercise:'{{ $logbooks->exercise }}',
       image:'{{ $logbooks->image }}',
       image_title:'{{ $logbooks->image_title }}',
        logbook_id: '{{ $logbooks->logbook_id }}', // Add logbook_id here
      },
    @endif
  @endforeach
];
    console.log(logbookData);
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

  // Event listeners for the buttons to filter data based on selected date range
let currentPage = 0; // Global variable to store the current page
let table; // Global variable to store the DataTable instance







    // Function to render the data items in the UI
   // Function to render the data items in the UI
   function renderData(items) {
  dataList.innerHTML = ''; // Clear existing items
  
  const startDate = dateRangeInput._flatpickr.selectedDates[0];
  const endDate = dateRangeInput._flatpickr.selectedDates[1];

  items.forEach((item, index) => {
    const itemDate = new Date(item.date);

    if (!startDate || !endDate || (itemDate >= startDate && itemDate <= endDate)) {
      const tr = document.createElement('tr');
      const tdDate = document.createElement('td');
      const tdLevel = document.createElement('td');
      const tdPeriod = document.createElement('td');
     
      const pDate = document.createElement('p');
      const pLevel = document.createElement('p');
      const pPeriod = document.createElement('p');
  
 const originalDate = new Date(item.date);
  // Format the date as Y/m/d
  const formattedDate = originalDate.getFullYear() + '-' + (originalDate.getMonth() + 1) + '-' + originalDate.getDate();
      pDate.textContent = formattedDate;
      pDate.classList.add('mb-0', 'fw-normal');

      pLevel.classList.add('txt_num', 'mb-0', 'fw-normal');
      pLevel.textContent = item.level;


      const glucoseLevelValue = parseFloat(item.level);
      if (!isNaN(glucoseLevelValue)) {
        if (glucoseLevelValue > 7.8) {
          pLevel.innerHTML = `<a href="#" data-bs-toggle="modal" data-bs-target="#log_detail_modal" data-logbook-id="${item.logbook_id}"><span style="color: #EC1F28">${item.level}</span></a>`;
        } else if (glucoseLevelValue < 4.0) {
          pLevel.innerHTML = `<a href="#" data-bs-toggle="modal" data-bs-target="#log_detail_modal" data-logbook-id="${item.logbook_id}"><span style="color: #668DC4">${item.level}</span></a>`;
        } else {
          pLevel.innerHTML = `<a href="#" data-bs-toggle="modal" data-bs-target="#log_detail_modal" data-logbook-id="${item.logbook_id}"><span style="color: #67C56D">${item.level}</span></a>`;
        }
      } else {
        // Invalid glucose level value, handle the error or set a default behavior
        // For example, you can display an error message or set the level to a neutral color
        pLevel.textContent = 'Invalid value';
      }

      pPeriod.textContent = item.period;
      pPeriod.classList.add('mb-0', 'fw-normal');

     
      

      // Set the correct modal ID in data-bs-target using dot notation

      // Append the "More Info" link to the appropriate column

      // Add additional classes to tdDate
      tdDate.classList.add('border-bottom-0');
      tdDate.classList.add('time-cell');
      tdLevel.classList.add('border-bottom-0');
      tdPeriod.classList.add('border-bottom-0');
      tdPeriod.classList.add('period-cell');
    

      tdDate.appendChild(pDate);
      tdLevel.appendChild(pLevel);
      tdPeriod.appendChild(pPeriod);
      
      tr.setAttribute('data-logbook-id', item.logbook_id);
      tr.appendChild(tdDate);
      tr.appendChild(tdLevel);
      tr.appendChild(tdPeriod);
      

      dataList.appendChild(tr);
    }
  });

  // Add event listener to blood glucose level elements in the logbook table
  const bloodGlucoseLevels = document.querySelectorAll('.tablebody .txt_num a');

  bloodGlucoseLevels.forEach(level => {
  level.addEventListener('click', function (event) {
    event.preventDefault();
    const logbookId = this.getAttribute('data-logbook-id');
    const rowData = logbookData.find((item) => item.logbook_id === logbookId);
    openModal(rowData, logbookId); // Pass logbook_id to openModal function
  });
});
}
function sortData(option) {
      let sortedData;

      if (option === 'newest') {
        sortedData = logbookData.slice().sort((a, b) => new Date(b.date) - new Date(a.date));
      } else if (option === 'oldest') {
        sortedData = logbookData.slice().sort((a, b) => new Date(a.date) - new Date(b.date));
      }

      renderData(sortedData);
    }
    function filterDataByDate(selectedDates) {
  const startDate = selectedDates[0];
  const endDate = selectedDates[1];

  const filteredData = logbookData.filter(item => {
    const itemDate = new Date(item.date);
    return itemDate >= startDate && itemDate <= endDate;
  });
  
  
  sortData(sortDropdown.value);
}

function renderLevelColumn(data, type, row) {
      const glucoseLevelValue = parseFloat(data);
      if (glucoseLevelValue > 7.8) {
        return `<a href="#" data-bs-toggle="modal" data-bs-target="#log_detail_modal" data-row-index="${row}"><span style="color: #EC1F28">${data}</span></a>`;
      } else if (glucoseLevelValue < 4.0) {
        return `<a href="#" data-bs-toggle="modal" data-bs-target="#log_detail_modal" data-row-index="${row}"><span style="color: #668DC4">${data}</span></a>`;
      } else {
        return `<a href="#" data-bs-toggle="modal" data-bs-target="#log_detail_modal" data-row-index="${row}"><span style="color: #67C56D">${data}</span></a>`;
      }
    }

    // Function to sort the data based on the selected option
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
    

    sortDropdown.addEventListener('change', function() {
      const selectedOption = this.value;
      sortData(selectedOption);
    });
    const initialSelectedOption = sortDropdown.value;
    sortData(initialSelectedOption);
    



function glucoseLevelColor(glucoseLevelValue) {
  if (glucoseLevelValue > 7.8) {
    return '#EC1F28'; // Red color for high glucose levels
  } else if (glucoseLevelValue < 4.0) {
    return '#668DC4'; // Blue color for low glucose levels
  } else {
    return '#67C56D'; // Green color for normal glucose levels
  }
}
function openModal(item) {
  // Get references to the modal elements
  const modalTitle = document.querySelector('#log_detail_modal .modal-title');
  const modalGlucoseLevel = document.querySelector('#log_detail_modal h1');
  const modalPeriodSelect = document.querySelector('#period_info2');
  const modalPeriodSelect2 = document.querySelector('#period_select');
  const modaltime = document.querySelector('#period_time');
  const modalTextarea = document.querySelector('#log_detail_modal textarea');
  const modalCarb = document.querySelector('#carb'); // Get the element for carbohydrate
  const modalRapid = document.querySelector('#rapid'); // Get the element for rapid acting
  const modalExercise = document.querySelector('#exercise'); // Get the element for exercise
  const modalImage = document.querySelector('#image'); // Get the element for image
  const modalImageTitle = document.querySelector('#image_title'); // Get the element for image title

  const originalDate = new Date(item.date);
  const formattedTime = originalDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });

  const originalDate2 = new Date(item.date);
  const formattedDate2 = originalDate2.getFullYear() + '-' + (originalDate2.getMonth() + 1) + '-' + originalDate2.getDate();

  modalTitle.textContent = formattedDate2;
  modaltime.textContent = formattedTime;
  modalGlucoseLevel.textContent = item.level;
  modalGlucoseLevel.style.color = glucoseLevelColor(parseFloat(item.level));
  modalPeriodSelect.textContent = item.period;
  modalPeriodSelect2.value = item.period;
  modalTextarea.value = '';

  // Set the carbohydrate, rapid acting, exercise, and image data
  modalCarb.textContent = item.carb + ' g';
  modalRapid.textContent = item.rapid + ' u';
  modalExercise.textContent = item.exercise + ' min';
  modalImage.setAttribute('src', item.image); // Set the image source
  modalImageTitle.textContent = item.image_title; // Set the image title

  // Pass the logId to the handleEditPeriod function
  const editPeriodButton = document.querySelector('#log_detail_modal a[onclick^="saveEditPeriod"]');
  const newOnclick = editPeriodButton.getAttribute('onclick').replace('{}', item.logbook_id);
  editPeriodButton.setAttribute('onclick', newOnclick);

  // Show the modal
  const logDetailModal = new bootstrap.Modal(document.getElementById('log_detail_modal'));
  logDetailModal.show();
}



   
    
 
    // Function to filter the data based on the selected date range
  // Function to filter the data based on the selected date range


 // Event listeners for the buttons to filter data based on selected date range
 

  // Initial filtering based on the default selected date range

  // Event listener for date range input
    // Initial sorting based on the default selected option
    

    dateRangeInput.addEventListener('change', function () {
    filterDataByDate(dateRangeInput._flatpickr.selectedDates);
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
    // Function to dynamically load a script
    function loadScript(url, callback) {
        var script = document.createElement('script');
        script.src = url;
        script.onload = callback;
        document.head.appendChild(script);
    }
   
  });

  
</script>                           

</body>
</html>
@endsection 