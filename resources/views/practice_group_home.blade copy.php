
@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice Group</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/js/app.js')
        <!--CSS-->
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../css/stylemin.css" rel="stylesheet">
        <!--Bootstrap-->
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>

        <!--font-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
        
    </head>

    <body>
        <div class="closed_sidebar" onclick="OpenSideBar()">&#9776; </div>
        <div class="container"></div>
            <div class="row">
                <!--side bar-->
                <div class="col-sm-3">
            
                </div>

                

                <!--content-->
                <div class="col-sm-8">
                    <div class="content">
                        <h1>Practice Group</h1>

                        <a href={{ route('prac3') }}><div class="row"><div class="col-sm-12 practice_group_button_wrapper"><button class="btn_practice_group">New Practice Group</button></div></div></a>
                        <div class="row">
                            <div class="col-sm-12 legend_wrapper">
                                <div class="dangerous_event_indicator_shape low_event_color"></div>Dangerous Low Event
                                <div class="dangerous_event_indicator_shape high_event_color"></div>Dangerous High Event
                            </div>
                        </div>
                        
                        <div class="row">
                            
                        <practice_group :logbook="{{ $logbook }}" :patient="{{ $patient }}":practice_groups="{{ $practice_groups }}" :patientingroup="{{ $patientingroup }}" :professionalingroup="{{ $professionalingroup }}"></practice_group>

                              
                            
                        </div>
                    </div>
                </div>
            </div>


        <script>
            function OpenSideBar() {
                document.getElementById("sidebar").style.width = "100%";
            }

            function CloseSideBar() {
                document.getElementById("sidebar").style.width = "0";
            }

         </script>

        <!--jQuery CDN - Slim version (=without AJAX)-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <!--Popper.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        
        <!--Bootstrap.js-->
        <script src="bootstrap/bootstrap.min.js"></script>

        <!--Vue-paginate.js-->
        <script src="https://unpkg.com/vuejs-paginate@latest"></script>

       
    </body>
</html>
@endsection 
