<?php
/*
Template Name: FishAI App
Description: Page template that renders the FishAI image classifier UI
*/
get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <section class="text-center mb-12">
        <h2 class="text-4xl md:text-5xl font-bold text-dark mb-4">Discover Fish Species with AI</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Upload any fish image and our AI model will identify the species, provide confidence scores, and share fascinating details about the fish.</p>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left Column: Upload & Results -->
        <div class="space-y-8">
            <!-- Upload Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-2xl font-bold text-dark mb-6">Upload Fish Image</h3>
                
                <div id="dropZone" class="drop-zone rounded-xl p-8 text-center cursor-pointer mb-6">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-r from-blue-100 to-cyan-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-cloud-upload-alt text-primary text-3xl"></i>
                    </div>
                    <p class="text-lg font-medium text-dark mb-2">Drag & drop your fish image here</p>
                    <p class="text-gray-500 mb-4">or click to browse files</p>
                    <input type="file" id="imageUpload" accept="image/*" class="hidden">
                    <label for="imageUpload" class="inline-block bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors cursor-pointer">
                        <i class="fas fa-folder-open mr-2"></i>Browse Images
                    </label>
                    <p class="text-sm text-gray-400 mt-4">Supports JPG, PNG, WebP up to 10MB</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <i class="fas fa-bolt text-primary text-xl mb-2"></i>
                        <p class="font-medium">Fast Analysis</p>
                        <p class="text-sm text-gray-600">Results in seconds</p>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <i class="fas fa-database text-accent text-xl mb-2"></i>
                        <p class="font-medium">100+ Species</p>
                        <p class="text-sm text-gray-600">Extensive database</p>
                    </div>
                </div>
                
                <button id="analyzeBtn" class="w-full bg-gradient-to-r from-primary to-secondary text-white py-4 rounded-xl font-bold text-lg hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    <i class="fas fa-search mr-2"></i>Analyze Image
                </button>
            </div>

            <!-- Results Section -->
            <div id="resultsSection" class="bg-white rounded-2xl shadow-lg p-6 hidden">
                <h3 class="text-2xl font-bold text-dark mb-6">Analysis Results</h3>
                
                <div class="space-y-6">
                    <!-- Image Preview -->
                    <div class="text-center">
                        <img id="previewImage" src="" alt="Uploaded fish image" class="max-w-full h-64 object-contain mx-auto rounded-lg">
                    </div>
                    
                    <!-- Classification Result -->
                    <div class="result-card bg-gradient-to-r from-blue-50 to-cyan-50 p-6 rounded-xl">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-xl font-bold text-dark" id="fishName">Clownfish</h4>
                                <p class="text-gray-600" id="scientificName">Amphiprioninae</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-primary" id="confidenceScore">94.7%</div>
                                <div class="text-sm text-gray-500">Confidence</div>
                            </div>
                        </div>
                        
                        <!-- Confidence Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Confidence Level</span>
                                <span id="confidencePercent">94.7%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div id="confidenceBar" class="bg-gradient-to-r from-green-400 to-accent h-2.5 rounded-full" style="width: 94.7%"></div>
                            </div>
                        </div>
                        
                        <!-- Fish Details -->
                        <div class="space-y-3">
                            <h5 class="font-bold text-dark">About this Fish</h5>
                            <p id="fishDescription" class="text-gray-700">Clownfish are small, brightly colored fish known for their symbiotic relationship with sea anemones. They have a mucus layer that protects them from the anemone's sting. Found in warm waters of the Indian and Pacific Oceans.</p>
                            
                            <div class="grid grid-cols-2 gap-4 pt-4">
                                <div class="flex items-center">
                                    <i class="fas fa-ruler text-primary mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Average Size</p>
                                        <p class="font-medium" id="fishSize">10-18 cm</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-water text-primary mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Habitat</p>
                                        <p class="font-medium" id="fishHabitat">Coral Reefs</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-globe-americas text-primary mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Region</p>
                                        <p class="font-medium" id="fishRegion">Indo-Pacific</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-utensils text-primary mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-500">Diet</p>
                                        <p class="font-medium" id="fishDiet">Omnivore</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <button id="shareBtn" class="flex-1 bg-gray-100 text-dark py-3 rounded-lg hover:bg-gray-200 transition-colors flex items-center justify-center">
                            <i class="fas fa-share-alt mr-2"></i>Share Results
                        </button>
                        <button id="newAnalysisBtn" class="flex-1 bg-primary text-white py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                            <i class="fas fa-redo mr-2"></i>New Analysis
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Info & Examples -->
        <div class="space-y-8">
            <!-- How It Works -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-2xl font-bold text-dark mb-6">How It Works</h3>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <span class="font-bold">1</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">Upload Your Image</h4>
                            <p class="text-gray-600">Upload a clear photo of any fish. Our AI works best with well-lit, focused images.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <span class="font-bold">2</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">AI Analysis</h4>
                            <p class="text-gray-600">Our deep learning model analyzes visual features to identify the fish species.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <span class="font-bold">3</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-dark mb-1">Get Detailed Results</h4>
                            <p class="text-gray-600">Receive species identification, confidence score, and comprehensive fish information.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Example Images -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-2xl font-bold text-dark mb-6">Example Classifications</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <img src="https://picsum.photos/200/150?random=101" alt="Example fish 1" class="w-full h-32 object-cover rounded-lg mb-2">
                        <p class="font-medium">Betta Fish</p>
                        <p class="text-sm text-primary">98.2% confidence</p>
                    </div>
                    <div class="text-center">
                        <img src="https://picsum.photos/200/150?random=102" alt="Example fish 2" class="w-full h-32 object-cover rounded-lg mb-2">
                        <p class="font-medium">Goldfish</p>
                        <p class="text-sm text-primary">96.5% confidence</p>
                    </div>
                    <div class="text-center">
                        <img src="https://picsum.photos/200/150?random=103" alt="Example fish 3" class="w-full h-32 object-cover rounded-lg mb-2">
                        <p class="font-medium">Angelfish</p>
                        <p class="text-sm text-primary">92.8% confidence</p>
                    </div>
                    <div class="text-center">
                        <img src="https://picsum.photos/200/150?random=104" alt="Example fish 4" class="w-full h-32 object-cover rounded-lg mb-2">
                        <p class="font-medium">Guppy</p>
                        <p class="text-sm text-primary">95.1% confidence</p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-gradient-to-r from-primary to-secondary text-white rounded-2xl shadow-lg p-6">
                <h3 class="text-2xl font-bold mb-6">Our Database</h3>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-1">150+</div>
                        <p class="text-blue-100">Fish Species</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-1">50K+</div>
                        <p class="text-blue-100">Images Analyzed</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-1">98.5%</div>
                        <p class="text-blue-100">Accuracy Rate</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-1">2s</div>
                        <p class="text-blue-100">Avg. Response Time</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>