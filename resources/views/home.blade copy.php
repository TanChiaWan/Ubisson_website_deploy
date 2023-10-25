@extends('layouts.app') 
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
     
     
        
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" />
     <script src="https://unpkg.com/vue@2"></script>

        <!--jQuery CDN - Slim version (=without AJAX)-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <!--Popper.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
        <!--Bootstrap.js-->
        
</head>


<title>
 
        Dashboard
    
</title>

<body>
 
    <div style="overflow-x: hidden;">
        <div class="row">
          
            

            
            <div class="main-content">
                <header>
                    <h1>Dashboard</h1>
                </header>

                <main>
                    <div class="cards">
                        <div class='cards-column'>
                            <div class="cards-single1">
                                <div>
                                    <a href="{{ route('all_patient') }}">
                                        <h1>{{ $patientsCount }}</h1>
                                        <span>No.of Patients Profile > </span></a>
                                </div>
                            </div>
                            <br>
                            <div class="cards-single2">
                                <div>
                                    <a href="{{ route('practicegroup') }}">
                                        <h2>{{$practicegroupCount}}</h2>
                                        <span>Practice Group ></span></a>
                                </div>
                            </div>
                        </div>

                        <div class='cards-column1'>
                            <div class="cards-single3">
                                <div>
                                    <a href="{{ route('hyper') }}">
                                        <h2>3</h2>
                                        <span>Hyper Events ></span></a>
                                </div>
                            </div>
                            <br>
                            <div class="cards-single4">
                                <div>
                                    <a href="{{ route('hypo') }}">
                                        <h2>3</h2>
                                        <span>Hypo Events ></span></a>
                                </div>
                            </div>
                            <br>
                            <div class="cards-single5">
                                <div>
                                    <a href="{{ route('all_user') }}">
                                        <h2>{{ $professionalsCount }}</h2>
                                        <span>No.of Professionals ></span></a>
                                </div>
                            </div>
                            <br>
                        </div>
                </main>
                </div>
                <script src="bootstrap/bootstrap.min.js"></script>
</body>

</html>
 @endsection 