// Fish database with sample data
const fishDatabase = [
    {
        "id": 1,
        "commonName": "Clownfish",
        "scientificName": "Amphiprioninae",
        "description": "Clownfish are small, brightly colored fish known for their symbiotic relationship with sea anemones. They have a mucus layer that protects them from the anemone's sting. Found in warm waters of the Indian and Pacific Oceans.",
        "size": "10-18 cm",
        "habitat": "Coral Reefs",
        "region": "Indo-Pacific",
        "diet": "Omnivore",
        "conservationStatus": "Least Concern"
    },
    {
        "id": 2,
        "commonName": "Betta Fish",
        "scientificName": "Betta splendens",
        "description": "Also known as Siamese fighting fish, Bettas are known for their vibrant colors and elaborate fins. They are labyrinth fish, meaning they can breathe atmospheric air. Native to Southeast Asia.",
        "size": "6-8 cm",
        "habitat": "Rice Paddies",
        "region": "Southeast Asia",
        "diet": "Carnivore",
        "conservationStatus": "Vulnerable"
    },
    {
        "id": 3,
        "commonName": "Goldfish",
        "scientificName": "Carassius auratus",
        "description": "One of the most common aquarium fish, goldfish were domesticated from wild carp. They have excellent color vision and memory. Originally bred in ancient China over 1000 years ago.",
        "size": "15-30 cm",
        "habitat": "Freshwater",
        "region": "Worldwide",
        "diet": "Omnivore",
        "conservationStatus": "Domesticated"
    },
    {
        "id": 4,
        "commonName": "Angelfish",
        "scientificName": "Pterophyllum",
        "description": "Freshwater angelfish are known for their distinctive triangular shape and long fins. They are cichlids native to the Amazon Basin. Popular in aquariums for their graceful swimming.",
        "size": "15-20 cm",
        "habitat": "Amazon Rivers",
        "region": "South America",
        "diet": "Omnivore",
        "conservationStatus": "Least Concern"
    },
    {
        "id": 5,
        "commonName": "Guppy",
        "scientificName": "Poecilia reticulata",
        "description": "Small, colorful livebearer fish popular in home aquariums. Known for their rapid reproduction and variety of colors. Native to northeast South America but introduced worldwide.",
        "size": "4-6 cm",
        "habitat": "Freshwater Streams",
        "region": "South America",
        "diet": "Omnivore",
        "conservationStatus": "Least Concern"
    }
];

// Chatbot messages
const chatbotResponses = [
    "I can help identify that fish! Try uploading an image to the main analyzer for detailed classification.",
    "That's a great question about fish! Based on the image, I'd recommend checking the detailed analysis results.",
    "Fish identification requires analyzing specific visual features. Our AI model examines color patterns, fin shapes, and body structure.",
    "Many fish species have unique markings that help with identification. Clear, well-lit images give the best results.",
    "Did you know some fish can change their gender? Clownfish, for example, are all born male and can become female!"
];

// DOM Elements
let dropZone, imageUpload, analyzeBtn, resultsSection, previewImage, fishName, scientificName, confidenceScore, confidencePercent, confidenceBar, fishDescription, fishSize, fishHabitat, fishRegion, fishDiet, shareBtn, newAnalysisBtn, chatbotPopup, chatbotToggle, chatbotToggleFixed, closeChatbot, chatMessages, chatInput, sendMessage, uploadImageChat, chatImageUpload, loadingOverlay, loadingProgress, loadingStatus;

// Current state
let currentImage = null;
let chatOpen = false;
let messageCount = 0;

function initEventListeners() {
    // DOM refs
    dropZone = document.getElementById('dropZone');
    imageUpload = document.getElementById('imageUpload');
    analyzeBtn = document.getElementById('analyzeBtn');
    resultsSection = document.getElementById('resultsSection');
    previewImage = document.getElementById('previewImage');
    fishName = document.getElementById('fishName');
    scientificName = document.getElementById('scientificName');
    confidenceScore = document.getElementById('confidenceScore');
    confidencePercent = document.getElementById('confidencePercent');
    confidenceBar = document.getElementById('confidenceBar');
    fishDescription = document.getElementById('fishDescription');
    fishSize = document.getElementById('fishSize');
    fishHabitat = document.getElementById('fishHabitat');
    fishRegion = document.getElementById('fishRegion');
    fishDiet = document.getElementById('fishDiet');
    shareBtn = document.getElementById('shareBtn');
    newAnalysisBtn = document.getElementById('newAnalysisBtn');
    chatbotPopup = document.getElementById('chatbotPopup');
    chatbotToggle = document.getElementById('chatbotToggle');
    chatbotToggleFixed = document.getElementById('chatbotToggleFixed');
    closeChatbot = document.getElementById('closeChatbot');
    chatMessages = document.getElementById('chatMessages');
    chatInput = document.getElementById('chatInput');
    sendMessage = document.getElementById('sendMessage');
    uploadImageChat = document.getElementById('uploadImageChat');
    chatImageUpload = document.getElementById('chatImageUpload');
    loadingOverlay = document.getElementById('loadingOverlay');
    loadingProgress = document.getElementById('loadingProgress');
    loadingStatus = document.getElementById('loadingStatus');

    if (!dropZone) return;

    // File upload handling
    dropZone.addEventListener('click', () => imageUpload.click());
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drag-over');
    });
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('drag-over');
    });
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        if (e.dataTransfer.files.length) {
            handleImageUpload(e.dataTransfer.files[0]);
        }
    });

    imageUpload.addEventListener('change', (e) => {
        if (e.target.files.length) {
            handleImageUpload(e.target.files[0]);
        }
    });

    // Analyze button
    analyzeBtn.addEventListener('click', analyzeImage);

    // New analysis button
    newAnalysisBtn.addEventListener('click', resetAnalysis);

    // Share button
    shareBtn.addEventListener('click', shareResults);

    // Chatbot controls
    chatbotToggle && chatbotToggle.addEventListener('click', toggleChatbot);
    chatbotToggleFixed && chatbotToggleFixed.addEventListener('click', toggleChatbot);
    closeChatbot && closeChatbot.addEventListener('click', () => {
        chatbotPopup.classList.add('hidden');
        chatOpen = false;
    });

    // Chat functionality
    sendMessage && sendMessage.addEventListener('click', sendChatMessage);
    chatInput && chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendChatMessage();
    });

    uploadImageChat && uploadImageChat.addEventListener('click', () => chatImageUpload.click());
    chatImageUpload && chatImageUpload.addEventListener('change', (e) => {
        if (e.target.files.length) {
            handleChatImageUpload(e.target.files[0]);
        }
    });

    // Allow image drop in chat
    chatMessages && chatMessages.addEventListener('dragover', (e) => {
        e.preventDefault();
        chatMessages.classList.add('drag-over');
    });

    chatMessages && chatMessages.addEventListener('dragleave', () => {
        chatMessages.classList.remove('drag-over');
    });

    chatMessages && chatMessages.addEventListener('drop', (e) => {
        e.preventDefault();
        chatMessages.classList.remove('drag-over');
        if (e.dataTransfer.files.length) {
            handleChatImageUpload(e.dataTransfer.files[0]);
        }
    });
}

// Handle image upload
function handleImageUpload(file) {
    if (!file.type.match('image.*')) {
        alert('Please upload an image file (JPG, PNG, GIF, etc.)');
        return;
    }

    if (file.size > 10 * 1024 * 1024) {
        alert('Image size should be less than 10MB');
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        currentImage = e.target.result;
        previewImage.src = currentImage;
        analyzeBtn.disabled = false;
        analyzeBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');

        // Show preview in results section
        resultsSection.classList.remove('hidden');
        resultsSection.scrollIntoView({ behavior: 'smooth' });
    };
    reader.readAsDataURL(file);
}

// Analyze image (simulated)
function analyzeImage() {
    if (!currentImage) return;

    // Show loading overlay
    loadingOverlay.classList.remove('hidden');
    loadingProgress.style.width = '0%';
    loadingStatus.textContent = 'Processing image features...';

    // Simulate analysis progress
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 20;
        if (progress > 100) progress = 100;
        loadingProgress.style.width = `${progress}%`;

        if (progress < 30) {
            loadingStatus.textContent = 'Extracting image features...';
        } else if (progress < 60) {
            loadingStatus.textContent = 'Comparing with fish database...';
        } else if (progress < 90) {
            loadingStatus.textContent = 'Calculating confidence scores...';
        } else {
            loadingStatus.textContent = 'Finalizing results...';
        }

        if (progress >= 100) {
            clearInterval(interval);
            setTimeout(() => {
                loadingOverlay.classList.add('hidden');
                showAnalysisResults();
            }, 500);
        }
    }, 200);
}

// Show analysis results
function showAnalysisResults() {
    // Randomly select a fish from database
    const randomFish = fishDatabase[Math.floor(Math.random() * fishDatabase.length)];
    const confidence = (Math.random() * 10 + 90).toFixed(1); // 90-100%

    // Update UI with results
    fishName.textContent = randomFish.commonName;
    scientificName.textContent = randomFish.scientificName;
    confidenceScore.textContent = `${confidence}%`;
    confidencePercent.textContent = `${confidence}%`;
    confidenceBar.style.width = `${confidence}%`;
    fishDescription.textContent = randomFish.description;
    fishSize.textContent = randomFish.size;
    fishHabitat.textContent = randomFish.habitat;
    fishRegion.textContent = randomFish.region;
    fishDiet.textContent = randomFish.diet;

    // Scroll to results
    resultsSection.scrollIntoView({ behavior: 'smooth' });
}

// Reset analysis
function resetAnalysis() {
    currentImage = null;
    previewImage.src = '';
    imageUpload.value = '';
    analyzeBtn.disabled = true;
    analyzeBtn.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
    resultsSection.classList.add('hidden');

    // Scroll to upload section
    dropZone.scrollIntoView({ behavior: 'smooth' });
}

// Share results
function shareResults() {
    const fish = fishName.textContent;
    const confidence = confidenceScore.textContent;

    if (navigator.share) {
        navigator.share({
            title: 'FishAI Analysis Results',
            text: `I identified a ${fish} with ${confidence} confidence using FishAI!`,
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        const text = `Check out my FishAI analysis! I identified a ${fish} with ${confidence} confidence.`;
        prompt('Copy this link to share:', text);
    }
}

// Toggle chatbot
function toggleChatbot() {
    chatOpen = !chatOpen;
    if (chatOpen) {
        chatbotPopup.classList.remove('hidden');
        chatbotPopup.classList.add('animate-float');
        chatInput.focus();
    } else {
        chatbotPopup.classList.add('hidden');
        chatbotPopup.classList.remove('animate-float');
    }
}

// Send chat message
function sendChatMessage() {
    const message = chatInput.value.trim();
    if (!message) return;

    // Add user message
    addChatMessage(message, 'user');
    chatInput.value = '';

    // Simulate AI response
    setTimeout(() => {
        const randomResponse = chatbotResponses[Math.floor(Math.random() * chatbotResponses.length)];
        addChatMessage(randomResponse, 'ai');
    }, 1000);
}

// Add chat message
function addChatMessage(text, sender) {
    messageCount++;

    const messageDiv = document.createElement('div');
    messageDiv.className = `chat-message ${sender === 'user' ? 'ml-auto bg-primary text-white rounded-2xl rounded-tr-none' : 'bg-blue-50 rounded-2xl rounded-tl-none'}`;

    messageDiv.innerHTML = `
        <div class="flex items-start space-x-2 ${sender === 'user' ? 'flex-row-reverse space-x-reverse' : ''}">
            <div class="w-8 h-8 ${sender === 'user' ? 'bg-white/20' : 'bg-primary'} rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas ${sender === 'user' ? 'fa-user' : 'fa-robot'} text-${sender === 'user' ? 'white' : 'white'} text-sm"></i>
            </div>
            <div class="${sender === 'user' ? 'text-right' : ''}">
                <p class="font-medium ${sender === 'user' ? 'text-blue-100' : 'text-dark'} mb-1">${sender === 'user' ? 'You' : 'FishAI Assistant'}</p>
                <p class="${sender === 'user' ? 'text-blue-100' : 'text-gray-700'}">${text}</p>
            </div>
        </div>
    `;

    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Handle chat image upload
function handleChatImageUpload(file) {
    if (!file.type.match('image.*')) {
        addChatMessage('Please upload an image file (JPG, PNG, GIF, etc.)', 'ai');
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        // Add user message with image
        const messageDiv = document.createElement('div');
        messageDiv.className = 'chat-message ml-auto bg-primary text-white rounded-2xl rounded-tr-none p-3';
        messageDiv.innerHTML = `
            <div class="flex items-start space-x-2 flex-row-reverse space-x-reverse">
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="text-right">
                    <p class="font-medium text-blue-100 mb-1">You</p>
                    <img src="${e.target.result}" alt="Uploaded fish image" class="max-w-xs rounded-lg mb-2">
                    <p class="text-blue-100">Can you identify this fish?</p>
                </div>
            </div>
        `;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Simulate AI response
        setTimeout(() => {
            addChatMessage('Thanks for sharing the image! I can see this is a fish. For detailed classification with confidence scores, please use the main image analyzer above. It uses our advanced AI model to provide accurate species identification and detailed information.', 'ai');
        }, 1500);
    };
    reader.readAsDataURL(file);
}

// Initialize the application
document.addEventListener('DOMContentLoaded', () => {
    initEventListeners();

    // Add welcome pulse
    setTimeout(() => {
        if (!chatOpen && document.getElementById('chatbotToggleFixed')) {
            document.getElementById('chatbotToggleFixed').querySelector('span').classList.add('animate-pulse');
        }
    }, 3000);
});