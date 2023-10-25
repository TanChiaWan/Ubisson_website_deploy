@extends('layouts.app') 
@section('content')
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BioTectiveDRC</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />
</head>

<body>
  <!--  Body Wrapper -->

      <!--  Header Start -->
   
      <!--  Header End -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 pb-4">
            <!-- contact-list hidden -->
            <div class="card h-100" id="contact-list-card" style="display:none;"></div>

            <!-- chat-history-list displaying -->
            <div class="card h-100" id="chat-history-list-card">
              <div class="card-body px-3 py-0">
                <div class="d-flex w-100 pb-3 ps-2 pt-3 justify-content-between align-items-center">
                  <h5 class="card-title fw-semibold m-0">Chats</h5>
                  <a href="#" class="btn btn-primary btn-with-icon btn-new-chat" style="height: fit-content;"><i class="ti ti-message-plus"></i>New Chat</a>
                </div>
                <ul class="list-group" id="chat-history-list">
                  <li class="list-group-item list-group-item-action" data-chat="1">
                    <div class="d-flex w-100 justify-content-between">
                      <p class="mb-1 fw-bolder text-truncate">Dr. Vong</p>
                      <small>12:30 PM</small>
                    </div>
                    <p class="mb-1 text-truncate">Some placeholder content in a paragraph.</p>
                  </li>
                  <li class="list-group-item list-group-item-action" data-chat="2">
                    <div class="d-flex w-100 justify-content-between">
                      <p class="mb-1 fw-bolder text-truncate">Leonard Lu</p>
                      <small>Yesterday</small>
                    </div>
                    <p class="mb-1 text-truncate">Some placeholder content in a paragraph.</p>
                  </li>
                  <li class="list-group-item list-group-item-action" data-chat="3">
                    <div class="d-flex w-100 justify-content-between">
                      <p class="mb-1 fw-bolder text-truncate">Yi Tong Tan</p>
                      <small>5/7/2023</small>
                    </div>
                    <p class="mb-1 text-truncate">Some placeholder content in a paragraph.</p>
                  </li>
                  <!-- more contacts -->
                  
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-8 pb-4">
            <div class="card">
              <div class="card-body chat-container" id="chat-container">
                <!-- chat content -->
              </div>
            </div>
            <form id="message-form" class="mt-3">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter a message" id="message-input">
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </form>
          </div>
        </div>
    
      </div>
    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script defer>
         document.addEventListener('DOMContentLoaded', function () {
        // example chats
        const chatData = {
          1: [
            { sender: 'Dr. Vong', timestamp: '12:30', content: 'Hello there!', reply: 'no'},
            { sender: 'You', timestamp: '12:31', content: 'How are you?', reply: 'yes', date: '2023-07-13', bg: 8.2, period: 'After Breakfast'},
            { sender: 'You', timestamp: '12:32', content: 'How are you?How are you?How are you?How are you?How are you?How are you?', reply: 'yes', date: '2023-07-14', bg: 5.1, period: 'Before Lunch' },
            { sender: 'Dr. Vong', timestamp: '12:33', content: 'Hello there!', reply: 'no' },
            { sender: 'You', timestamp: '12:34', content: 'How are you?', reply: 'no' },
            { sender: 'Dr. Vong', timestamp: '12:35', content: 'Hello there!', reply: 'no' },
            { sender: 'Dr. Vong', timestamp: '12:36', content: 'Hello there!', reply: 'no' },
          ],
          2: [
            { sender: 'You', timestamp: '13:00', content: 'Hi!', reply: 'no' },
            { sender: 'Leonard Lu', timestamp: '13:05', content: 'What\'s up?', reply: 'no' }
          ],
          3: [
            { sender: 'Yi Tong Tan', timestamp: '14:00 PM', content: 'Hey!', reply: 'no'  },
            { sender: 'Yi Tong Tan', timestamp: '14:10 PM', content: 'Long time no see.', reply: 'yes', date: '2023-07-13', bg: 3.8, period: 'After Breakfast' }
          ]
        };
    
        // handle click of chat-history-list
        const chatHistoryList = document.getElementById('chat-history-list');
        chatHistoryList.addEventListener('click', function(event) {
          const selectedContact = event.target.closest('li').dataset.chat;
          loadChatMessages(selectedContact);
          setActiveContact(event.target.closest('li'), chatHistoryList);
        });
    
        // load the chats with specific contact person
        function loadChatMessages(contactId) {
          const chatContainer = document.getElementById('chat-container');
          chatContainer.innerHTML = '';

          const chatHeader = document.createElement('div');
          chatHeader.classList.add('chat-header', 'd-flex');
          chatHeader.innerHTML = `
            <div style="width: 30px; height: 30px; border-radius: 30px; background: #000; display: inline-block;"></div>
            <p style="display: inline; margin-bottom: 0; margin-left: 15px; align-self: center;"> Dr. Vong</p>
          `;
          chatContainer.appendChild(chatHeader);

          const messages = chatData[contactId];
          if (messages) {
            messages.forEach(function(message) {
              const messageElement = createMessageElement(message);
              chatContainer.appendChild(messageElement);

              // Scroll the chat container to the bottom
              chatContainer.scrollTop = chatContainer.scrollHeight;
            });
          }

          //chatContainer.appendChild(chatBody);
          
          // Scroll the chat container to the bottom
          
        }
    
        // set active contact item in chat-history-list
        function setActiveContact(element, list) {
          const activeClass = 'active';
          const previousActive = list.querySelector(`.${activeClass}`);
          if (previousActive) {
            previousActive.classList.remove(activeClass);
          }
          element.classList.add(activeClass);
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
                    <p class="mb-1"><strong>${message.date}</strong> (${message.period})</p>
                  </div>
                </div>
                ${message.content}
              </div>
            `;
          }
          
          return messageElement;
        }

        //(new) for new chat button

        // Function to create and show the new chat card
        function showContactListCard() {
          const newChatCardPlaceholder = document.getElementById('contact-list-card');

          // Check if the new card is already created, if not, create it
          if (!newChatCardPlaceholder.querySelector('.card')) {
            // Create the new card element
            const newChatCard = document.createElement('div');
            newChatCard.classList.add('new-chat-card', 'card-body', 'px-3', 'py-0');
            newChatCard.innerHTML = `
                <div class="d-flex w-100 pb-3 ps-2 pt-3 justify-content-between align-items-center">
                  <h5 class="card-title fw-semibold m-0">All Contacts</h5>
                </div>
                <ul class="list-group" id="contact-list">
                  <li class="list-group-item list-group-item-action">Abbie</li>
                  <li class="list-group-item list-group-item-action">Ann</li>
                  <li class="list-group-item list-group-item-action">Chek Fung Kong</li>
                  <li class="list-group-item list-group-item-action">Dr. Vong</li>
                  <li class="list-group-item list-group-item-action">Leonard Lu</li>
                  <li class="list-group-item list-group-item-action">Yi Tong Tan</li>
                </ul>
            `;

            // Append the new card to the placeholder
            newChatCardPlaceholder.appendChild(newChatCard);
          }

          // Show the new card by adding the "show" class
          document.getElementById('chat-history-list-card').style.display = 'none';
          newChatCardPlaceholder.style.display = 'block';
          setTimeout(() => {
            newChatCardPlaceholder.querySelector('.new-chat-card').classList.add('show');
          }, 50); // Delay to allow the display property to take effect
        }

        

        // Function to hide the new chat card
        function hideNewChatCard() {
          const newChatCardPlaceholder = document.getElementById('new-chat-card-placeholder');
          newChatCardPlaceholder.querySelector('.new-chat-card').classList.remove('show');
          setTimeout(() => {
            newChatCardPlaceholder.style.display = 'none';
          }, 500); // Delay to allow the slide-out animation to finish
        }

        // Event listener for the "New Chat" button click
        document.querySelector('.btn-new-chat').addEventListener('click', function (event) {
          event.preventDefault();
          showContactListCard();
        });

        //(new) for send message function

        // Get the message form and input field
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input');

        // Add an event listener to the message form for submission
        messageForm.addEventListener('submit', function (event) {
          event.preventDefault(); // Prevent form submission

          // Get the message content from the input field
          const messageContent = messageInput.value.trim();

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
   

  
  <!--<a href="#" class="btn-back-to-top d-flex align-items-center justify-content-center"><i class="ti ti-arrow-up"></i></a>-->
  <button id="backToTopBtn" title="Back to Top" class="btn justify-content-center align-items-center"><i class="ti ti-arrow-up"></i></button>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>

</html>
@endsection 