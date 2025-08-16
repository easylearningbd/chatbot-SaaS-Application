
document.addEventListener('DOMContentLoaded', () => {
 

const CHATBOT_API_BASE_URL = 'http://127.0.0.1:8000/api';

    const chatbotWidgetContainer = document.getElementById('my-chatbot-widget');
    if (!chatbotWidgetContainer) {
        console.error('Chatbot widget container not found');
        return;
    }

    const CHATBOT_ID = chatbotWidgetContainer.dataset.chatbotId;
    if (!CHATBOT_ID) {
        console.error('Chatbot widget Id not found');
        return;
    }


    const chatbotContainer = document.createElement('div');
    chatbotContainer.id = 'saas-chatbot-widget';
    chatbotContainer.classList.add('chatbot-container');

    chatbotContainer.innerHTML = `
    <div class="chatbot-header" id="chatbot-header-dynamic">
            <span>AI Assistant</span>
            <button id="toggle-chatbot-btn-dynamic" class="text-white text-2xl leading-none">&times;</button>
        </div>
        <div class="chat-messages" id="chat-messages-dynamic">
            <div class="message ai">Hello! How can I help you today?</div>
        </div>
        <div class="chat-input-area">
            <input type="text" id="chat-input-dynamic" class="chat-input" placeholder="Type your message...">
            <button id="send-button-dynamic" class="send-button">Send</button>
        </div> 
    `;
 
    chatbotWidgetContainer.appendChild(chatbotContainer); 
    
    const chatbotHeader = document.getElementById('chatbot-header-dynamic');
    const toggleChatbotBtn = document.getElementById('toggle-chatbot-btn-dynamic');
    const chatMessages = document.getElementById('chat-messages-dynamic');
    const chatInput = document.getElementById('chat-input-dynamic');
    const sendButton = document.getElementById('send-button-dynamic');

    let isChatbotOpen = false;
    let isLoading = false;

    /// Helper functions 

    function appendMessage(sender, text){
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message',sender);
        messageDiv.textContent = text;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showLoadingIndicator(){
        if (!document.getElementById('loading-indicator-dynamic')) {
            const loadingDiv = document.createElement('div');
            loadingDiv.id = 'loading-indicator-dynamic';
            loadingDiv.classList.add('loading-indicator');
            loadingDiv.textContent = 'AI is typing...';
            chatMessages.appendChild(loadingDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight; 

        }
    }

    function hideLoadingIndicator(){
        const loadingDiv = document.getElementById('loading-indicator-dynamic')
        if (loadingDiv) {
            loadingDiv.remove();
        }
    }

    function toggleChatbot(){
        isChatbotOpen = !isChatbotOpen;
        if (isChatbotOpen) {
            chatbotContainer.classList.add('open');
            toggleChatbotBtn.textContent = 'x';
            chatInput.focus();
        }else{
            chatbotContainer.classList.remove('open');
             toggleChatbotBtn.textContent = '💬';
        }
    }

    async function sendMessage(){
        const userText = chatInput.value.trim();
        if (userText === '' || isLoading) {
            return;
        }
     
        appendMessage('user', userText);
        chatInput.value = '';
        isLoading = true;
        sendButton.disabled = true;
        showLoadingIndicator(); 

    try {
        const response = await fetch(`${CHATBOT_API_BASE_URL}/chatbots/${CHATBOT_ID}/chat`, {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ query: userText })
        });

        const data = await response.json();

        if (response.ok) {
            appendMessage('ai', data.answer);
        }else {
            const errorMessage = data.error || data.message || 'Sorry, I encounterd an error';
            appendMessage('ai', `Error: ${errorMessage}`);
        }        
    } catch (error) {
        console.error('Network unexpected error', error);
        appendMessage('ai', 'Opps something went wrong');
    }finally {
        isLoading = false;
        sendButton.disabled = false;
        hideLoadingIndicator() 
      } 
    }


    /// Event Listeners 

    sendButton.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            sendMessage();
        }
    }); 

    chatbotHeader.addEventListener('click', toggleChatbot);
    toggleChatbotBtn.addEventListener('click', (event) => {
        event.stopPropagation()
        toggleChatbot();
    });

    setTimeout(() => {
        chatbotContainer.style.opacity = '1';
        chatbotContainer.style.visibility = 'visible';
    },500); 


});