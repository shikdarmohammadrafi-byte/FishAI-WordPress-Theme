    <!-- Footer -->
    <footer class="bg-dark text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-lg flex items-center justify-center">
                            <i class="fas fa-fish text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold">Fish<span class="text-blue-300">AI</span></h3>
                    </div>
                    <p class="text-gray-400">Advanced AI-powered fish classification and identification platform.</p>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="javascript:void(0)" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="javascript:void(0)" class="text-gray-400 hover:text-white transition-colors">How It Works</a></li>
                        <li><a href="javascript:void(0)" class="text-gray-400 hover:text-white transition-colors">Fish Database</a></li>
                        <li><a href="javascript:void(0)" class="text-gray-400 hover:text-white transition-colors">API Documentation</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="javascript:void(0)" class="text-gray-400 hover:text-white transition-colors">Research Papers</a></li>
                        <li><a href="javascript:void(0)" class="text-gray-400 hover:text-white transition-colors">Dataset</a></li>
                        <li><a href="javascript:void(0)" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="javascript:void(0)" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>support@fishai.com</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-phone mr-2"></i>
                            <span>+1 (555) 123-4567</span>
                        </li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="javascript:void(0)" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="javascript:void(0)" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="javascript:void(0)" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> FishAI. All rights reserved. This is a demonstration interface.</p>
            </div>
        </div>
    </footer>

    <!-- Chatbot Popup -->
    <div id="chatbotPopup" class="fixed bottom-24 right-6 w-96 bg-white rounded-2xl shadow-2xl z-50 hidden transform transition-all duration-300">
        <!-- Chatbot Header -->
        <div class="bg-gradient-to-r from-primary to-secondary text-white p-4 rounded-t-2xl flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-robot text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg">FishAI Assistant</h3>
                    <p class="text-blue-100 text-sm">Online - Ask me about fish!</p>
                </div>
            </div>
            <button id="closeChatbot" class="text-white hover:text-blue-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Chat Messages -->
        <div id="chatMessages" class="h-96 overflow-y-auto p-4 space-y-4">
            <!-- Welcome Message -->
            <div class="chat-message bg-blue-50 rounded-2xl rounded-tl-none p-4">
                <div class="flex items-start space-x-2">
                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-robot text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="font-medium text-dark mb-1">FishAI Assistant</p>
                        <p class="text-gray-700">Hello! I'm your fish expert assistant. You can:</p>
                        <ul class="list-disc pl-4 text-gray-700 mt-1 space-y-1">
                            <li>Upload fish images for identification</li>
                            <li>Ask questions about fish species</li>
                            <li>Get information about fish habitats and behavior</li>
                            <li>Learn about fish conservation</li>
                        </ul>
                        <p class="text-gray-700 mt-2">How can I help you today?</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="border-t p-4">
            <div class="flex space-x-2">
                <div class="flex-1 relative">
                    <input type="text" id="chatInput" placeholder="Type your question about fish..." class="w-full border rounded-xl py-3 px-4 pr-12 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button id="uploadImageChat" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary">
                        <i class="fas fa-image"></i>
                    </button>
                    <input type="file" id="chatImageUpload" accept="image/*" class="hidden">
                </div>
                <button id="sendMessage" class="bg-primary text-white px-6 rounded-xl hover:bg-blue-700 transition-colors">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <p class="text-xs text-gray-400 mt-2">You can also drag & drop images directly into the chat</p>
        </div>
    </div>

    <!-- Chatbot Toggle Button -->
    <button id="chatbotToggleFixed" class="fixed bottom-6 right-6 w-14 h-14 bg-gradient-to-r from-primary to-secondary text-white rounded-full shadow-lg hover:shadow-xl transition-shadow flex items-center justify-center chatbot-toggle">
        <i class="fas fa-robot text-xl"></i>
        <span class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse">1</span>
    </button>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 text-center">
            <div class="w-20 h-20 mx-auto mb-6">
                <div class="relative w-full h-full">
                    <div class="absolute inset-0 border-4 border-blue-200 rounded-full"></div>
                    <div class="absolute inset-0 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-fish text-primary text-2xl"></i>
                    </div>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-dark mb-2">Analyzing Image</h3>
            <p class="text-gray-600 mb-4">Our AI is identifying the fish species...</p>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="loadingProgress" class="bg-gradient-to-r from-primary to-secondary h-2 rounded-full w-0 transition-all duration-1000"></div>
            </div>
            <p id="loadingStatus" class="text-sm text-gray-500 mt-2">Processing image features...</p>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
