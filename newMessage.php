<?php if (isset($_SESSION['login'])) {
    $username = $_SESSION['username'];
    $message = mysqli_query($conn, "SELECT * FROM chat WHERE username='$username'");
    date_default_timezone_set('ASIA/MANILA');
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #messageBox1 {
            display: flex;
            flex-direction: column;
            align-items: end;
        }
    </style>
    <section class="messageSection">
        <div onclick="letBeMessage()" data-bs-toggle="tooltip" data-bs-placement="top" title="Message us!"
            class="position-fixed border rounded-circle d-flex align-items-center justify-content-center bg-white shadow"
            style="cursor: pointer; user-select: none; height: 50px; width: 50px; bottom: 25px; left: 25px; z-index: 12">
            <i class="bi bi-chat-text text-primary" style="font-size: 30px"></i>
        </div>
        <div id="messageContainer" class="position-fixed flex-column rounded shadow p-4" style="">
            <h5>Message Us!</h5>
            <hr>
            <div id="messageDiv" style="height: 400px; overflow-y: auto">
                <div id="messageBox" class="border border-warning rounded p-2 bg-warning d-flex flex-column"
                    style="overflow: auto; flex-grow: 1; max-height: 300px;">
                    <!-- Messages will be appended here -->
                </div>
            </div>
         
            <div class="w-100 d-flex align-items-center gap-2" style="height: 40px">
                <input type="text" id="messageInput" placeholder="Enter your message..." class="form-control">
                <i class="bi bi-send text-success" id="sendMessage" style="cursor: pointer; font-size: 24px"></i>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
      

            function loadMessages() {
                $.ajax({
                    url: 'PHP/fetchMessages.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        var messageBox = $('#messageDiv');
                        messageBox.empty(); // Clear current messages
                        $.each(data, function (index, message) {
                            var messageElement;

                            // Check if message or reply exists and style accordingly
                            if (message.message) {
                                messageElement = $('<div id="messageBox" class="border border-warning rounded p-2 bg-warning d-flex flex-column" style="overflow: auto; flex-grow: 1; max-height: 300px;">').addClass('w-100').css('height', 'fit-content');
                                var messageContent = $('<div>').text(message.message).addClass('p-2 bg-primary rounded text-white').css('width', 'fit-content');
                                var messageDate = $('<p>').text(message.date).addClass('ps-2').css('font-size', '8px');
                                messageElement.append(messageContent).append(messageDate);
                            } else if (message.reply) {
                                messageElement = $('<div id="messageBox1" class="border border-warning rounded p-2 bg-warning d-flex flex-column" style="overflow: auto; flex-grow: 1; max-height: 300px;">').addClass('w-100').css('height', 'fit-content');
                                var replyContent = $('<div>').text(message.reply).addClass('p-2 bg-secondary rounded text-white float-end').css('width', 'fit-content');
                                var replyDate = $('<p>').text(message.date).addClass('ps-2 float-end').css('font-size', '8px');
                                messageElement.append(replyContent).append(replyDate);
                            }

                            if (messageElement) {
                                messageBox.append(messageElement);
                            }

                            
                        });
                        scrollToBottom();
                    }
                });
            }
            
            function scrollToBottom() {
                var messageDiv = $('#messageDiv');
                messageDiv.scrollTop(messageDiv[0].scrollHeight);
            }
     

            loadMessages();
            scrollToBottom();
            setInterval(loadMessages, 30000);

            // Handle send message
            $('#sendMessage').click(function () {
                var message = $('#messageInput').val();
                if (message) {
                    $.ajax({
                        url: 'PHP/sendMessage.php',
                        method: 'POST',
                        data: { message: message },
                        success: function () {
                            $('#messageInput').val(''); // Clear input field
                            loadMessages(); // Reload messages
                        }
                    });
                }
            });

            // Handle Enter key press to send message
            $('#messageInput').keypress(function (e) {
                if (e.which == 13) { // Enter key code
                    e.preventDefault(); // Prevent default form submission
                    $('#sendMessage').click(); // Trigger the send message functionality
                }
            });
        });
    </script>
<?php } ?>