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
            <li class="sidebar-item">
              <a class="sidebar-link collapsed" href="#" aria-expanded="false" data-bs-target="#medication-nav" data-bs-toggle="collapse">
                <span>
                  <i class="ti ti-medicine-syrup"></i>
                </span>
                <span class="hide-menu">Medication</span><i class="ti ti-chevron-down"></i>
              </a>
              <ul id="medication-nav" class="collapse sidebar-list" data-bs-parent="#sidebarnav">
                <li class="sidebar-list-item">
                <a href="{{ route('medication_list') }}">
                    <i class="ti ti-point"></i><span> List</span>
                  </a>
                </li>
              </ul>
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
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="widget-content chat-container" id="chat-container">
          <!-- chat content -->
        </div>
  
        <form id="direct-message-form">
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
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop_notification" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-start dropdown-menu-animate-up" aria-labelledby="drop_notification">
                <div class="message-body">
                  <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                    <div class="dot low_event_color rounded-circle"></div>
                    <p class="mb-0 fs-3 ms-2 text-truncate dropdown-truncate">
                      <b>Anna Nelson</b><!--<span class="fs-1 fst-italic">  11:49pm 11-Feb-2023</span>-->
                      <br>
                      <span>is experiencing HYPO event.</span>
                    </p>
                    
                  </a>
                  <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                    <div class="dot high_event_color rounded-circle"></div>
                    <p class="mb-0 fs-3 ms-2 text-truncate dropdown-truncate">
                      <b>Kento Momota</b>
                      <br>
                      <span>is experiencing HYPER event.</span>
                    </p>
                    
                  </a>
                  <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                    <div class="dot low_event_color rounded-circle"></div>
                    <p class="mb-0 fs-3 ms-2 text-truncate dropdown-truncate">
                      <b>Viktor Axelson</b>
                      <br>
                      <span>is experiencing HYPO event.</span>
                    </p>
                  </a>
                  <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">View All Notifications</a>
                </div>
              </div>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="{{ route('chat') }}">
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
                  <form action="{{ route('resetpassword') }}"  method="POST">
                  @csrf
                    <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                    
                      <button class="d-flex align-items-center gap-2 dropdown-item" type="submit"><i class="ti ti-key fs-6"></i><p class="mb-0 fs-3">Reset Password</p></button>
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

  <script defer>
  document.addEventListener('DOMContentLoaded', function() {

    const chatData = [
      { sender: 'Dr. Vong', timestamp: '12:30', content: 'Hello there!', reply: 'no'},
      { sender: 'You', timestamp: '12:31', content: 'How are you?', reply: 'yes', date: '2023-07-13', bg: 8.2, period: 'After Breakfast'},
      { sender: 'You', timestamp: '12:32', content: 'How are you?How are you?How are you?How are you?How are you?How are you?', reply: 'yes', date: '2023-07-14', bg: 5.1, period: 'Before Lunch' },
      { sender: 'Dr. Vong', timestamp: '12:33', content: 'Hello there!', reply: 'no' },
      { sender: 'You', timestamp: '12:34', content: 'How are you?', reply: 'no' },
      { sender: 'Dr. Vong', timestamp: '12:35', content: 'Hello there!', reply: 'no' },
      { sender: 'Dr. Vong', timestamp: '12:36', content: 'Hello there!', reply: 'no' },
    ];
      
    loadChatMessages(chatData);
  
    // load the chats with specific contact person
    function loadChatMessages(chatData) {
      const chatContainer = document.getElementById('chat-container');
      chatContainer.innerHTML = '';
      const messages = chatData;
      if (messages) {
        messages.forEach(function(message) {
          const messageElement = createMessageElement(message);
          chatContainer.appendChild(messageElement);

          // Scroll the chat container to the bottom
          chatContainer.scrollTop = chatContainer.scrollHeight;
        });
      }
    }
  
    // create message element in the chat content box
    function createMessageElement(message) {
      const messageElement = document.createElement('div');
      messageElement.classList.add('message');
  
      const isSelf = message.sender === 'You';
      if (isSelf) {
        messageElement.classList.add('sender-self', 'ps-5');
      } else {
        messageElement.classList.add('sender-other');
      }

      if (message.reply == 'no') {
        messageElement.innerHTML = `
          <span class="sender">${message.sender}:</span>
          <span class="timestamp">${message.timestamp}</span>
          <div class="content card message-card">${message.content}</div>
        `;
      }
      else {
        var readingColor = "";
        if (message.bg > 7.8) {
          readingColor = "#EC1F28";
        }
        else if (message.bg < 4.0) {
          readingColor = "#668DC4";
        }
        else {
          readingColor = "#67C56D";
        }
        messageElement.innerHTML = `
          <span class="sender">${message.sender}:</span>
          <span class="timestamp">${message.timestamp}</span>
          <div class="content card message-card">
            <div class="card mb-2 px-2" style="box-shadow: none;">
              <div class="card-body p-1" style="color: #555555;">
                <span style="color: ${readingColor}; font-size: large"><strong> ${message.bg} </strong></span> mmol/L
                <p class="mb-0"><strong>${message.date}</strong></p>
                <p class="mb-1">(${message.period})</p>
              </div>
            </div>
            ${message.content}
          </div>
        `;
      }
      return messageElement;
    }

    //(new) for send message function

    // Get the message form and input field
    const directMessageForm = document.getElementById('direct-message-form');
    const directMessageInput = document.getElementById('direct-message-input');

    // Add an event listener to the message form for submission
    directMessageForm.addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent form submission

      // Get the message content from the input field
      const messageContent = directMessageInput.value.trim();

      // Check if the message is not empty
      if (messageContent !== '') {
        // Get the ID of the selected contact
        //const selectedContactId = event.target.closest('li').dataset.chat;

        // Create a new message object
        const newMessage = {
          sender: 'You', // Assuming the sender is always 'You'
          timestamp: getCurrentTimestamp(), // You can create a function to get the current timestamp
          content: messageContent,
          reply: '',
        };

        // Add the new message to the chat container on the frontend
        const chatContainer = document.getElementById('chat-container');
        const newMessageElement = createMessageElement(newMessage);
        chatContainer.appendChild(newMessageElement);

        // Clear the message input field after sending
        messageInput.value = '';

        // You can also send the new message to the server for storage and delivery to the recipient (backend logic not shown here)
        // sendNewMessageToServer(selectedContactId, newMessage); // Replace this with the backend logic
      }
    });

    // Function to get the current timestamp in a specific format
    function getCurrentTimestamp() {
      const date = new Date();
      const hours = String(date.getHours()).padStart(2, '0');
      const minutes = String(date.getMinutes()).padStart(2, '0');
      return `${hours}:${minutes}`;
    }
  });
  </script>
</div>

</body>
</html>
