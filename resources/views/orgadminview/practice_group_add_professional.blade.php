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
      <input type="text"  id="searchInput" placeholder="Search" oninput="search()" style="float: right;">
        <h5 class="card-title fw-semibold mb-4">Manage Professionals in Group</h5>
        <p class="mb-0">{{ $practicegroup->name }}</p>

       
        
        <form method="POST" action="{{ route('orgpractice_group_detailadd2', ['practice_group_id' => $practicegroup->practice_group_id,'organization_id' => $practicegroup->organizationid_FK]) }}">
          @csrf    
          <div class="row mb-4">
            <div class="col-md-6">
              <h6 class="text-center mt-4">Current Professionals in Group</h6>
              <hr>
              @foreach($professionalingroup as $professionalingroup) 
                @php
                  $matchingPatient = $professional->firstWhere('professional_id', $professionalingroup->user_id);
                @endphp
                @if ($matchingPatient && $professionalingroup->group_id == $practicegroup->practice_group_id)
                  <div class="row professional-row">
                    <div class="col-md-12">
                      <input type="checkbox" name="professional_id[]" value="{{ $matchingPatient->professional_id }}" checked>
                      <label class="mb-0 ms-6">{{ $matchingPatient->professional_name }}</label>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
            <div class="col-md-6">
              <h6 class="text-center mt-4">Other Professionals</h6>
              <hr>
              @foreach($professional as $professional)
                @php
                  $matchingPatient = $professionalingroup->firstWhere('user_id', $professional->professional_id);
                @endphp
                @if (!$matchingPatient)
                  <div class="row professional-row">
                    <div class="col-md-12">
                      <input type="checkbox" name="professional_id[]" value="{{ $professional->professional_id }}">
                      <label class="mb-0 ms-6">{{ $professional->professional_name }}</label>
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
      var professionalRows = document.getElementsByClassName('professional-row');

      for (var i = 0; i < professionalRows.length; i++) {
        var professionalRow = professionalRows[i];
        var professionalName = professionalRow.getElementsByTagName('label')[0].innerText.toLowerCase();

        if (professionalName.includes(searchText)) {
          professionalRow.style.display = 'block';  // Show the professional
        } else {
          professionalRow.style.display = 'none';   // Hide the professional
        }
      }
    }
  </script>
</body>
</html>
@endsection 