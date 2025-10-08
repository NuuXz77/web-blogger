@props(['title' => 'Web Blogger'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="icon" type="image/png" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="manifest" href="/site.webmanifest">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --secondary: #8b5cf6;
            --secondary-dark: #7c3aed;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(180deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { 
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.3),
                           0 0 40px rgba(59, 130, 246, 0.1);
            }
            50% { 
                box-shadow: 0 0 30px rgba(59, 130, 246, 0.5),
                           0 0 60px rgba(59, 130, 246, 0.2);
            }
        }

        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .float-animation {
            animation: float 8s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .slide-in {
            animation: slide-in 0.6s ease-out;
        }

        /* Glass Morphism */
        .glass-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25),
                       0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        /* Form Inputs */
        .form-input {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            /* border: 2px solid var(--gray-200); */
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:focus {
            background: rgba(255, 255, 255, 1) !important;
            /* border-color: var(--primary); */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1),
                       0 10px 25px -5px rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
        }

        .form-input.error {
            border-color: var(--error);
            background: rgba(254, 242, 242, 0.9) !important;
        }

        /* Input Icons */
        .input-icon {
            color: var(--gray-400);
            transition: color 0.3s ease;
        }

        .form-input:focus + .input-icon,
        .form-input:focus ~ .input-icon {
            color: var(--primary);
        }

        /* Password Toggle */
        .password-toggle {
            transition: all 0.3s ease;
            cursor: pointer;
            background: none;
            border: none;
            outline: none;
            padding: 0.5rem;
            border-radius: 0.5rem;
        }

        .password-toggle:hover {
            color: var(--primary) !important;
            background: rgba(59, 130, 246, 0.1);
            transform: scale(1.1);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            background-size: 200% 200%;
            animation: gradient-shift 4s ease infinite;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.5);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        /* Alert Messages */
        .alert {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--gray-200);
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .glass-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-100 relative overflow-x-hidden">
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="text-center">
            <div class="loading-spinner mx-auto mb-4"></div>
            <p class="text-gray-600 font-medium">Memuat...</p>
        </div>
    </div>

    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Floating Shapes -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-gradient-to-br from-blue-200 to-blue-300 rounded-full opacity-20 float-animation"></div>
        <div class="absolute top-1/4 right-20 w-16 h-16 bg-gradient-to-br from-purple-200 to-purple-300 rounded-full opacity-25 float-animation" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-gradient-to-br from-indigo-200 to-indigo-300 rounded-full opacity-20 float-animation" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-10 right-10 w-12 h-12 bg-gradient-to-br from-pink-200 to-pink-300 rounded-full opacity-25 float-animation" style="animation-delay: 3s;"></div>
        
        <!-- Gradient Orbs -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full opacity-10 blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full opacity-10 blur-3xl"></div>
        
        <!-- Additional decorative elements -->
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full">
            <div class="absolute top-20 left-20 w-2 h-2 bg-blue-400 rounded-full opacity-40 animate-ping"></div>
            <div class="absolute bottom-40 right-40 w-2 h-2 bg-purple-400 rounded-full opacity-40 animate-ping" style="animation-delay: 1s;"></div>
            <div class="absolute top-40 right-20 w-1 h-1 bg-indigo-400 rounded-full opacity-50 animate-pulse"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="slide-in">
                {{$slot}}
            </div>
        </div>
    </div>

    <script>
        // Configuration
        const CONFIG = {
            animationDuration: 300,
            loadingDelay: 100
        };

        // Utility Functions
        function showLoading() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.classList.add('show');
            }
        }

        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                setTimeout(() => {
                    overlay.classList.remove('show');
                }, CONFIG.loadingDelay);
            }
        }

        // Password Toggle Functionality
        function setupPasswordToggle() {
            document.querySelectorAll('.password-toggle').forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const inputWrapper = this.closest('.relative');
                    const passwordInput = inputWrapper.querySelector('input[type="password"], input[type="text"]');
                    
                    if (passwordInput) {
                        const isPassword = passwordInput.getAttribute('type') === 'password';
                        const newType = isPassword ? 'text' : 'password';
                        passwordInput.setAttribute('type', newType);
                        
                        // Toggle icon with animation
                        const icon = this.querySelector('i');
                        if (icon) {
                            icon.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                if (isPassword) {
                                    icon.classList.remove('fa-eye');
                                    icon.classList.add('fa-eye-slash');
                                    this.setAttribute('title', 'Sembunyikan password');
                                } else {
                                    icon.classList.remove('fa-eye-slash');
                                    icon.classList.add('fa-eye');
                                    this.setAttribute('title', 'Tampilkan password');
                                }
                                icon.style.transform = 'scale(1)';
                            }, 150);
                        }
                    }
                });
            });
        }

        // Enhanced Input Effects
        function setupInputEffects() {
            document.querySelectorAll('input').forEach(input => {
                // Focus effects
                input.addEventListener('focus', function() {
                    // this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-50');
                    
                    // Animate icon
                    const icon = this.parentElement.querySelector('.input-icon i');
                    if (icon) {
                        icon.style.transform = 'scale(1.1)';
                        icon.style.color = 'var(--primary)';
                    }
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-50');
                    
                    // Reset icon
                    const icon = this.parentElement.querySelector('.input-icon i');
                    if (icon) {
                        icon.style.transform = 'scale(1)';
                        icon.style.color = 'var(--gray-400)';
                    }
                });

                // Real-time validation feedback
                input.addEventListener('input', function() {
                    this.classList.remove('error');
                    const errorMsg = this.parentElement.parentElement.querySelector('.text-red-600');
                    if (errorMsg) {
                        errorMsg.style.opacity = '0';
                        setTimeout(() => errorMsg.remove(), CONFIG.animationDuration);
                    }
                });
            });
        }

        // Enhanced Form Validation
        function setupFormValidation() {
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    let isValid = true;
                    
                    // Validate required fields
                    const requiredInputs = this.querySelectorAll('input[required]');
                    requiredInputs.forEach(input => {
                        if (!input.value.trim()) {
                            input.classList.add('error');
                            isValid = false;
                            

                            // Add shake animation
                            input.style.animation = 'shake 0.5s ease-in-out';
                            setTimeout(() => {
                                input.style.animation = '';
                            }, 500);
                        }
                    });

                    // Email validation
                    const emailInput = this.querySelector('input[type="email"]');
                    if (emailInput && emailInput.value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(emailInput.value)) {
                            emailInput.classList.add('error');
                            isValid = false;
                        }
                    }

                    // Password confirmation validation
                    const password = this.querySelector('input[name="password"]');
                    const passwordConfirm = this.querySelector('input[name="password_confirmation"]');
                    if (password && passwordConfirm && password.value !== passwordConfirm.value) {
                        passwordConfirm.classList.add('error');
                        isValid = false;
                    }

                    if (isValid) {
                        showLoading();
                    } else {
                        e.preventDefault();
                    }
                });
            });
        }

        // Add shake animation
        const shakeKeyframes = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;
        const style = document.createElement('style');
        style.textContent = shakeKeyframes;
        document.head.appendChild(style);

        // Auto-hide alerts
        function setupAlerts() {
            document.querySelectorAll('.alert').forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), CONFIG.animationDuration);
                }, 5000);
            });
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading initially
            showLoading();
            
            // Initialize components
            setupPasswordToggle();
            setupInputEffects();
            setupFormValidation();
            setupAlerts();

            // Hide loading and show content
            setTimeout(() => {
                hideLoading();
                document.body.style.opacity = '1';
            }, CONFIG.loadingDelay);
        });

        // Handle page transitions
        window.addEventListener('beforeunload', function() {
            showLoading();
        });
    </script>
</body>
</html>