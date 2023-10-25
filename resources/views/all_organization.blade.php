@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Organization</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
       
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
                        <h5 class="card-title fw-semibold mb-2">Organizations</h5>
                        @if ($organizationCount>2)
                        <p class="mb-3">{{$organizationCount}} organizations</p> 
                        @else
                        <p class="mb-3">{{$organizationCount}} organization</p>
                        @endif  
                    </div>
                    <!--<div class="col-md-6 text-end">
                        <div class="row justify-content-end">
                            <div class="input-group input-group-sm" style="width:200px; padding-bottom: 10px;">
                                <input type="text" class="form-control" placeholder="Search">
                                <button class="btn btn-primary" type="button">
                                <i class="ti ti-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>-->
                </div>
                
                
                <!-- table -->
                <div class="table-responsive table" style="overflow-y: hidden;">
                    <table class="text-nowrap mb-0 align-middle datatable">
                      <thead class="text-dark fs-4">
                        <tr style="background-color: #7ecbcc;">
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">ID</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Name</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Customized Login URL</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Admin Name</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($organizations as $organizations)
                        <tr>
                          <td class="border-bottom-0"><p class="mb-0 fw-normal">{{ $organizations->organizationid }}</p></td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $organizations->organization_name }}</p>                    
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">http:/{{ $organizations->customized_login_url }}</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $organizations->administrator_name }}</p>
                          </td>
                          <td class="border-bottom-0">
                            <a href="{{ route('updateorganization', ['organizationid' => $organizations->organizationid]) }}" class="text-center"><i class="ti ti-eye"></i></a>
                          </td>
                        </tr> 
                        @endforeach
                              </tr>
                                                       
                      </tbody>
                    </table>
                  </div>
                  <!-- pagination -->
                  <!--<nav aria-label="Table pagination" style="padding-top:10px;">
                    <ul class="pagination justify-content-end mb-0">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                </nav>-->
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