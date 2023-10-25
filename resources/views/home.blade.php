@extends('layouts.app') 
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />
     <script src="https://unpkg.com/vue@2"></script>

     
     <style>
    /* Add hover effect to change text color for the h6 element inside the button */
    button:hover h6 {
        color: grey; /* Your desired hover color here */
    }
</style>
</head>


<title>
 
        Dashboard
    
</title>
<body>
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
                    <div class="card overflow-hidden" style="padding-bottom:20px;">
                      <div class="card-body">
                        <div class="row align-items-start">
                          <div class="col-8">
                            <img src="../assets/images/dash-patient.png" alt="Patient Image" style="width: 25%;">
                          </div>
                          <div class="col-4 text-end">
                        <h5 class="card-title mb-9 fw-semibold " >Patients</h5>
                      <h2 class="fw-semibold mb-3">{{ $patientsCount }}</h4>
                          
                          </div>
                        
                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  
              <div class="col-lg-12">
                <!-- Monthly Earnings -->
                <div class="card">
                    <div class="card-body">
                      <div class="row align-items-start">
                        
                      
                      <div class="col-md-12 mb-4 text-center">
<button class="btn btn-primary m-2" id="bp-button2" data-table-id="bp-table2">BP</button>
<button class="btn btn-primary m-2" id="bg-button2" data-table-id="bg-table2">BG</button>


</div>

                      <div class="col-lg-12" id="bp-table2">
                      <div class="row align-items-start">
                      <div class="col-8">
                          <img src="../assets/images/dash-hyper.png" alt="Hyper Image" style="width: 25%;">
                        </div>
                        <div class="col-4 text-end">
                        <h5 class="card-title mb-9 fw-semibold"> Hyper Events</h5>
                      
                        <h2 class="fw-semibold mb-3">{{ $hyperbg }}</h4>
                     
                      </div>
                        
                      </div>
    <div class="table-responsive mb-3 " style="max-height: 300px; overflow-y: auto;">
        <table id="bp-table2" class="table  mb-0 align-middle logbook-table" >
            <tbody>
              
            @php
            $initialRowCount = 3; // Number of rows to show initially
            $rowCount = 0; // Initialize the row count
            @endphp
            @foreach($logbook as $index => $logbooks)
                @php
                $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
                $bp_level2 = $logbooks->bp_level2; // Assuming this is the variable holding bp_level2
                $bp_level = $logbooks->bp_level;
                @endphp
                @if ($patients && ($bp_level2 > 80 || $bp_level > 120))
                    @if(($bp_level2 > 60 && $bp_level > 90))
                        <tr class="col-8" >
                            <td>
                                @if (filter_var($patients->patient_image, FILTER_VALIDATE_URL))
                                    <div id="profile-picture" style="width: 42.4px; height: 44px;cursor: unset; background-image: url('{{ $patients->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                @else
                                    <img id="profile-picture" style="width: 42.4px; height: 44px;"class="rounded float-left img-fluid" src="{{ asset('storage/' . $patients->patient_image) }}" alt="Uploaded Image">
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <form action="{{ route('dashboard_general') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patients->patient_id }}" class="text-center">
                                    <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
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
                                <p class="mb-0 fw-normal">{{ $formattedDate }}</p>
                               
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">
                                    <span style="{{ ($bp_level > 120 ) ? 'color: #EC1F28;' : 'color: #67C56D;' }}">{{ $logbooks->bp_level }}</span>
                                    <span>/</span>
                                    <span style="{{ ($bp_level2 > 80) ? 'color: #EC1F28;' : 'color: #67C56D;' }}">{{ $logbooks->bp_level2 }}</span>
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
  <div class="col-lg-12 " id="bg-table2" style="display: none;">
  <div class="row align-items-start">
                      <div class="col-8">
                          <img src="../assets/images/dash-hyper.png" alt="Hyper Image" style="width: 25%;">
                        </div>
                        <div class="col-4 text-end">
                        <h5 class="card-title mb-9 fw-semibold"> Hyper Events</h5>
                      
                        <h2 class="fw-semibold mb-3">{{ $hyperbp }}</h4>
                     
                      </div>
                      </div>
  <div id="bgTable" class="table-responsive mb-3" style="max-height: 300px; overflow-y: auto;">
        <table id="bg-table2" class="table mb-0 align-middle logbook-table bg-table" tyle="display: none;">
        <tbody>
            @php
            $initialRowCount = 3; // Number of rows to show initially
            $rowCount = 0; // Initialize the row count
            @endphp
            @foreach($logbook as $index => $logbooks)
                @php
                $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
                
                $bg_level = $logbooks->bg_level;
                @endphp
                @if ($patients && ($bg_level > 7.8))
                    
                        <tr class="col-8" >
                            <td>
                                @if (filter_var($patients->patient_image, FILTER_VALIDATE_URL))
                                    <div id="profile-picture" style="width: 42.4px; height: 44px;cursor: unset; background-image: url('{{ $patients->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                @else
                                    <img id="profile-picture" style="width: 42.4px; height: 44px;"class="rounded float-left img-fluid" src="{{ asset('storage/' . $patients->patient_image) }}" alt="Uploaded Image">
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <form action="{{ route('dashboard_general') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patients->patient_id }}" class="text-center">
                                    <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
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
                                <p class="mb-0 fw-normal">{{ $formattedDate }}</p>
                               
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
                      <div class="col-8">
                        <img src="../assets/images/dash-practiceg.png" alt="Practicegroups Image" style="width: 25%;">
                      </div>
                      <div class="col-4 text-end">
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
        
<div class="col-md-12 text-center">
<button class="btn btn-primary m-2" id="bp-button" data-table-id="bp-table">BP</button>
<button class="btn btn-primary m-2" id="bg-button" data-table-id="bg-table">BG</button>


</div>

<div class="col-lg-12" id="bp-table" >
<div class="row align-items-start">
            <div class="col-8">
                <img src="../assets/images/dash-hypo.png" alt="Hypo Image" style="width: 25%;">
            </div>
      
                      <div class="col-4 text-end">
    <h5 class="card-title mb-3 fw-semibold">Hypo Events</h5>
 
    <h2 class="mb-3 fw-semibold">{{$hypobp}}</h2>
</div>
</div>
    <div id="bgTable" class="table-responsive mb-3"  style="max-height: 300px; overflow-y: auto;">
      
    <table id="bp-table" class="table mb-0 align-middle logbook-table2 bp-table" >
            <tbody>
            @php
            $initialRowCount = 3; // Number of rows to show initially
            $rowCount = 0; // Initialize the row count
            @endphp
            @foreach($logbook as $index => $logbooks)
                @php
                $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
                $bp_level2 = $logbooks->bp_level2; // Assuming this is the variable holding bp_level2
                $bp_level = $logbooks->bp_level;
                @endphp
                @if ($patients && ($bp_level2 < 60 || $bp_level < 90))
                    @if(($bp_level2 < 80 && $bp_level < 120))
                        <tr class="col-8">
                            <td>
                                @if (filter_var($patients->patient_image, FILTER_VALIDATE_URL))
                                    <div id="profile-picture" style="width: 42.4px; height: 44px;cursor: unset; background-image: url('{{ $patients->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                @else
                                    <img id="profile-picture" style="width: 42.4px; height: 44px;" class="rounded float-left img-fluid" src="{{ asset('storage/' . $patients->patient_image) }}" alt="Uploaded Image">
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <form action="{{ route('dashboard_general') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patients->patient_id }}" class="text-center">
                                    <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
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
    <p class="mb-0 fw-normal">{{ $formattedDate }}</p>

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
            <div class="col-8">
                <img src="../assets/images/dash-hypo.png" alt="Hypo Image" style="width: 25%;">
            </div>
      
                      <div class="col-4 text-end">
    <h5 class="card-title mb-3 fw-semibold">Hypo Events</h5>
 
    <h2 class="mb-3 fw-semibold">{{$hypobg}}</h2>
</div>
</div>
        <div id="bgTable" class="table-responsive mb-3" style="max-height: 300px; overflow-y: auto;">
        <table id="bg-table" class="table mb-0 align-middle logbook-table2 bg-table">
        <tbody>
            @php
            $initialRowCount = 3; // Number of rows to show initially
            $rowCount = 0; // Initialize the row count
            @endphp
            @foreach($logbook as $index => $logbooks)
                @php
                $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
               
                $bg_level = $logbooks->bg_level;
                @endphp
                @if ($patients && ($bg_level < 4.0))
                 
                        <tr class="col-8">
                            <td>
                                @if (filter_var($patients->patient_image, FILTER_VALIDATE_URL))
                                    <div id="profile-picture" style="width: 42.4px; height: 44px;cursor: unset; background-image: url('{{ $patients->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                @else
                                    <img id="profile-picture" style="width: 42.4px; height: 44px;" class="rounded float-left img-fluid" src="{{ asset('storage/' . $patients->patient_image) }}" alt="Uploaded Image">
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <form action="{{ route('dashboard_general') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patients->patient_id }}" class="text-center">
                                    <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
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
    <p class="mb-0 fw-normal">{{ $formattedDate }}</p>

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
</div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
  // Function to toggle between tables
  function toggleTable(tableId) {
    const bpTable = document.getElementById('bp-table');
    const bgTable = document.getElementById('bg-table');
    console.log(tableId);
    if (tableId === 'bp-table') {
      bpTable.style.display = 'block';
      bgTable.style.display = 'none';
    } else if (tableId === 'bg-table') {
      bpTable.style.display = 'none';
      bgTable.style.display = 'block';
    }

    console.log(`Table ${tableId} is now visible.`);
  }

  // Add click event listeners to the buttons
  const bpButton = document.getElementById('bp-button');
const bgButton = document.getElementById('bg-button');
console.log(bgButton);
  bpButton.addEventListener('click', () => {
    toggleTable('bp-table');
  });

  bgButton.addEventListener('click', () => {
    toggleTable('bg-table');
  });

  // Show the BP table by default on page load
  toggleTable('bp-table');
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
  // Function to toggle between tables
  function toggleTable(tableId) {
    const bpTable = document.getElementById('bp-table2');
    const bgTable = document.getElementById('bg-table2');
    console.log(tableId);
    if (tableId === 'bp-table2') {
      bpTable.style.display = 'table';
      bgTable.style.display = 'none';
    } else if (tableId === 'bg-table2') {
      bpTable.style.display = 'none';
      bgTable.style.display = 'table';
    }

    console.log(`Table ${tableId} is now visible.`);
  }

  // Add click event listeners to the buttons
  const bpButton = document.getElementById('bp-button2');
const bgButton = document.getElementById('bg-button2');
console.log(bgButton);
  bpButton.addEventListener('click', () => {
    toggleTable('bp-table2');
  });

  bgButton.addEventListener('click', () => {
    toggleTable('bg-table2');
  });

  // Show the BP table by default on page load
  toggleTable('bp-table2');
});
</script>




                  
              </div>
            </div>
          </div>
        </div>
  
  

</body>

</html>
 @endsection 