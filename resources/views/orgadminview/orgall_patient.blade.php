@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Patients</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/js/app.js')
        <!--CSS-->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="../assets/css/datatables2.css" rel="stylesheet">
    </head>

    <body>
    <body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title fw-semibold mb-2">Patients</h5>  
                    </div>
                    
                    <!--Tab-->
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href="{{route('orgall_patients', ['organization_id' => $organizationid]) }}" class="btn btn-primary m-3 ">Patient With Organization</a>
                            <a href="{{route('orgall_patient2', ['organization_id' => $organizationid]) }}" class="btn btn-light m-3">Patient Without Organization</a>
                        </div>
                    </div>
                </div>
            
                        

                <div class="table-responsive table" style="overflow-y: hidden;">
                    <table class="table text-nowrap mb-0 align-middle datatable">
                      <thead class="text-dark fs-4">
                        <tr style="background-color: #7ecbcc;">
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Name</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Organization</h6>
                          </th>
                         
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Age</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Diabetes Type</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Status</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Last Record</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($patients as $patients)
                        @if($patients->organization_name != null)
                        <tr >
                          <td class="border-bottom-0"><p class="mb-0 fw-normal">{{ $patients->patient_name }}</p></td>
                        
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $patients->organization_name }}</p>                    
                          </td>
                    
                         
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $patients->patient_age }}</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $patients->diabetes_type }}</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal"><img src='../css/images/active.png' alt='active'></p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $patients->date_of_diagnosis }}</p>
                          </td>
                          <td class="border-bottom-0">
                          
                          <a href="{{ route('dashboard_generalorg') }}" id="dashboard-link" data-route="{{ route('dashboard_generalorg') }}" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));">
    <i class="ti ti-eye"></i>
</a>


                          </td>
                        </tr> 
                        @endif
                        @endforeach
                                                       
                      </tbody>
                    </table>
                  </div>
    
   
                
                <!-- table -->
                
        </div>
      </div>
      <script>
    // Define the constant for DataTables library URL
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

<script>
$(document).ready(function() {
    $('#dashboard-link').click(function(e) {
        e.preventDefault(); // Prevent the default link behavior
        
        var url = $(this).data('route'); // Get the route URL

        // Log the values before sending the AJAX request
        console.log('patientId:', {{ $patients->patient_id }});
        console.log('organizationid:', {{ $organizationid }});
        console.log('professional_id:', {{ $user->professional_id }});

        $.ajax({
            url: url,
            type: 'GET', // Or 'POST' if it's a POST request
            data: {
                patientId: {{ $patients->patient_id }},
                organizationid: {{ $organizationid }},
                professional_id: {{ $user->professional_id }}
            },
            success: function(data) {
                $('#dashboard-content').html(data); // Update the content
            },
            error: function(xhr, status, error) {
                // Log the error details
                console.log('AJAX Error:', status, error);

                // Show an alert with an error message
                alert('Error loading content: ' + error);
            }
        });
    });
});

</script>

    </body>
                    
</html>
@endsection 