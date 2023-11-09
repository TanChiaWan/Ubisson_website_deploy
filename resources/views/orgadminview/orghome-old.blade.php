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
    
    


   
        
</head>


<title>
 
        Dashboard
    
</title>

<body>

<div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h5 class="card-title fw-semibold mb-4">Dashboard</h5>
            <p> Welcome to BioTectiveDRC Dashboard!</p>
          </div>
        </div>
        <div class="row">
          <!--Row 1-->
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-start">
                  <div class="col-8">
                    <h5 class="card-title mb-9 fw-normal">Administrator</h5>
                    <h4 class="fw-semibold mb-3">5</h4>
                    
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div
                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-user fs-6"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-start">
                  <div class="col-8">
                    <h5 class="card-title mb-9 fw-normal">Organization</h5>
                    <h4 class="fw-semibold mb-3">50</h4>
                    
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-end">
                      <div
                        class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-users fs-6"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--  Row 2 -->
        <div class="row">
              <div class="col-md-3">
                <!-- Doctor--> 
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-normal">Doctor</h5>
                        <h4 class="fw-semibold mb-3">60</h4>
                       
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-stethoscope fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <!-- Nurse-->
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-normal">Nurse</h5>
                        <h4 class="fw-semibold mb-3">100</h4>
                        
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-nurse fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <!-- Pharmacist-->
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-normal">Pharmacist</h5>
                        <h4 class="fw-semibold mb-3">50</h4>
                       
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-nurse fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <!-- Patient-->
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-normal"> Patient </h5>
                        <h4 class="fw-semibold mb-3">200</h4>
                        
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-end">
                          <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-users fs-6"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <!--<div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">New Patients</h5>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                            </select>
                        </div>
                    </div>
                    <canvas id="dropLineChart"></canvas>
                </div>
            </div>
          </div>-->
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card w-100">
              <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                      <div class="mb-3 mb-sm-0">
                          <h5 class="card-title fw-semibold">New Patients Added</h5>
                      </div>
                      <div>
                          <select class="form-select">
                              <option value="1">March 2023</option>
                              <option value="2">April 2023</option>
                              <option value="3">May 2023</option>
                              <option value="4">June 2023</option>
                          </select>
                      </div>
                  </div>
                  <canvas id="dropLineChart"></canvas>
              </div>
            </div>
          </div>
        </div> 
      </div>     
    </div>


    <script defer>
    document.addEventListener("DOMContentLoaded", function() {
      // Get a reference to the canvas element
      var ctx = document.getElementById('dropLineChart').getContext('2d');
      
      // Define your data points and labels
      var data = {
        labels: ["March 2023", "April 2023", "May 2023", "June 2023", "July 2023", "August 2023"],
        datasets: [{
          label: "Patient",
          data: [10, 20, 15, 25, 8, 30], // Replace with your actual data
          borderColor: 'blue', // Color of the line
          borderWidth: 1, // Width of the line
          fill: 'start', // Fill the area under the line
          backgroundColor: 'rgba(0, 0, 255, 0.2)', // Fill color
        }]
      };
      
      // Define chart options
      var options = {
        scales: {
          y: {
            beginAtZero: true, // Start the y-axis at zero
            max: 30, // Set the maximum value for the y-axis
            grid: {
              display: false, // Hide the y-axis grid lines
            },
          },
          x: {
            grid: {
              display: false, // Hide the x-axis grid lines
            },
          },
        }
      };
      
      // Create the line chart
      var myLineChart = new Chart(ctx, {
        type: 'line', // Specify the chart type
        data: data, // Provide the data and labels
        options: options // Provide the chart options
      });
    });
  </script>
</body>

</html>
 @endsection 