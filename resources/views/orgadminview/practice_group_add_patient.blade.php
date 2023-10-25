@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice Group</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    </head>

   
                                <body>
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
      <input type="text" id="searchInput" class='form-control1' placeholder="Search" oninput="search()" style="float: right;">
        <h5 class="card-title fw-semibold mb-4">Manage Patients in Group</h5>
        
        <p class="mb-0">{{ $practicegroup->name }}</p>

    
        <form method="POST" action="{{ route('orgpractice_group_detailadd', ['practice_group_id' => $practicegroup->practice_group_id,'organization_id' => $practicegroup->organizationid_FK]) }}">
          @csrf    
          <div class="row mb-4">
            <div class="col-md-6">
              <h6 class="text-center mt-4">Current Patients in Group</h6>
              <hr>
              @foreach($patientingroup as $patientingroup)
                @php
                  $matchingPatient = $patient->firstWhere('patient_id', $patientingroup->patient_id);
                @endphp
                @if ($matchingPatient && $patientingroup->group_id == $practicegroup->practice_group_id)
                  <div class="row patient-row">
                    <div class="col-md-12">
                      <input type="checkbox" name="patient_id[]" value="{{ $matchingPatient->patient_id }}" checked>
                      <label class="mb-0 ms-6">{{ $matchingPatient->patient_name }}</label>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
            <div class="col-md-6">
              <h6 class="text-center mt-4">Other Patients</h6>
              <hr>
              @foreach($patient as $patient)
                @php
                  $matchingPatient = $patientingroup->firstWhere('patient_id', $patient->patient_id);
                @endphp
                @if (!$matchingPatient)
                  <div class="row patient-row">
                    <div class="col-md-12">
                      <input type="checkbox" name="patient_id[]" value="{{ $patient->patient_id }}">
                      <label class="mb-0 ms-6">{{ $patient->patient_name }}</label>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
          <input type="submit" class="btn btn-primary mx-2" value="Confirm"></input>
          <button onclick="back({{ $practicegroup->practice_group_id }})" class="btn btn-secondary mx-2">Cancel</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function back(practiceGroupId) {
      var url = "{{ route('practice_group_detail', ['practice_group_id' => 'PRACTICE_GROUP_ID']) }}";
      url = url.replace('PRACTICE_GROUP_ID', practiceGroupId);
      window.location.href = url;
    }

    function search() {
      var searchInput = document.getElementById('searchInput');
      var searchText = searchInput.value.toLowerCase();
      var patientRows = document.getElementsByClassName('patient-row');

      for (var i = 0; i < patientRows.length; i++) {
        var patientRow = patientRows[i];
        var patientName = patientRow.getElementsByTagName('label')[0].innerText.toLowerCase();

        if (patientName.includes(searchText)) {
          patientRow.style.display = 'block';  // Show the patient
        } else {
          patientRow.style.display = 'none';   // Hide the patient
        }
      }
    }
  </script>
</body>
</html>
@endsection 