<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<html lang="en">
    <head>
        <title>BioTective - All Organizations</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <!--CSS-->
        <link href="{{asset('css/navstyles.css')}}" rel="stylesheet">
        
        <!--Bootstrap-->
        <link href="{{asset('bootstrap/bootstrap.min.css')}}" rel="stylesheet" />
        <script src="{{asset('bootstrap/bootstrap.min.js')}}"></script>
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <!--side bar-->
                <div class="col-sm-3">
                    <div class="sidebar">
                        <img src="images/BioTectiveLogo.png" alt="BioTective Logo" id="sidebar_biotective_logo">
                        <span id="side_logo_title"><strong style="background-color: #7ECBCC;">Biotective</strong>DRC</span>
                        <img src="images/new/Icon-sidebar-angle-double-up.png" alt="Icon Double Up" id="sidebar_icon_up">
                        <nav id="nav_menu">
                            <ul class="list-unstyled components" id="nav_ul">
                                <li>
                                    <a href="#patients_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items">Patients</a>
                                        <ul class="collapse list-unstyled" id="patients_submenu">
                                            <li><a href="#" class="nav_items submenu_items">List</a></li>
                                            <li><a href="#" class="nav_items submenu_items">Patient APP Data</a></li>
                                            <li><a href="#" class="nav_items submenu_items">Create Patient</a></li>
                                            <li><a href="#" class="nav_items submenu_items">Add Patient From APP</a></li>
                                            <li><a href="#" class="nav_items submenu_items">Merge Patient</a></li>
                                        </ul>
                                </li>
                                <li><a href="#" class="nav_items">Hyper Events</a></li>
                                <li><a href="#" class="nav_items">Hypo Events</a></li>
                                <li><a href="#" class="nav_items">My Working Groups</a></li>
                                <br/><br/>
                                <p style="font-size: 12px; color: #1B6B88;"><u>MANAGEMENT</u></p>
                                <li>
                                    <a href="#organization_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items">Organizations</a>
                                        <ul class="collapse list-unstyled" id="organization_submenu">
                                            <li><a href="#" class="nav_items submenu_items">All Organizations</a></li>
                                            <li><a href="#" class="nav_items submenu_items">Create Organization</a></li>
                                            <li><a href="#" class="nav_items submenu_items">My Organization</a></li>
                                        </ul>
                                </li>
                                <li>
                                    <a href="#user_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items">Users</a>
                                        <ul class="collapse list-unstyled" id="user_submenu">
                                            <li><a href="#" class="nav_items submenu_items">All Users</a></li>
                                            <li><a href="#" class="nav_items submenu_items">Create User</a></li>
                                        </ul>
                                </li>
                                <li>
                                    <a href="#role_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items">Roles</a>
                                        <ul class="collapse list-unstyled" id="role_submenu">
                                            <li><a href="#" class="nav_items submenu_items">All Roles</a></li>
                                            <li><a href="#" class="nav_items submenu_items">Create Role</a></li>
                                        </ul>
                                </li>
                                <li>
                                    <a href="#permission_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items">Permissions</a>
                                        <ul class="collapse list-unstyled" id="permission_submenu">
                                            <li><a href="#" class="nav_items submenu_items">All Permissions</a></li>
                                            <li><a href="#" class="nav_items submenu_items">Create Permission</a></li>
                                        </ul>
                                </li>
                            </ul>
                        </nav>
                        <img src="images/new/Icon-sidebar-angle-double-down.png" alt="Icon Double Down" id="sidebar_icon_down">
                    </div>
                </div>

                <!--content-->
                <div class="col-sm-9">
                    <div class="content">
                        <h1>All Organizations</h1>
                        <h2 class="subtitle">12 Organizations</h2>
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-1">
                                <p>Search</p>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" id="all_organization_search_text_field">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Customized Login URL</th>
                                        <th>Admin Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>ACME</td>
                                        <td>http://13.213.99.102/acme/login</td>
                                        <td>AnneBen</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>   
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!--jQuery CDN - Slim version (=without AJAX)-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <!--Popper.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        
        <!--Bootstrap.js-->
        <script src="bootstrap/bootstrap.min.js"></script>
    </body>
</html>