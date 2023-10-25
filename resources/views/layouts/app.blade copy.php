<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <meta name="csrf-token" content="{{ csrf_token() }}">

    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
   
    <link rel="stylesheet" href="../css/app.css">
    <script src="https://unpkg.com/vue@2"></script>
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        

        <div class="col-sm-3">
            <div class="sidebar" id="sidebar">
                <span id="sidebar_close_button" onclick="CloseSideBar()">&times;</span>
                <a href='{{ route('home') }}'><img src="../images/BioTectiveLogo.png" alt="BioTective Logo" id="sidebar_biotective_logo"></a>
                <a class='icon_title' href='{{ route('home') }}'><span id="side_logo_title"><strong style="background-color: #7ECBCC;">BioTective</strong>DRC</span></a>
                <img src="../images/new/Icon-sidebar-angle-double-up.png" alt="Icon Double Up" id="sidebar_icon_up">
                <nav id="nav_menu">
                    <ul class="list-unstyled components" id="nav_ul">
                        <li>
                            <a href="#patients_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items"><i class="fas fa-user-injured"></i><span id="nav_item_title">Patients</span></a>
                                <ul class="collapse list-unstyled" id="patients_submenu">
                                    <li><a href="{{ route('all_patient') }}" class="nav_items submenu_items">List</a></li>
                                   
                                    <li><a href="{{ route('create_patient') }}" class="nav_items submenu_items">Create Patient</a></li>
                                    
                                </ul>
                        </li>
                        <li><a href="{{ route('hyper') }}" class="nav_items"><i class="fas fa-level-up-alt"></i><span id="nav_item_title">Hyper Events</span></a></li>
                        <li><a href="{{ route('hypo') }}" class="nav_items"><i class="fas fa-level-down-alt"></i><span id="nav_item_title">Hypo Events</span></a></li>
                        <li><a href="{{ route('practicegroup') }}" class="nav_items"><i class="fas fa-users"></i><span id="nav_item_title">My Working Groups</span></a></li>
                        <br><br>
                        <p style="font-size: 0.9vw; color: #1B6B88;"><u>MANAGEMENT</u></p>
                        <li>
                            <a href="#organization_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items"><i class="fas fa-sitemap"></i><span id="nav_item_title">Organizations</span></a>
                                <ul class="collapse list-unstyled" id="organization_submenu">
                                    <li><a href="{{ route('all_organization') }}" class="nav_items submenu_items">All Organizations</a></li>
                                    <li><a href="{{ route('create_org') }}" class="nav_items submenu_items">Create Organization</a></li>
                                  
                                    <li><a href="{{ route('myorganization') }}" class="nav_items submenu_items">My Organization</a></li>
                            
                                    
                                </ul>
                        </li>
                        <li>
                            <a href="#user_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items"><i class="fas fa-user-md"></i><span id="nav_item_title">Users</span></a>
                                <ul class="collapse list-unstyled" id="user_submenu">
                                    <li><a href="{{ route('all_user') }}" class="nav_items submenu_items">All Users</a></li>
                                    <li><a href="{{ route('users.create') }}" class="nav_items submenu_items">Create User</a></li>
                                </ul>
                        </li>
                        <li>
                            <a href="#role_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items"><i class="fas fa-user-lock"></i><span id="nav_item_title">Roles</span></a>
                                <ul class="collapse list-unstyled" id="role_submenu">
                                    <li><a href="{{ route('all_role') }}" class="nav_items submenu_items">All Roles</a></li>
                                    <li><a href="{{ route('roles.create') }}" class="nav_items submenu_items">Create Role</a></li>
                                </ul>
                        </li>
                        <li>
                            <a href="#permission_submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav_items"><i class="fas fa-unlock-alt"></i><span id="nav_item_title">Permissions</span></a>
                                <ul class="collapse list-unstyled" id="permission_submenu">
                                    <li><a href="{{ route('all_permission') }}" class="nav_items submenu_items">All Permissions</a></li>
                                    <li><a href="{{ route('createpermission') }}" class="nav_items submenu_items">Create Permission</a></li>
                                </ul>
                        </li>
                        <br><br>
                        
                        <p style="font-size: 0.9vw; color: #1B6B88;"><u>ACCOUNT</u></p>
                        
                        <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"
                              class="nav_items" ><i class="fas fa-power-off"></i><span id="nav_item_title">Log out</span></a></li>
                        <br><br>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </nav>
                <img src="../images/new/Icon-sidebar-angle-double-down.png" alt="Icon Double Down" id="sidebar_icon_down">
            </div>
        </div>
       
        <main >
            @yield('content')
        </main>
        
       
    </div>
</body>
</html>
