@extends('layouts.patapp') 
@section('content')

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BioTectiveDRC</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- Include DataTables CSS -->
  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">-->
  <link rel="stylesheet" href="../assets/css/datatables.css" />

  <!-- Buttons CSS -->
  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">-->
  <link rel="stylesheet" href="../assets/css/datatables-button.css" />

  <!-- Include Bootstrap CSS and JS in your HTML 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

  <!-- Include jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Include Bootstrap JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

</head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<body>
  <!--  Body Wrapper -->
 
      <!--  Header Start -->
      
      <!--  Header End -->
      <div class="container-fluid">
        <!-- Outer Tab -->
        <div class="d-flex justify-content-center">
          <div class="card d-inline-block">
            <div class="card-body py-1 px-4">
              <div class="row text-center">
                <div class="col-md-12 p-0">
                <form action="{{ route('dashboard_general') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Dashboard</button>
                  </form>
                <form action="{{ route('aboutpatient') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">About Patient</button>
                  </form>
                  <form action="{{ route('logbook_bg') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Logbook</button>
                  </form>
                  <form action="{{ route('healthdata') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Health Data</button>
                  </form>
                  <form action="{{ route('remark') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-primary m-1 active">Remarks</button>
                  </form>
                  <form action="{{ route('medicationreport') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Medication</button>
                  </form>
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
          <div class="tab_nav mt-3" >
    <label for="date-range">Select Date Range:</label>
    <input type="text" id="date-range" name="date-range" class="tabnav2" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-bottom: 2vh;margin-top: 2vh; margin-left: 1vw; margin-right: 1vw; width: 20vw;">

    </div>
                
            <div class="row">
                <div class="col-md-12 text-end">
                 
                <form action="{{ route('addremark') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-primary m-1 btn-with-icon"><i class="ti ti-plus"></i>Add</button>
                  </form>

                </div>
            </div>

            <!--TimeLine-->
            <div class="row">
              <div class="col d-flex align-items-stretch">
                
                  <div class="card-body p-3">
                    <div class="col text-end">
                      <span class="dot-label">
                        <span class="dot critical"></span>
                        <span class="label-text critical">Critical Situation</span>
                      </span>
                      <span class="dot-label">
                        <span class="dot recovery"></span>
                        <span class="label-text recovery">Recovery</span>
                      </span>
                      <span class="dot-label">
                        <span class="dot discharge"></span>
                        <span class="label-text discharge">Discharge</span>
                      </span>
                    </div>
                    
                    <section class="py-2">
                      <ul class="timeline">
                      
                      @foreach ($remark->groupBy(function ($item) {
                                    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->remark_created_date)->format('Y');
                                }) as $year => $yearGroup)
                                    <li class="timeline-item timeline-items mb-5" data-date="{{ $year }}">
                                        
                                    <ul class="timeline-filter-item">
                                        @foreach ($yearGroup->groupBy(function ($item) {
                                                return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->remark_created_date)->format('F');
                                            })->sortByDesc(function ($monthGroup, $month) {
                                                return Carbon\Carbon::parse($month)->month;
                                            }) as $month => $monthGroup)
                                        
                                <h5 class="fw-bold month" data-dates="{{ ($monthGroup->pluck('remark_created_date')) }}">{{ $month }}</h5>

                                                    <ul>
                                                        @foreach ($monthGroup as $remark)
                                                            @php
                                                                $matchingPatient = $patient->firstWhere('patient_id', $remark->patient_id_FK);
                                                                $matchingProfessional = $professional->firstWhere('professional_id', $remark->professional_id);
                                
                                                                $statusClass = '';
                                                                if ($remark->status == 'Critical Situation') {
                                                                    $statusClass = 'critical';
                                                                } elseif ($remark->status == 'Recovery') {
                                                                    $statusClass = 'recovery';
                                                                } elseif ($remark->status == 'Discharge') {
                                                                    $statusClass = 'discharge';
                                                                }
                                                            @endphp
                                                            @if ($matchingPatient && $matchingProfessional)
                                                            <div class="container-fluid" data-remark-date="{{ $remark->remark_created_date }}">
                                                                    <div class="card w-75">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                @if ($remark->remark_image)
                                                                                    @if (filter_var($remark->remark_image, FILTER_VALIDATE_URL))
                                                                                        <div id="profile-picture" style="cursor: unset; background-image: url('{{ $remark->remark_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                                                                    @else
                                                                                        <img id="profile-picture" class="rounded float-left img-fluid" src="{{ asset('storage/' . $remark->remark_image) }}" alt="Uploaded Image">
                                                                                    @endif
                                                                                @else
                                                                                    <p>No image available</p>
                                                                                @endif
                                                                                    
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                <p class="text">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $remark->remark_created_date)->format('Y-m-d') }}</p>

                                                                                    <p class="label-text {{ $statusClass }}">Status: In {{ $remark->status }}</p>
                                                                                    <p class="label-text">Remark: {{ $remark->remark_comment }}</p>
                                                                                    @if ($remark->remark_file)
                                                                                    @php
                                                                                        $fileInfo = pathinfo($remark->remark_file);
                                                                                        $originalFileName = $fileInfo['filename'];
                                                                                        $fileExtension = $fileInfo['extension'];
                                                                                    @endphp
                                                                                    <p>File attached: <a href="{{ asset('storage/' . $remark->remark_file) }}" download>{{ $originalFileName . '.' . $fileExtension }}</a></p>
                                                                                    @endif
                                                                                    
                                                                                    <div class="row text-end">
                                                                                        <p class="text1">Remarked by: {{ $matchingProfessional->professional_name }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                                    
                                                        
                                                        
                                                        
                                                    

                                                    
                                                    </ul>
                    </section>
                  </div>
                
              </div>
            </div>
      
          </div>
        </div>
      </div>
 







      <script>
document.addEventListener("DOMContentLoaded", function() {
    const timelineItems = document.querySelectorAll(".timeline-item");
    const dateRangeInput = document.getElementById('date-range');
    const statusFilters = document.querySelectorAll(".status-filter");

    // Function to check if a date is within the selected date range
    function isDateInRange(date, startDate, endDate) {
        return (!startDate || !endDate || (date >= startDate && date <= endDate));
    }

    // Function to check if an item matches the selected status filter
    function doesItemMatchStatus(item, selectedStatus) {
        const itemStatusElement = item.querySelector(".label-text");
        if (itemStatusElement) {
            const itemStatus = itemStatusElement.textContent.split(":")[1].trim();
            return (!selectedStatus || selectedStatus === itemStatus);
        }
        return true; // If no status element is found, consider it a match
    }

   // Function to update the timeline based on selected date range and status filters
// Function to update the timeline based on selected date range and status filters
function updateTimeline() {
    const filterDateStart = dateRangeInput._flatpickr.selectedDates[0];
    const filterDateEnd = dateRangeInput._flatpickr.selectedDates[1];

    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    const formattedStartDate = formatDate(filterDateStart);
    const formattedEndDate = formatDate(filterDateEnd);

    const selectedStatus = document.querySelector(".status-filter.active")?.getAttribute("data-status");

    timelineItems.forEach(item => {
        // Get the child remarks
        const childRemarks = item.querySelectorAll(".container-fluid");

        let shouldDisplay = false;

        childRemarks.forEach(remark => {
            const remarkDateStr = remark.getAttribute("data-remark-date");
            const formattedRemarkDate = formatDate(new Date(remarkDateStr));

            if (formattedRemarkDate) {
                const isInRange = isDateInRange(formattedRemarkDate, formattedStartDate, formattedEndDate);
                const matchesStatus = doesItemMatchStatus(remark, selectedStatus);
                const shouldDisplayRemark = isInRange && matchesStatus;

                remark.style.display = shouldDisplayRemark ? "block" : "none";

                shouldDisplay = shouldDisplay || shouldDisplayRemark;
            }
        });

        // Check if the month header should be displayed or hidden
        const monthHeader = item.querySelector(".month");
console.log(monthHeader);
const monthRemarks = item.querySelectorAll(".container-fluid");
const shouldDisplayMonth = Array.from(monthRemarks).some(remark => remark.style.display === "block");
monthHeader.style.display = shouldDisplayMonth ? "block" : "none";
    });
}



    // Initialize Flatpickr for the date range input
    flatpickr(dateRangeInput, {
        mode: 'range',
        dateFormat: 'Y-m-d',
        onClose: updateTimeline
    });

    // Add event listeners for your status filter buttons
    statusFilters.forEach(button => {
        button.addEventListener("click", function() {
            statusFilters.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");
            updateTimeline();
        });
    });

    // Initial update to ensure proper initial display
    updateTimeline();
});
</script>







<script>
    document.addEventListener("DOMContentLoaded", function() {
        const downloadLinks = document.querySelectorAll("a[download]");

        downloadLinks.forEach(function(link) {
            const filePath = link.getAttribute("href");
            const fileName = filePath.substring(filePath.lastIndexOf("/") + 1);

            link.addEventListener("click", function(event) {
                // Prevent default link behavior
                event.preventDefault();
                
                // Create a temporary anchor element
                const tempLink = document.createElement("a");
                tempLink.href = filePath;
                tempLink.setAttribute("download", fileName);
                
                // Trigger a click on the temporary anchor
                document.body.appendChild(tempLink);
                tempLink.click();
                document.body.removeChild(tempLink);
            });
        });
    });
</script>

</body>

</html>
@endsection 