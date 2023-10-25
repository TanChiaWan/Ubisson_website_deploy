@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice Group</title>
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
                                <h5 class="card-title fw-semibold mb-4">Practice Group</h5>
                                <p class="mb-0">{{ $practicegroup->name }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <a class="btn btn-primary m-2 btn-with-icon" onclick="manageProfessionals({{ $practicegroup->practice_group_id }}, {{ $practicegroup->organizationid_FK }})"><i class="ti ti-stethoscope"></i>Manage Professionals</a>
                                <a class="btn btn-primary m-2 btn-with-icon" onclick="managePatients({{ $practicegroup->practice_group_id }}, {{ $practicegroup->organizationid_FK }})"><i class="ti ti-user"></i>Manage Patients</a>
                                <a class="btn btn-primary m-2 btn-with-icon" onclick="exported({{ $practicegroup->practice_group_id }}, {{ $practicegroup->organizationid_FK }})"><i class="ti ti-file-export"></i>Export</a>
                                <a class="btn btn-primary m-2 btn-with-icon" data-bs-toggle="modal" data-bs-target="#delete_practice_group_modal"><i class="ti ti-trash"></i>Delete Group</a>
                            </div>
                        </div>

                        <!-- Delete dialog box start -->
                        <div class="modal fade" id="delete_practice_group_modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Practice Group</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Are you sure you want to delete this group?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" onclick="deletes({{ $practicegroup->practice_group_id }}, {{ $practicegroup->organizationid_FK }})">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table">
                            <table class="table text-nowrap mb-0 align-middle datatable">
                                <thead class="text-dark fs-4">
                                    <tr style="background-color: #7ecbcc;">
                                        <th class="border-bottom-0 sortable" onclick="sortTable(0)">
                                            <h6 class="fw-semibold mb-0">Name</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(1)">
                                            <h6 class="fw-semibold mb-0">Phone no.</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(2)">
                                            <h6 class="fw-semibold mb-0">Dangerous Event (Total)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(3)">
                                            <h6 class="fw-semibold mb-0">Dangerous Low Event</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(4)">
                                            <h6 class="fw-semibold mb-0">Dangerous High Event</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(5)">
                                            <h6 class="fw-semibold mb-0">Ideal Range</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(6)">
                                            <h6 class="fw-semibold mb-0">Dangerous Range(Low)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(7)">
                                            <h6 class="fw-semibold mb-0">Dangerous Range(High)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(8)">
                                            <h6 class="fw-semibold mb-0">Last recorded</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(9)">
                                            <h6 class="fw-semibold mb-0">Date Added</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($patientingroup as $patientingroup)
                @php
                    $matchingPatient = $patient->firstWhere('patient_id', $patientingroup->patient_id);
                @endphp
                @if ($matchingPatient && $patientingroup->group_id == $practicegroup->practice_group_id)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $matchingPatient->patient_name }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">+{{ $matchingPatient->patient_phonenum }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $matchingPatient->triggertimes }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $matchingPatient->dangerLow }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $matchingPatient->dangerHigh }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $matchingPatient->idealrangeBG_low }} to {{ $matchingPatient->idealrangeBG_high }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $matchingPatient->dangerousrangeBG_low }} to {{ $matchingPatient->idealrangeBG_low }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $matchingPatient->idealrangeBG_high }} to {{ $matchingPatient->dangerousrangeBG_high }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $patientingroup->updated_at }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $patientingroup->created_at }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                <a href="{{ route('patient', ['patientId' => $matchingPatient->patient_id, 'organization_id' => $practicegroup->organizationid_FK]) }}" ><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            function manageProfessionals(practiceGroupId, organizationId) {
            var url = "{{ route('orgprac4', ['practice_group_id' => 'PRACTICE_GROUP_ID', 'organization_id' => 'ORGANIZATION_ID']) }}";
            url = url.replace('PRACTICE_GROUP_ID', practiceGroupId).replace('ORGANIZATION_ID', organizationId);
            window.location.href = url;
            }

            function managePatients(practiceGroupId, organizationId) {
            var url = "{{ route('orgprac5', ['practice_group_id' => 'PRACTICE_GROUP_ID', 'organization_id' => 'ORGANIZATION_ID']) }}";
            url = url.replace('PRACTICE_GROUP_ID', practiceGroupId).replace('ORGANIZATION_ID', organizationId);
            window.location.href = url;
            }

            function deletes(practiceGroupId, organizationId) {
            var url = "{{ route('orgpractice_group_detaildelete', ['practice_group_id' => 'PRACTICE_GROUP_ID', 'organization_id' => 'ORGANIZATION_ID']) }}";
            url = url.replace('PRACTICE_GROUP_ID', practiceGroupId).replace('ORGANIZATION_ID', organizationId);
            window.location.href = url;
            }
                function exported(practiceGroupId, organizationId) {
            var url = "{{ route('export', ['practice_group_id' => 'PRACTICE_GROUP_ID', 'organization_id' => 'ORGANIZATION_ID']) }}";
            url = url.replace('PRACTICE_GROUP_ID', practiceGroupId).replace('ORGANIZATION_ID', organizationId);
            window.location.href = url;
            }
        
    
 
            // Define the constant for DataTables library URL
                const DATATABLES_URL = 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js';

                $(document).ready(function() {
                    // Load DataTables library dynamically
                    loadScript(DATATABLES_URL, function() {
                        $('.datatable').DataTable({
                        lengthMenu: [5, 10, 25, 100], // Define the available entries options
                        scrollX:true
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





 
  

            <!-- Script for datatable and export function in datatable -->
 
        </body>

</html>
@endsection 