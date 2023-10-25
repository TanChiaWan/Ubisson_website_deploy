
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
        <link rel="stylesheet" href="../../css/stylekong.css">

        <!--Bootstrap-->
        <link href="../../bootstrap/bootstrap.min.css" rel="stylesheet" />
        

        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>
        

    </head>
    <style>
            .dropdown {
              position: relative;
              display: inline-block;
            }
          
            .dropdown-toggle {
              background: none;
              border: none;
              cursor: pointer;
            }
          
            .dropdown-menu {
              position: absolute;
              z-index: 1;
              display: none;
            }
          
            .dropdown-menu a {
              display: flex;
              align-items: center;
            }
          </style>
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
                        <div class="topnav2">
                        <a href="{{ route('dashboard_generalorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}" >DashBoard</a>
                              <a href="{{ route('patient', ['patientId' => $patient->patient_id,'organization_id' => $organizationid]) }}" >About Patient</a>
                              <a href="{{ route('logbook_bgorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}" class="active">Logbook</a>
                        <a href="{{ route('healthdataorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}">Health Data</a>
                        </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tabnav">
                                        <a href="{{ route('logbook_bgorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}" class="active">BG</a>
                                        <a href="{{ route('logbook_bporg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}"  >BP</a>
                                    </div>

                                    <div class="tab_nav">
                                    <label for="date-range">Select Date Range:</label>
        <input type="text" id="date-range" name="date-range" class='tabnav2'>

        <label for="sort-dropdown">Sort By:</label>
<select id="sort-dropdown"  class='tabnav3'>
  <option value="newest">Newest</option>
  <option value="oldest">Oldest</option>
</select>



<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
      const tdPeriod = document.createElement('td');

      tdDate.textContent = item.date;
      tdLevel.textContent = item.level;
      tdLevel.classList.add('txt_num');
      tdPeriod.textContent = item.period;

      tr.appendChild(tdDate);
      tr.appendChild(tdLevel);
      tr.appendChild(tdPeriod);

      dataList.appendChild(tr);
    }
  });
}


    const logbookData = [
      @foreach ($logbook as $logbooks)
        @if ($logbooks->patient_id_FK === $patient->patient_id)
          {
            date: '{{ $logbooks->bg_logbook_date }}',
            level: '{{ $logbooks->bg_level }}',
            period: '{{ $logbooks->bg_period }}'
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

    // Initial sorting based on the default selected option
    const initialSelectedOption = sortDropdown.value;
    sortData(initialSelectedOption);
  });
</script>



                                    </div>
                                    
                                </div>
                            </div>
                            
                            <!--Logbook Pressure Table-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="logbook_pressure_table">
                                        <table>
                                            <span></span>
                                            <thead class='tablehead'>

                                                <tr>
                                                    <th class="txtline">Date</th>
                                                    <th class="txtline">Blood Glucose Level</th>
                                                    <th class="txtline">Period</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody class='tablebody' id="data-list">
                                                <!--@foreach ($logbook as $logbooks)
@if ($logbooks->patient_id_FK === $patient->patient_id)
    <tr>
        <td >{{ $logbooks->bg_logbook_date }}</td>
        <td class="txt_num">{{ $logbooks->bg_level }}</td>
        <td>{{ $logbooks->bg_period }}</td>
   
    </tr>
@endif
@endforeach-->
                                            </tbody>
                                        </table>
                                          
                                    </div>
                                    
                                </div>
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