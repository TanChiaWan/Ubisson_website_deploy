@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My User</title>
    <meta charset="utf-8">
    <meta name="description" content="create">
    <meta name="author" content="Kong">
    <meta name="keywords" content="Organization">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS -->
    <link rel="stylesheet" href="stylekong.css">

    <!--Bootstrap-->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" />


    <!--Vue.js-->
    <script src="https://unpkg.com/vue@2"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <!--side bar-->
            <div class="col-sm-3">

            </div>

            <!--content-->
            <div class="col-sm-9">
                <div class="content">
                    <h1>Profile</h1>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border_MyUser">
                                <h2 class="sub_edit">Personal Information</h2>
                                <a href="{{ route('users.edit', $professional->professional_id) }}"><img src="images/edit.png" alt="edit Pencil" id="edit_pencil_My"></a>
                            </div>

                            <div class="container_MyUser">
                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Name</h3>
                                    <div class="col-xm-10">
                                        {{ $professional->professional_name }}
                                    </div>
                                </div>

                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Gender</h3>
                                    <div class="col-xm-10">
                                        {{ $professional->professional_gender }}
                                    </div>
                                </div>

                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Mobile Phone</h3>
                                    <div class="col-xm-10">
                                        {{ $professional->professional_mobile_phone }}
                                    </div>
                                </div>

                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">E-mail Address</h3>
                                    <div class="col-xm-10">
                                        {{ $professional->professional_email_address }}
                                    </div>
                                </div>

                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Username</h3>
                                    <div class="col-xm-10">
                                        {{ $professional->username }}
                                    </div>
                                </div>

                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Account Role</h3>
                                    <div class="col-xm-10">
                                        @if(!empty($user->getRoleNames())) @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label> @endforeach @endif
                                    </div>
                                </div>

                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Type of Profession</h3>
                                    <div class="col-xm-10">
                                        {{ $professional->professional_type_of_profession }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border_MyUser1">
                                <h2 class="sub_edit">Organization Info</h2>
                            </div>

                            <div class="container_MyUser1">
                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Organization Info</h3>

                                    <div class="col-xm-10">
                                        <span id="confirm_organization_info"></span>
                                    </div>
                                </div>

                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Organization Name</h3>

                                    <div class="col-xm-10">
                                        <span id="confirm_organization_name"></span>
                                    </div>
                                </div>

                                <div class="form-group_MyUser">
                                    <h3 class="h3_word">Type of Profession</h3>

                                    <div class="col-xm-10">
                                        <span id="confirm_profession"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('all_user') }}"> Back</a>
                    </div>

                </div>
            </div>

            <!--jQuery CDN - Slim version (=without AJAX)-->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

            <!--Popper.js-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

            <!--Bootstrap.js-->
            <script src="bootstrap/bootstrap.min.js"></script>

            <!--MyUser.js-->
            <script src="js/myuser.js"></script>

</body>

</html>
@endsection