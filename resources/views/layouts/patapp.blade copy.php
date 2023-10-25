<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />
    

   
    <script src="https://unpkg.com/vue@2"></script>
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div id="app">
        
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ route('home') }}" class="text-nowrap logo-img">
            <img src="../assets/images/logos/BioTective Logo.png" width="205" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
   
            
           
            <!--<li class="sidebar-item">
              <a class="sidebar-link" href="./organizations.html" aria-expanded="false">
                <span>
                  <i class="ti ti-building"></i>
                </span>
                <span class="hide-menu">Organizations</span>
              </a>
            </li>-->
         
          
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link collapsed" href="#" aria-expanded="false" data-bs-target="#patients-nav" data-bs-toggle="collapse">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Patients</span><i class="ti ti-chevron-down"></i>
              </a>
              <ul id="patients-nav" class="collapse sidebar-list" data-bs-parent="#sidebarnav">
                <li class="sidebar-list-item">
                  <a href="{{ route('all_patient') }}">
                    <i class="ti ti-point"></i><span> List</span>
                  </a>
                </li>
                <li class="sidebar-list-item">
                  <a href="{{ route('create_patient') }}">
                    <i class="ti ti-point"></i><span> Create Patient</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('hyper') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-arrow-autofit-up"></i>
                </span>
                <span class="hide-menu">Hyper Events</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('hypo') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-arrow-autofit-down"></i>
                </span>
                <span class="hide-menu">Hypo Events</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('practicegroup') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">My Working Groups</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MANAGEMENT</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link collapsed" href="#" aria-expanded="false" data-bs-target="#organizations-nav" data-bs-toggle="collapse">
                <span>
                  <i class="ti ti-building-hospital"></i>
                </span>
                <span class="hide-menu">Organizations</span><i class="ti ti-chevron-down"></i>
              </a>
              <ul id="organizations-nav" class="collapse sidebar-list" data-bs-parent="#sidebarnav">
                <li class="sidebar-list-item">
                  <a href="{{ route('all_organization') }}">
                    <i class="ti ti-point"></i><span> All Organization</span>
                  </a>
                </li>
                <li class="sidebar-list-item">
                  <a href="{{ route('create_org') }}">
                    <i class="ti ti-point"></i><span> Create Organization</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link collapsed" href="#" aria-expanded="false" data-bs-target="#users-nav" data-bs-toggle="collapse">
                <span>
                  <i class="ti ti-stethoscope"></i>
                </span>
                <span class="hide-menu">Users</span><i class="ti ti-chevron-down"></i>
              </a>
              <ul id="users-nav" class="collapse sidebar-list" data-bs-parent="#sidebarnav">
                <li class="sidebar-list-item">
                  <a href="{{ route('all_user') }}">
                    <i class="ti ti-point"></i><span> All Users</span>
                  </a>
                </li>
                <li class="sidebar-list-item">
                  <a href="{{ route('users.create') }}">
                    <i class="ti ti-point"></i><span> Create User</span>
                  </a>
                </li>
                <li class="sidebar-list-item">
                  <a href="{{ route('import.form') }}">
                    <i class="ti ti-point"></i><span> Import User</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link collapsed" href="#" aria-expanded="false" data-bs-target="#roles-nav" data-bs-toggle="collapse">
                <span>
                  <i class="ti ti-license"></i>
                </span>
                <span class="hide-menu">Roles</span><i class="ti ti-chevron-down"></i>
              </a>
              <ul id="roles-nav" class="collapse sidebar-list" data-bs-parent="#sidebarnav">
                <li class="sidebar-list-item">
                  <a href="{{ route('all_role') }}">
                    <i class="ti ti-point"></i><span> All Roles</span>
                  </a>
                </li>
                <li class="sidebar-list-item">
                  <a href="{{ route('roles.create') }}">
                    <i class="ti ti-point"></i><span> Create Role</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link collapsed" href="#" aria-expanded="false" data-bs-target="#permissions-nav" data-bs-toggle="collapse">
                <span>
                  <i class="ti ti-lock-square"></i>
                </span>
                <span class="hide-menu">Permissions</span><i class="ti ti-chevron-down"></i>
              </a>
              <ul id="permissions-nav" class="collapse sidebar-list" data-bs-parent="#sidebarnav">
                <li class="sidebar-list-item">
                  <a href="{{ route('all_permission') }}">
                    <i class="ti ti-point"></i><span> All Permissions</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <div class="accordion message-accordion" id="message-accordion">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="ti ti-messages pe-3"></i>Message
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="widget-content chat-container" id="chat-container">
            <!-- Chat content will be displayed here -->
            @php
              $professionalId = $user->professional_id;
            @endphp

            @foreach ($chat_messages as $chat_message)
              @if ($chat_message->sender_id == $professionalId)
                <div class="message sender-self ps-5">
                  <span class="sender">{{ $user->professional_name }}:</span>
                  <span class="timestamp"></span>
                  <div class="content card message-card">{{ $chat_message->message }}</div>
                </div>
           
              @endif
            @endforeach
          </div>

          <form id="direct-message-form" method="POST" action="{{ route('sendMessage', ['sender_id' => $patient->patient_id]) }}">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Enter a message" style="background-color: #fff;">
              <button type="submit" class="btn btn-primary">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <main class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                  <i class="ti ti-message"></i>
                </a>
              </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ $user->professional_image }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                  <form action="{{ route('myprofile') }}" method="POST">
                    @csrf
                    <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                    
                    <button class="d-flex align-items-center gap-2 dropdown-item" type="submit"><i class="ti ti-user-circle fs-6"></i><p class="mb-0 fs-3">My Profile</p></button>
                  </form>
                    <a href="{{ route('myorganization') }}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-building fs-6"></i>
                      <p class="mb-0 fs-3">My Organization</p>
                    </a>
                    <!--<a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>-->
                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"
                             class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
   
            @yield('content')
        </main>
      
    
</div>
       
       
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>

  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

</div>

</body>
</html>
