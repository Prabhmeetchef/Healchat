<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet">
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
            Thank you for visiting Healchat!
            <a href="https://healbook.in" class="text-white underline" target="_blank"><b>healbook.in</b></a>
        </p>
    </footer>

    <script>
    const sendButton = document.getElementById('sendButton');
    const userMessageInput = document.getElementById('userMessage');
    const chatbox = document.getElementById('chatbox');

    sendButton.addEventListener('click', async () => {
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

            // API call to Vultr's Serverless Inference model
            try {
                const response = await fetch('https://api.vultrinference.com/v1/chat/completions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer NPZPSWD5EFXTFWNLH54WWQPHBRKZL57VYIFA` // Replace with your API key
                    },
                    body: JSON.stringify({
                        model: 'zephyr-7b-beta-Q5_K_M', // Make sure this is the correct model
                        messages: [
                            { role: 'user', content: message }
                        ],
                        max_tokens: 200,
                        temperature: 0.5,
                        top_k: 40,
                        top_p: 0.8,
                        stream: false // Set to false to get the full response at once
                    })
                });

                // Check if the response is ok
                if (response.ok) {
                    const data = await response.json(); const cleanedMessage = data.choices[0].message.content.replace(/\/INST/g, '');

                    // Display the bot's response
                    const botMessage = document.createElement('div');
                    botMessage.classList.add('flex', 'items-start', 'space-x-2');
                    botMessage.innerHTML = `<div class="bg-blue-500 text-white p-2 rounded-lg">${data.choices[0].message.content}</div>`;
                    chatbox.appendChild(botMessage);
                } else {
                    const errorMessage = document.createElement('div');
                    errorMessage.classList.add('flex', 'items-start', 'space-x-2');
                    errorMessage.innerHTML = `<div class="bg-red-500 text-white p-2 rounded-lg">Error: Unable to get a response from the server.</div>`;
                    chatbox.appendChild(errorMessage);
                }

                // Scroll to the bottom of the chat
                chatbox.scrollTop = chatbox.scrollHeight;

            } catch (error) {
                console.error('Error:', error);
                const errorMessage = document.createElement('div');
                errorMessage.classList.add('flex', 'items-start', 'space-x-2');
                errorMessage.innerHTML = `<div class="bg-red-500 text-white p-2 rounded-lg">Sorry, there was an error with the chatbot. Please try again later.</div>`;
                chatbox.appendChild(errorMessage);
                chatbox.scrollTop = chatbox.scrollHeight;
            }
        }
    });
    </script>
</body>
</html>
