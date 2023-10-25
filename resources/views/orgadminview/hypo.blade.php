
@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hypo Event</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS -->
        <link rel="stylesheet" href="../css/stylekong.css">

        <!--Bootstrap-->
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>
        

    </head>

<body>
    <!--Side Bar-->
    <div class="closed_sidebar">&#9776; Menu</div>
        <!--<div class="container">-->
            <div class="row">
                <!--side bar-->
                <div class="col-sm-3">
                   
                </div>

            <!--content-->
            <!--Body-->
                    <div class="col-sm-9">
                        <div class="content">
                            <h1>Hypo Events</h1>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="border_Hypo">
                                                <h2 class="sub_Hypo">Search</h2>          
                                        </div>
                                                <div class="container_Hypo">
                                                    <form method="POST" >
                                                        <div class="form-group_hypo">
                                                            <label class="blood_glucose_hypo">Blood Glucose</label>
                                                            <div class="col-xm-10">
                                                                <p>Criteria 1<br>
                                                                    &ge;
                                                                    <input type="number" class="input-field" id="criteria_1_glucose_hypo" name="criteria_1_glucose_hypo" step="0.01" value="3">
                                                                    <span>mmol/L</span>
                                                                </p>
                                                            </div> 
                                                        </div>   

                                                        <div class="form-group_hypo">
                                                            <div class="col-xm-10">
                                                                <p>Criteria 2<br>
                                                                    &gt;
                                                                    <input type="number" class="input-field" id="criteria_2_glucose_hypo" name="criteria_2_glucose_hypo" step="0.01" value="4">
                                                                    <span>mmol/L</span>
                                                                </p>
                                                            </div>    
                                                        </div>
                                                        
                                                        <div class="form-group_hypo">
                                                            <div class="col-xm-10">
                                                                <p>Duration<br>
                                                                    <select class="borsize_hypo" name="duration_glucose_hypo" id="duration_glucose_hypo">
                                                                        <optgroup>
                                                                            <option value="today">Today</option>
                                                                            <option value="yesterday">Yesterday</option>
                                                                            <option value="since 3 days">Since 3 days</option>
                                                                            <option value="since a week">Since a week</option>
                                                                            <option value="since 2 weeks">Since 2 weeks</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </p>
                                                            </div>    
                                                        </div>

                                                        <div class="form-group_hypo">
                                                            <div class="col-xm-10">
                                                                <p>Period<br>
                                                                    <select class="borsize_hypo" name="period_glucose_hypo" id="period_glucose_hypo">
                                                                        <optgroup>
                                                                            <option value="all time">All Time</option>
                                                                            <option value="wakeup">Wakeup</option>
                                                                            <option value="before breakfast">Before Breakfast</option>
                                                                            <option value="after breakfast">After Breakfast</option>
                                                                            <option value="before lunch">Before Lunch</option>
                                                                            <option value="after lunch">After Lunch</option>
                                                                            <option value="before dinner">Before Dinner</option>
                                                                            <option value="after dinner">After Dinner</option>
                                                                            <option value="bedtime">Bedtime</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </p>
                                                            </div>    
                                                        </div>

                                                        <div class="form-group_hypo">
                                                            <div class="col-xm-10">
                                                                <p>Hyper %<br>
                                                                    <select class="borsize_hypo" name="hyper_glucose_hypo" id="hyper_glucose_hypo">
                                                                        <optgroup>
                                                                            <option value="occurs">Occurs</option>
                                                                            <option value="10%">10%</option>
                                                                            <option value="20%">20%</option>
                                                                            <option value="30%">30%</option>
                                                                            <option value="40%">40%</option>
                                                                            <option value="50%">50%</option>
                                                                            <option value="60%">60%</option>
                                                                            <option value="70%">70%</option>
                                                                            <option value="80%">80%</option>
                                                                            <option value="90%">90%</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </p>
                                                            </div>    
                                                        </div>
                                                        <hr>
                                                        <div class="form-group_hypo1">
                                                            <label class="blood_pressure_hypo">Blood Pressure</label>
                                                            <div class="col-xm-10">
                                                                <p>Criteria 1<br>
                                                                    &ge;
                                                                    <input type="number" class="input-field" id="criteria_1_pressure_hypo" name="criteria_1_pressure_hypo" step="0.01" value="60">
                                                                    <span>mmHg</span>
                                                                </p>
                                                            </div> 
                                                        </div>   

                                                        <div class="form-group_hypo1">
                                                            <div class="col-xm-10">
                                                                <p>Criteria 2<br>
                                                                    &gt;
                                                                    <input type="number" class="input-field" id="criteria_2_pressure_hypo" name="criteria_2_pressure_hypo" step="0.01" value="70">
                                                                    <span>mmHg</span>
                                                                </p>
                                                            </div>    
                                                        </div>
                                                        
                                                        <div class="form-group_hypo1">
                                                            <div class="col-xm-10">
                                                                <p>Duration<br>
                                                                    <select class="borsize_hypo" name="duration_pressure_hypo" id="duration_pressure_hypo">
                                                                        <optgroup>
                                                                            <option value="today">Today</option>
                                                                            <option value="yesterday">Yesterday</option>
                                                                            <option value="since 3 days">Since 3 days</option>
                                                                            <option value="since a week">Since a week</option>
                                                                            <option value="since 2 weeks">Since 2 weeks</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </p>
                                                            </div>    
                                                        </div>

                                                        <div class="form-group_hypo1">
                                                            <div class="col-xm-10">
                                                                <p>Hyper %<br>
                                                                    <select class="borsize_hypo" name="hyper_pressure_hypo" id="hyper_pressure_hypo">
                                                                        <optgroup>
                                                                                <option value="occurs">Occurs</option>
                                                                                <option value="10%">10%</option>
                                                                                <option value="20%">20%</option>
                                                                                <option value="30%">30%</option>
                                                                                <option value="40%">40%</option>
                                                                                <option value="50%">50%</option>
                                                                                <option value="60%">60%</option>
                                                                                <option value="70%">70%</option>
                                                                                <option value="80%">80%</option>
                                                                                <option value="90%">90%</option>   
                                                                        </optgroup>
                                                                    </select>
                                                                </p>
                                                            </div>    
                                                        </div>

                                                    </form>    
                                                </div>
                                        
                                    </div>
                                </div>
                                
                                <!--Search and Report Button-->
                                <div class="row">
                                        <div class="twobtn_hypo">
                                            <button type="Search" class="searchbtn">Search</button>
                                            <a href={{ route('hyporeport') }}><button type="Report" class="reportbtn">Report</button></a>
                                        </div>
                                </div>

                                <!--Blood Glucose Event-->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="border_Hypo_glucose">
                                                <h2 class="sub_Hypo_glucose">Blood Glucose Event</h2>          
                                        </div>
                                                <div class="container_Hypo_glucose">
                                                    <table>
                                                        <tr>
                                                          <th class="txtline">Patient Name</th>
                                                          <th class="txtline">Criteria 1</th>
                                                          <th class="txtline">Criteria 2</th>
                                                          <th class="txtline">Above Target Range</th>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td>No data available in table</td>
                                                          <td></td>
                                                        </tr>
                                                        <!--<tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>-->
                                                    </table>
                                                      
                                                </div>
                                        
                                    </div>
                                </div>

                                <!--Blood Pressure Event-->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="border_Hypo_pressure">
                                                <h2 class="sub_Hypo_pressure">Blood Pressure Event (sbp)</h2>          
                                        </div>
                                                <div class="container_Hypo_pressure">
                                                    <table>
                                                        <tr>
                                                          <th class="txtline">Patient Name</th>
                                                          <th class="txtline">Criteria 1</th>
                                                          <th class="txtline">Criteria 2</th>
                                                          <th class="txtline">Above Target Range</th>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td>No data available in table</td>
                                                          <td></td>
                                                        </tr>
                                                        <!--<tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>-->
                                                    </table>
                                                      
                                                </div>
                                        
                                    </div>
                                </div>
                        </div>
                    </div>


                    

                    
        <!--</div>-->
    </div>

    <!--jQuery CDN - Slim version (=without AJAX)-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
    <!--Popper.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    
    <!--Bootstrap.js-->
    <script src="../bootstrap/bootstrap.min.js"></script>


</body>
</html>
@endsection 