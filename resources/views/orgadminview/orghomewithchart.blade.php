@extends('layouts.orgapp') 
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />
     <script src="https://unpkg.com/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     
     <style>
    /* Add hover effect to change text color for the h6 element inside the button */
    button:hover h6 {
        color: grey; /* Your desired hover color here */
    }
    .read-row {
    background-color:grey; /* Set the desired background color */
    
}
</style>
</head>


<title>
 
        Dashboard
    
</title>
<body onload="filterEntriesByDates('table1'); filterEntriesByDates2('table2'); filterEntriesByDates3('table3'); filterEntriesByDates4('table4');">
  <!--  Body Wrapper -->

    <!-- Sidebar Start -->
   
    <!--  Sidebar End -->
    <!--  Main wrapper -->
   
      <!--  Header Start -->
     
      <!--  Header End -->
       <!--  Header End -->
       <div class="container-fluid">

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
                  <h5 class="card-title fw-semibold mb-4">Dashboard</h5>
                  <p> Welcome to BioTectiveDRC Dashboard!</p>
                </div>

                

        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-12">
                    <!-- Yearly Breakup -->
                    <div class="card overflow-hidden">
                      <div class="card-body">
                        <div class="row align-items-start">
                          <div class="col-6">
                            <img src="../assets/images/dash-patient.png" alt="Patient Image" style="width: 25%;">
                          </div>
                          <div class="col-6 text-end">
                        <h5 class="card-title mb-9 fw-semibold " >Patients</h5>
                      <h2 class="fw-semibold mb-3">{{ $patientsCount }}</h4>
                          
                          </div>
                        
                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  
              <div class="col-lg-12" >
                <!-- Monthly Earnings -->
                <div class="card">
                    <div class="card-body">
                      <div class="row align-items-start"  >
                        
                      
                    

                      <div class="col-lg-12" id="bp-table2">
                      <div class="row align-items-start">
                      <div class="col-6">
                          <img src="../assets/images/dash-hyper.png" alt="Hyper Image" style="width: 25%;">
                          <div class="mt-4">
    <p id="table1-period_info"><span id="table1-period_text" class="pe-2">Since 3 days</span><a href="javascript:void(0);" onclick="handleEditPeriod('table1')"><i class="ti ti-pencil"></i></a></p>
    <p id="table1-period_edit" style="display: none;">
        <select id="table1-period_select" onchange="filterEntriesByDates('table1')">
            <option value="Today" data-days="1">Today</option>
            <option value="Yesterday" data-days="2">Yesterday</option>
            <option value="Since 3 days" data-days="3" selected="selected">Since 3 days</option>
            <option value="Since 7 days" data-days="7" >Since 7 days</option>
            <option value="Since 14 days" data-days="14">Since 14 days</option>
            <option value="Since 30 days" data-days="30">Since 30 days</option>
        </select>
        <a href="javascript:void(0);" onclick="saveEditPeriod('table1')"><i class="ti ti-check"></i></a>
    </p>
</div>

                    
                          
                        
                        </div>
                       
                        <div class="col-6 text-end">
                        <h5 class="card-title mb-3 fw-semibold"> Hyper Events</h5>
                      
                        <h2 class="mb-3 fw-semibold" id="filtered-count1"></h4>
                     
                      </div>
                        
                      </div>
    <div class="table-responsive mb-3" style="max-height: 300px; overflow-y: auto;">
        <table id="bp-table2" class="table  mb-0 align-middle logbook-table" >
            <tbody>
              
            @php
            $initialRowCount = 3; // Number of rows to show initially
            $rowCount = 0; // Initialize the row count
            @endphp
            @foreach($logbook->sortByDesc('bp_logbook_date') as $index => $logbooks)
                @php
                $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
                $bp_level2 = $logbooks->bp_level2; // Assuming this is the variable holding bp_level2
                $bp_level = $logbooks->bp_level;
                @endphp
                @if ($patients && ($bp_level2 > 80 || $bp_level > 120))
                    @if(($bp_level2 > 60 && $bp_level > 90))
                        <tr class="col-8" id="row{{$logbooks->logbook_id}}" data-id="{{ $logbooks->logbook_id }}"onclick="markLogbookAsRead({{ $logbooks->logbook_id }}, 'bp_read', this)" >
                            <td>
                                @if (filter_var($patients->patient_image, FILTER_VALIDATE_URL))
                                    <div id="profile-picture" style="width: 42.4px; height: 44px;cursor: unset; background-image: url('{{ $patients->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                @else
                                    <img id="profile-picture" style="width: 42.4px; height: 44px;"class="rounded float-left img-fluid" src="{{ asset('storage/' . $patients->patient_image) }}" alt="Uploaded Image">
                                @endif
                            </td>
                            <td class="border-bottom-0">
                            <form action="{{ route('dashboard_generalorg') }}" method="POST" style='display:inline-block;'>
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patients->patient_id }}" class="text-center">
                                      <input type="hidden" name="professional_id" value="{{ $professionalId }}">
                        <input type="hidden" name="organization_id" value="{{ $organizationid }}">
                                    <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb),var(--bs-link-opacity,1)); transition: color 0.2s;">
                                        <h6 class="fw-semibold mb-0" style="cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">{{ $patients->patient_name }}</h6>
                                    </button>
                                </form>
                            </td>
                            <td class="border-bottom-0">
                                @php
                                $dateTimeParts = explode(' ', $logbooks->bp_logbook_date);
                                $date = $dateTimeParts[0]; // Get the date part
                                $dateParts = explode('-', $date); // Split the date by "-"
                                // Format the date using "/"
                                $formattedDate = implode('/', $dateParts);
      
                                @endphp
                                <p class="mb-0 fw-normal table1-bp-logbook-date">{{ $formattedDate }}</p>
                               
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">
                                    <span style="{{ ($bp_level > 120 ) ? 'color: #EC1F28;' : 'color: #67C56D;' }}">{{ $logbooks->bp_level }}</span>
                                    <span>/</span>
                                    <span style="{{ ($bp_level2 > 80) ? 'color: #EC1F28;' : 'color: #67C56D;' }}">{{ $logbooks->bp_level2 }}</span>
                                </h6>
                            </td>
                        </tr>
                       
                    @endif
                @endif
            @endforeach
            @php
                        $rowCount++;
                        @endphp
            </tbody>
        </table>
        
  </div>
  </div>
  <div class="col-lg-12 " id="bg-table2" style="display: none;">
  <div class="row align-items-start">
                      <div class="col-6">
                          <img src="../assets/images/dash-hyper.png" alt="Hyper Image" style="width: 25%;">
                         <div class="mt-4">
    <p id="table2-period_info"><span id="table2-period_text" class="pe-2">Since 3 days</span><a href="javascript:void(0);" onclick="handleEditPeriod2('table2')"><i class="ti ti-pencil"></i></a></p>
    <p id="table2-period_edit" style="display: none;">
        <select id="table2-period_select" onchange="filterEntriesByDates2('table2')">
            <option value="Today" data-days="1">Today</option>
            <option value="Yesterday" data-days="2">Yesterday</option>
            <option value="Since 3 days" data-days="3" selected='selected'>Since 3 days</option>
            <option value="Since 7 days" data-days="7" >Since 7 days</option>
            <option value="Since 14 days" data-days="14">Since 14 days</option>
            <option value="Since 30 days" data-days="30">Since 30 days</option>
        </select>
        <a href="javascript:void(0);" onclick="saveEditPeriod2('table2')"><i class="ti ti-check"></i></a>
    </p>
</div>


                        
                        </div>
                       
                        <div class="col-6 text-end">
                        <h5 class="card-title mb-3 fw-semibold"> Hyper Events</h5>
                      
                        <h2 class="mb-3 fw-semibold" id="filtered-count2"></h2>
                     
                      </div>
                      </div>
  <div id="bgTable" class="table-responsive mb-3" style="max-height: 300px; overflow-y: auto;">
        <table id="bg-table2" class="table mb-0 align-middle logbook-table bg-table" tyle="display: none;">
        <tbody>
            @php
            $initialRowCount = 3; // Number of rows to show initially
            $rowCount = 0; // Initialize the row count
            @endphp
            @foreach($logbook->sortByDesc('bg_logbook_date') as $index => $logbooks)
                @php
                $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
                
                $bg_level = $logbooks->bg_level;
                @endphp
                @if ($patients && ($bg_level > 7.8))
                    
                        <tr class="col-8"  id="row{{$logbooks->logbook_id}}" data-id="{{ $logbooks->logbook_id }}"  onclick="markLogbookAsRead({{ $logbooks->logbook_id }}, 'bg_read', this)">
                            <td>
                                @if (filter_var($patients->patient_image, FILTER_VALIDATE_URL))
                                    <div id="profile-picture" style="width: 42.4px; height: 44px;cursor: unset; background-image: url('{{ $patients->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                @else
                                    <img id="profile-picture" style="width: 42.4px; height: 44px;"class="rounded float-left img-fluid" src="{{ asset('storage/' . $patients->patient_image) }}" alt="Uploaded Image">
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                  <form action="{{ route('dashboard_generalorg') }}" method="POST" style='display:inline-block;'>
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patients->patient_id }}" class="text-center">
                                      <input type="hidden" name="professional_id" value="{{ $professionalId }}">
                        <input type="hidden" name="organization_id" value="{{ $organizationid }}">
                                    <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb),var(--bs-link-opacity,1)); transition: color 0.2s;">
                                        <h6 class="fw-semibold mb-0" style="cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">{{ $patients->patient_name }}</h6>
                                    </button>
                                </form>
                            </td>
                            <td class="border-bottom-0">
                                @php
                                $dateTimeParts = explode(' ', $logbooks->bg_logbook_date);
                                $date = $dateTimeParts[0]; // Get the date part
                                $dateParts = explode('-', $date); // Split the date by "-"
                                // Format the date using "/"
                                $formattedDate = implode('/', $dateParts);
                          
                                @endphp
                                <p class="mb-0 fw-normal table2-bp-logbook-date">{{ $formattedDate }}</p>
                               
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">
                                    <span style="{{ ($bg_level > 7.8 ) ? 'color: #EC1F28;' : 'color: #67C56D;' }}">{{ $logbooks->bg_level }}</span>
                                    
                                </h6>
                            </td>
                        </tr>
                        @php
                        $rowCount++;
                        @endphp
                   
                @endif
            @endforeach
            </tbody>
    </table>
</div>

</div>          
                        
                      
                    </div>
                  </div>
                  <div class="col-md-12 mb-4 text-center">
                        <button class="btn btn-secondary m-2 mb-4 active" id="bg-button2" data-table-id="bg-table2">BG</button>
<button class="btn btn-light m-2 mb-4" id="bp-button2" data-table-id="bp-table2">BP</button>



</div>
              </div>
              
            </div>
            
          </div>
              
        
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <div class="card-body">
                    <div class="row align-items-start">
                      <div class="col-6">
                        <img src="../assets/images/dash-practiceg.png" alt="Practicegroups Image" style="width: 25%;">
                      </div>
                      <div class="col-6 text-end">
                    <h5 class="card-title mb-9 fw-semibold " >Practice Group</h5>
                  <h2 class="fw-semibold mb-3">{{ $practicegroupCount }}</h4>
                      
                      </div>
                    
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                

                <!-- Hypo -->
                <div class="card">
    <div class="card-body">
        


<div class="col-lg-12" id="bp-table" >
<div class="row align-items-start">
            <div class="col-6">
                <img src="../assets/images/dash-hypo.png" alt="Hypo Image" style="width: 25%;">
               <div class="mt-4">
    <p id="table3-period_info"><span id="table3-period_text" class="pe-2">Since 3 days</span><a href="javascript:void(0);" onclick="handleEditPeriod3('table3')"><i class="ti ti-pencil"></i></a></p>
    <p id="table3-period_edit" style="display: none;">
        <select id="table3-period_select" onchange="filterEntriesByDates3('table3')">
            <option value="Today" data-days="1">Today</option>
            <option value="Yesterday" data-days="2">Yesterday</option>
            <option value="Since 3 days" data-days="3" selected="selected">Since 3 days</option>
            <option value="Since 7 days" data-days="7">Since 7 days</option>
            <option value="Since 14 days" data-days="14">Since 14 days</option>
            <option value="Since 30 days" data-days="30">Since 30 days</option>
        </select>
        <a href="javascript:void(0);" onclick="saveEditPeriod3('table3')"><i class="ti ti-check"></i></a>
    </p>
</div>


              </div>
            
      
                      <div class="col-6 text-end">
    <h5 class="card-title mb-3 fw-semibold">Hypo Events</h5>
 
    <h2 class="mb-3 fw-semibold"  id="filtered-count3"></h2>
</div>
</div>
    <div id="bgTable" class="table-responsive mb-3"  style="max-height: 300px; overflow-y: auto;">
      
    <table id="bp-table" class="table mb-0 align-middle logbook-table2 bp-table" >
            <tbody>
            @php
            $initialRowCount = 3; // Number of rows to show initially
            $rowCount = 0; // Initialize the row count
            @endphp
            @foreach($logbook->sortByDesc('bp_logbook_date') as $index => $logbooks)
                @php
                $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
                $bp_level2 = $logbooks->bp_level2; // Assuming this is the variable holding bp_level2
                $bp_level = $logbooks->bp_level;
                @endphp
                @if ($patients && ($bp_level2 < 60 || $bp_level < 90))
                    @if(($bp_level2 < 80 && $bp_level < 120))
                        <tr class="col-8" id="row{{$logbooks->logbook_id}}" data-id="{{ $logbooks->logbook_id }}" onclick="markLogbookAsRead({{ $logbooks->logbook_id }}, 'bp_read', this)">
                            <td>
                                @if (filter_var($patients->patient_image, FILTER_VALIDATE_URL))
                                    <div id="profile-picture" style="width: 42.4px; height: 44px;cursor: unset; background-image: url('{{ $patients->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                @else
                                    <img id="profile-picture" style="width: 42.4px; height: 44px;" class="rounded float-left img-fluid" src="{{ asset('storage/' . $patients->patient_image) }}" alt="Uploaded Image">
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                  <form action="{{ route('dashboard_generalorg') }}" method="POST" style='display:inline-block;'>
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patients->patient_id }}" class="text-center">
                                      <input type="hidden" name="professional_id" value="{{ $professionalId }}">
                        <input type="hidden" name="organization_id" value="{{ $organizationid }}">
                                    <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb),var(--bs-link-opacity,1)); transition: color 0.2s;">
                                        <h6 class="fw-semibold mb-0" style="cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">{{ $patients->patient_name }}</h6>
                                    </button>
                                </form>
                            </td>
                            <td class="border-bottom-0">
    @php
    $dateTimeParts = explode(' ', $logbooks->bp_logbook_date);
    $date = $dateTimeParts[0]; // Get the date part
    $dateParts = explode('-', $date); // Split the date by "-"
    // Format the date using "/"
    $formattedDate = implode('/', $dateParts);
   
    @endphp
    <p class="mb-0 fw-normal table3-bp-logbook-date">{{ $formattedDate }}</p>

</td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">
                                    <span style="{{ ($bp_level <= 90 ) ? 'color: #668DC4;' : 'color: #67C56D;' }}">{{ $logbooks->bp_level }}</span>
                                    <span>/</span>
                                    <span style="{{ ($bp_level2 <= 60) ? 'color: #668DC4;' : 'color: #67C56D;' }}">{{ $logbooks->bp_level2 }}</span>
                                </h6>
                            </td>
                        </tr>
                        @php
                        $rowCount++;
                        @endphp
                    @endif
                @endif
            @endforeach
            </tbody>
        </table>
        </div>
        </div>
  <div class="col-lg-12" id="bg-table" style="display: none;">
  <div class="row align-items-start">
            <div class="col-6">
                <img src="../assets/images/dash-hypo.png" alt="Hypo Image" style="width: 25%;">
               <div class="mt-4">
    <p id="table4-period_info"><span id="table4-period_text" class="pe-2">Since 3 days</span><a href="javascript:void(0);" onclick="handleEditPeriod4('table4')"><i class="ti ti-pencil"></i></a></p>
    <p id="table4-period_edit" style="display: none;">
        <select id="table4-period_select" onchange="filterEntriesByDates4('table4')">
            <option value="Today" data-days="1">Today</option>
            <option value="Yesterday" data-days="2">Yesterday</option>
            <option value="Since 3 days" data-days="3" selected="selected">Since 3 days</option>
            <option value="Since 7 days" data-days="7">Since 7 days</option>
            <option value="Since 14 days" data-days="14">Since 14 days</option>
            <option value="Since 30 days" data-days="30">Since 30 days</option>
        </select>
        <a href="javascript:void(0);" onclick="saveEditPeriod4('table4')"><i class="ti ti-check"></i></a>
    </p>
</div>

              </div>
           
      
                      <div class="col-6 text-end">
    <h5 class="card-title mb-3 fw-semibold">Hypo Events</h5>
 
    <h2 class="mb-3 fw-semibold"  id="filtered-count4"></h2>
</div>
</div>
        <div id="bgTable" class="table-responsive mb-3" style="max-height: 300px; overflow-y: auto; ">
        <table id="bg-table" class="table mb-0 align-middle logbook-table2 bg-table">
        <tbody>
            @php
            $initialRowCount = 3; // Number of rows to show initially
            $rowCount = 0; // Initialize the row count
            @endphp
            @foreach($logbook->sortByDesc('bg_logbook_date') as $index => $logbooks)
                @php
                $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
               
                $bg_level = $logbooks->bg_level;
                @endphp
                @if ($patients && ($bg_level < 4.0))
       
                        <tr class="col-8" id="row{{$logbooks->logbook_id}}" data-id="{{ $logbooks->logbook_id }}" onclick="markLogbookAsRead({{ $logbooks->logbook_id }}, 'bg_read', this)">
                            <td>
                                @if (filter_var($patients->patient_image, FILTER_VALIDATE_URL))
                                    <div id="profile-picture" style="width: 42.4px; height: 44px;cursor: unset; background-image: url('{{ $patients->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                @else
                                    <img id="profile-picture" style="width: 42.4px; height: 44px;" class="rounded float-left img-fluid" src="{{ asset('storage/' . $patients->patient_image) }}" alt="Uploaded Image">
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                  <form action="{{ route('dashboard_generalorg') }}" method="POST" style='display:inline-block;'>
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patients->patient_id }}" class="text-center">
                                      <input type="hidden" name="professional_id" value="{{ $professionalId }}">
                        <input type="hidden" name="organization_id" value="{{ $organizationid }}">
                                    <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb),var(--bs-link-opacity,1)); transition: color 0.2s;">
                                        <h6 class="fw-semibold mb-0" style="cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">{{ $patients->patient_name }}</h6>
                                    </button>
                                </form>
                            </td>
                            <td class="border-bottom-0">
    @php
    $dateTimeParts = explode(' ', $logbooks->bg_logbook_date);
    $date = $dateTimeParts[0]; // Get the date part
    $dateParts = explode('-', $date); // Split the date by "-"
    // Format the date using "/"
    $formattedDate = implode('/', $dateParts);
   
    @endphp
    <p class="mb-0 fw-normal table4-bp-logbook-date">{{ $formattedDate }}</p>

</td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">
                                    <span style="{{ ($bg_level < 4.0 ) ? 'color: #668DC4;' : 'color: #67C56D;' }}">{{ $logbooks->bg_level }}</span>
                                  
                                </h6>
                            </td>
                        </tr>
                        @php
                        $rowCount++;
                        @endphp
                    
                @endif
            @endforeach
            </tbody>
    </table>
</div>
</div>
    </div>
    <div class="col-md-12 text-center mb-4">
    <button class="btn btn-secondary m-2 mb-4 active" id="bg-button" data-table-id="bg-table">BG</button>
<button  class="btn btn-light m-2 mb-4" id="bp-button" data-table-id="bp-table">BP</button>



</div>

</div>

</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
  // Function to toggle between tables
  function toggleTable(tableId) {
    const bpTable = document.getElementById('bp-table');
    const bgTable = document.getElementById('bg-table');
  
    if (tableId === 'bp-table') {
      bpTable.style.display = 'block';
      bgTable.style.display = 'none';
      document.getElementById('bp-button').classList.add('btn','btn-secondary', 'm-2', 'mb-4', 'active');
      document.getElementById('bg-button').classList.remove('btn','btn-secondary', 'm-2', 'mb-4', 'active');
      document.getElementById('bg-button').classList.add('btn','btn-light', 'm-2', 'mb-4');
      document.getElementById('bp-button').style.color = '#fff';
  document.getElementById('bp-button').style.backgroundColor = '#69abac';
  document.getElementById('bp-button').style.borderColor = '#69abac';
  document.getElementById('bg-button').style.color = '#000';
  document.getElementById('bg-button').style.backgroundColor = '#f6f9fc';
  document.getElementById('bg-button').style.borderColor = '#f6f9fc';


  

    } else if (tableId === 'bg-table') {
      bpTable.style.display = 'none';
      bgTable.style.display = 'block';
      document.getElementById('bg-button').classList.add('btn','btn-secondary', 'm-2', 'mb-4', 'active');
    document.getElementById('bp-button').classList.remove('btn','btn-secondary', 'm-2', 'mb-4', 'active');
    document.getElementById('bp-button').classList.add('btn','btn-light', 'm-2', 'mb-4');
    document.getElementById('bg-button').style.color = '#fff';
  document.getElementById('bg-button').style.backgroundColor = '#69abac';
  document.getElementById('bg-button').style.borderColor = '#69abac';
  document.getElementById('bp-button').style.color = '#000';
  document.getElementById('bp-button').style.backgroundColor = '#f6f9fc';
  document.getElementById('bp-button').style.borderColor = '#f6f9fc';

    }

    
  }

  // Add click event listeners to the buttons
  const bpButton = document.getElementById('bp-button');
const bgButton = document.getElementById('bg-button');

  bpButton.addEventListener('click', () => {
    toggleTable('bp-table');
  });

  bgButton.addEventListener('click', () => {
    toggleTable('bg-table');
  });

  // Show the BP table by default on page load
  toggleTable('bg-table');
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
  // Function to toggle between tables
  function toggleTable(tableId) {
    const bpTable = document.getElementById('bp-table2');
    const bgTable = document.getElementById('bg-table2');
   
    if (tableId === 'bp-table2') {
      bpTable.style.display = 'table';
      bgTable.style.display = 'none';
      document.getElementById('bp-button2').classList.add('btn','btn-secondary', 'm-2', 'mb-4', 'active');
      document.getElementById('bg-button2').classList.remove('btn','btn-secondary', 'm-2', 'mb-4', 'active');
      document.getElementById('bg-button2').classList.add('btn','btn-light', 'm-2', 'mb-4');
      document.getElementById('bp-button2').style.color = '#fff';
  document.getElementById('bp-button2').style.backgroundColor = '#69abac';
  document.getElementById('bp-button2').style.borderColor = '#69abac';
  document.getElementById('bg-button2').style.color = '#000';
  document.getElementById('bg-button2').style.backgroundColor = '#f6f9fc';
  document.getElementById('bg-button2').style.borderColor = '#f6f9fc';


    } else if (tableId === 'bg-table2') {
      bpTable.style.display = 'none';
      bgTable.style.display = 'table';
      document.getElementById('bg-button2').classList.add('btn','btn-secondary', 'm-2', 'mb-4', 'active');
    document.getElementById('bp-button2').classList.remove('btn','btn-secondary', 'm-2', 'mb-4', 'active');
    document.getElementById('bp-button2').classList.add('btn','btn-light', 'm-2', 'mb-4');
    document.getElementById('bg-button2').style.color = '#fff';
  document.getElementById('bg-button2').style.backgroundColor = '#69abac';
  document.getElementById('bg-button2').style.borderColor = '#69abac';
  document.getElementById('bp-button2').style.color = '#000';
  document.getElementById('bp-button2').style.backgroundColor = '#f6f9fc';
  document.getElementById('bp-button2').style.borderColor = '#f6f9fc';

    }

    
  }

  // Add click event listeners to the buttons
  const bpButton = document.getElementById('bp-button2');
const bgButton = document.getElementById('bg-button2');

  bpButton.addEventListener('click', () => {
    toggleTable('bp-table2');
  });

  bgButton.addEventListener('click', () => {
    toggleTable('bg-table2');
  });

  // Show the BP table by default on page load
  toggleTable('bg-table2');
});
</script>
<script src="../assets/js/home.js"></script>
<script>
function markLogbookAsRead(logbookId, type, row) {
    console.log('Logbook ID:', logbookId);
    console.log('Type:', type);

    // Make an AJAX request to the server
    $.ajax({
        type: 'POST',
        url: '/mark-as-read', // Replace with the actual route
        data: {
          _token: '{{ csrf_token() }}', // Include the CSRF token in your data
            logbookId: logbookId,
            type: type, // 'bp_read' or 'bg_read'
        },
        success: function(response) {
          if (response.success) {
                    // Update the UI to indicate that the row has been marked as read
                    var row = document.getElementById('row' + logbookId);
                    console.log(row);
                    if (row) {
                      row.style.backgroundColor = 'gray'; // Replace with your desired background color
                    }
                }
        },
        error: function(error) {
            console.error('Error marking logbook as read', error);
        }
    });
}

</script>




                  
              </div>
              <div class="container-fluid">

<h5 class="fw-semibold mb-4">Events</h5>
<div class="row justify-content-end">
<div class="col-md-6 text-end">
    <div class="d-flex justify-content-end">
        <input type="text" style="width: 50%;" class="form-select" id="date_start" name="date_start" value="">
    </div>
</div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <canvas id="chartCanvas" height='300'></canvas>
            </div>
        </div>
    </div>
</div>
<div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <canvas id="chartCanvas2" height='300'></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
          </div>
        </div>
  
        <script defer>
document.addEventListener('DOMContentLoaded', function() {
    var canvas = document.getElementById('chartCanvas').getContext('2d');
    var canvas2 = document.getElementById('chartCanvas2').getContext('2d');
   
    var bg_period = @json($bg_period);
    var bgLevels = @json($bgLevels);
    var bgLogbookDate = @json($bgLogbookDate);

    // var maxAxisValue = criteria2 > 10 ? 20 : 15;
    var bpLevels = @json($bpLevels);
    var bpLevels2 = @json($bpLevels2);
    var bpLogbookDate = @json($bpLogbookDate);

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

    if (bg_period) {
        // Sort bg_period based on the custom order
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
        });
    }

    var data = {
        labels: uniqueBgPeriods, // Use unique bg_period values as labels
        datasets: [
            {
                label: 'Number of Records',
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

    var dateStartInput = document.getElementById('date_start');

    if (bgLogbookDate) {
        var startDate = new Date(bgLogbookDate[1]).toISOString().split('T')[0];
        var endDate = new Date(bgLogbookDate[bgLogbookDate.length - 1]).toISOString().split('T')[0];
        bgLogbookDate.sort(function(a, b) {
            return new Date(a) - new Date(b);
        });
        dateStartInput.value = startDate + ' - ' + endDate;
    }

    // No need for eventSelect and selectedOption
    // var eventSelect = document.getElementById('event_type');
    // var selectedOption = eventSelect.value;

    // if (selectedOption === 'blood_pressure') {
    // Blood Pressure Chart Data and Options
    // if (chart) {
    //     chart.destroy(); // Destroy the previous chart instance
    // }

    // Create an array to hold the categories and initialize counters for each category
    var categories = ["Elevated", "Stage 1", "Stage 2", "Hypertensive Crisis", "Hypotension Crisis"];
    var categoryCounts = [0, 0, 0, 0];

    if (bpLevels) {
        for (var i = 0; i < bpLevels.length; i++) {
            var bp2 = bpLevels[i];
            var bp1 = bpLevels2[i];

            if (bp1 < 80 && bp2 >= 120 && bp2 < 130) {
                categoryCounts[0]++; // Elevated
            } else if ((bp1 >= 80 && bp1 < 90) || (bp2 >= 130 && bp2 < 140)) {
                categoryCounts[1]++; // Stage 1
            } else if ((bp1 >= 90 && bp1 <= 119) || (bp2 >= 140 && bp2 <= 179)) {
                categoryCounts[2]++; // Stage 2
            } else if (bp1 < 60 || bp2 < 90) {
                // Either one or both values are outside the specified range
                categoryCounts[4]++; // Abnormal
            } else {
                categoryCounts[3]++; // Hypertensive Crisis
            }
        }
    }

    // Update your chart data to use the categories array as labels for the x-axis and categoryCounts for the y-axis
    var data = {
        labels: categories, // Use categories as x-axis labels
        datasets: [
            {
                label: 'Number of Records',
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
                    labelString: 'Number of Logbook Records' // Update the y-axis label
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

    // Create the chart on canvas2
    chart = new Chart(canvas2, {
        type: 'bar',
        data: data,
        options: options
    });

    bpLogbookDate.sort(function(a, b) {
        return a.localeCompare(b);
    });

    dateStartInput.value = bpLogbookDate[0] + ' - ' + bpLogbookDate[bpLogbookDate.length - 1];
});
</script>


</body>

</html>
 @endsection 