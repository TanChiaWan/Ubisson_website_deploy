@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hypo Report Event</title>
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

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        

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
                        <div class="content" style="padding: 5vh 5vw;">
                            <h1>Hypo Events</h1>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="button_evt_date">
                                            <select class="event_slt" name="event_type" id="event_type">
                                                <option value="blood_glucose">Blood Glucose</option>
                                                <option value="blood_pressure">Blood Pressure</option>
                                            </select>
                                            <input type="date" class="date_hyper" id="date_start" name="date_start"
                                                    value="2022-07-22"
                                                    min="2000-01-01" max="2050-12-31">
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Blood Glucose Event-->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="container_hypo_events">
                                            <canvas id="myChart"></canvas>           
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

    <!--HyperReportChart.js-->
    <script src="../js/HyperReportChart.js" defer></script>

</body>
</html>
@endsection 