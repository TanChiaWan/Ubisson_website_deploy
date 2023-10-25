@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All User</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="../assets/css/datatables2.css" rel="stylesheet">

    </head>

    <body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title fw-semibold mb-2">Users</h5>
                        @if ($userCount>2)
                        <p class="mb-3">{{$userCount}} users</p> 
                        @else
                        <p class="mb-3">{{$userCount}} user</p>
                        @endif  
                    </div>
                </div>
                
                
                <!-- table -->
                <div class="table-responsive table" style="overflow-y: hidden;">
                    <table class="table text-nowrap mb-0 align-middle datatable">
                      <thead class="text-dark fs-4">
                        <tr style="background-color: #7ecbcc;">
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Organization</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Name</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Account Role</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">E-mail Address</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Status</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($professionals as $professionals)
                        <tr>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{$professionals->organization_name}}</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{$professionals->professional_name}}</p>                    
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{$professionals->professional_account_role}}</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{$professionals->professional_email_address}}</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">Active</p>
                          </td>
                          <td class="border-bottom-0">
                            <a href="{{ route('myuser', ['professional_id' => $professionals->professional_id]) }}" class="text-center"><i class="ti ti-eye"></i></a>
                          </td>
                        </tr> 
                       @endforeach
                                                       
                      </tbody>
                    </table>
                  </div>
                  
            </div>
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
    </body>
</html>
@endsection 