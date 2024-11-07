<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet" >
</head>

<body class="font-sans antialiased text-black dark:text-white bg-cover bg-no-repeat bg-center min-h-screen" style="background-image: url('wave-haikei.svg');">
    <div class="relative top-16 border max-w-lg mx-auto p-4 bg-white bg-opacity-80 rounded-lg shadow-lg">
        <!-- Chat Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Healchat</h2>
        </div>

        <!-- Chat Area -->
        <div id="chatbox" class="space-y-4 max-h-60 overflow-y-auto p-4 border-b border-gray-300">
            <!-- Example messages -->
            <div class="flex items-start space-x-2">
                <div class="bg-blue-500 text-white p-2 rounded-lg">Hello! How can I help you today?</div>
            </div>
            <div class="flex items-start space-x-2 justify-end">
                <div class="bg-gray-300 text-black p-2 rounded-lg">Hi! I need some assistance.</div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="flex items-center mt-4">
            <input type="text" id="userMessage" class="flex-1 border border-gray-300 rounded-lg p-2 mr-2" placeholder="Type a message..." />
            <button id="sendButton" class="bg-blue-500 text-white px-4 py-2 rounded">Send</button>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="fixed w-full text-center block" style="top: 90vh;">
        <p class="text-white">
            Thank you for visiting Healchat!</p>
            <a href="https://healbook.in" class="text-white underline" target="_blank"><b>healbook.in</b></a>
        </p>
    </footer>

    <script>
        // Simple chat interaction
        const sendButton = document.getElementById('sendButton');
        const userMessageInput = document.getElementById('userMessage');
        const chatbox = document.getElementById('chatbox');

        sendButton.addEventListener('click', () => {
            const message = userMessageInput.value.trim();
            if (message) {
                // Display user's message
                const userMessage = document.createElement('div');
                userMessage.classList.add('flex', 'items-start', 'space-x-2', 'justify-end');
                userMessage.innerHTML = `<div class="bg-gray-300 text-black p-2 rounded-lg">${message}</div>`;
                chatbox.appendChild(userMessage);

                // Clear input field
                userMessageInput.value = '';

                // Scroll to the bottom of the chat
                chatbox.scrollTop = chatbox.scrollHeight;

                // Simulate bot response (this can be replaced with actual bot logic)
                setTimeout(() => {
                    const botMessage = document.createElement('div');
                    botMessage.classList.add('flex', 'items-start', 'space-x-2');
                    botMessage.innerHTML = `<div class="bg-blue-500 text-white p-2 rounded-lg">I'm here to help!</div>`;
                    chatbox.appendChild(botMessage);

                    // Scroll to the bottom of the chat
                    chatbox.scrollTop = chatbox.scrollHeight;
                }, 1000);
            }
        });
    </script>
</body>

</html>
