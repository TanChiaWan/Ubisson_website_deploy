@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice Group</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <!--CSS-->
        <link href="../css/styles.css" rel="stylesheet">
        
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form_title">
                                    <h2 class="sub">Manage Professionals in Group</h2>
                                </div>
                                
                                <form method="POST" action="{{ route('practice_group_detailadd2', ['practice_group_id' => $practicegroup->practice_group_id]) }}">
                                @csrf    
                                <div class="form_body">
                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <h6 class="text-center mt-2">Current Professionals in Group</h6>
                                                <hr style="background-color: #707070; ">
                                                @foreach($professionalingroup as $professionalingroup) 
                                                @php
                                                    $matchingPatient = $professional->firstWhere('professional_id', $professionalingroup->user_id);
                                                @endphp
                                                @if ($matchingPatient && $professionalingroup->group_id == $practicegroup->practice_group_id)
                                                <div class="row">
                                                        <input type="checkbox" name="professional_id[]" value="{{ $matchingPatient->professional_id }}" checked>
                                                        <label style="margin-bottom: 0; margin-left: 10px;">{{ $matchingPatient->professional_name }}</label>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-sm-6">
                                                <h6 class="text-center mt-2">Other Professionals</h6>
                                                <hr style="background-color: #707070; ">
                                                @foreach($professional as $professional)
                                                @php
                                                $matchingPatient = $professionalingroup->firstWhere('user_id', $professional->professional_id);
                                                @endphp
                                                @if (!$matchingPatient)
                                                <div class="row">
                                                        <input type="checkbox" name="professional_id[]" value="{{ $professional->professional_id }}" >
                                                        <label style="margin-bottom: 0; margin-left: 10px;">{{ $professional->professional_name }}</label>
                                                    </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 practice_group_button_wrapper">
                                            <input type="submit" class="btn_practice_group" style="margin-right: 20px; width: fit-content" value="Confirm"></input>
                                            <button class="btn_practice_group" onclick="back({{ $practicegroup->practice_group_id }})">Cancel</button>
                                        </div>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
            <script>
    function back(practiceGroupId) {
        var url = "{{ route('practice_group_detail', ['practice_group_id' => 'PRACTICE_GROUP_ID']) }}";
        url = url.replace('PRACTICE_GROUP_ID', practiceGroupId);
        window.location.href = url;
    }
    
</script>
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

        <script src="../vuejs_all_organization.js"></script>
    </body>
</html>
@endsection 