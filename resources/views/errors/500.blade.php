<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error | Web Blogger</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg w-full space-y-8 text-center">
            <!-- 500 Icon -->
            <div class="flex justify-center">
                <div class="relative">
                    <div class="w-32 h-32 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center shadow-2xl">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <!-- Floating elements -->
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-400 rounded-full animate-bounce"></div>
                    <div class="absolute -bottom-2 -left-2 w-4 h-4 bg-red-400 rounded-full animate-ping"></div>
                </div>
            </div>

            <!-- Error Content -->
            <div class="space-y-4">
                <h1 class="text-9xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                    500
                </h1>
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                    Internal Server Error
                </h2>
                <p class="text-lg text-gray-600 max-w-md mx-auto">
                    Something went wrong on our end. We're working to fix this issue. Please try again later.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <button onclick="location.reload()" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transform hover:scale-105 transition duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Try Again
                </button>

                <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Back to Home
                </a>
            </div>

            @auth
                <div class="flex justify-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm text-primary hover:text-blue-700 transition duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Go to Dashboard
                    </a>
                </div>
            @endauth

            <!-- Technical Details (for development) -->
            @if(config('app.debug') && isset($exception))
                <div class="mt-8 p-4 bg-red-50 rounded-lg border border-red-200 text-left">
                    <h3 class="text-lg font-medium text-red-900 mb-2">Debug Information</h3>
                    <div class="text-sm text-red-800 space-y-1">
                        <p><strong>Error:</strong> {{ $exception->getMessage() }}</p>
                        <p><strong>File:</strong> {{ $exception->getFile() }}</p>
                        <p><strong>Line:</strong> {{ $exception->getLine() }}</p>
                    </div>
                </div>
            @endif

            <!-- What happened -->
            <div class="mt-8 p-6 bg-white rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-3">What happened?</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        A server error occurred while processing your request
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Our team has been automatically notified
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Try refreshing the page or come back later
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Web Blogger. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Background Animation -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-2 h-2 bg-orange-300 rounded-full animate-ping opacity-75"></div>
            <div class="absolute top-40 right-20 w-3 h-3 bg-red-300 rounded-full animate-bounce opacity-75"></div>
            <div class="absolute bottom-40 left-20 w-2 h-2 bg-yellow-300 rounded-full animate-pulse opacity-75"></div>
            <div class="absolute bottom-20 right-10 w-4 h-4 bg-orange-300 rounded-full animate-ping opacity-75"></div>
        </div>
    </div>
</body>
</html>