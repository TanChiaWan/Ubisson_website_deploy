@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Organization</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/js/app.js')
        <!--CSS-->
        <link href="css/tablestyles.css" rel="stylesheet">
        <link href="css/stylesmin.css" rel="stylesheet">
        <!--Bootstrap-->
        <link href="bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>

        <!--font-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body>
s

                <!--content-->
                <div class="col-sm-9">
                    <div class="content">
                        <organization :organizations="{{($organizations) }}"></organization>



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
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    </body>
</html>
@endsection 