<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#ffffff',
                        card: '#ffffff',
                        'card-foreground': '#164e63',
                        border: '#e2e8f0',
                        input: '#f8fafc',
                        foreground: '#334155',
                        'muted-foreground': '#64748b',
                        primary: '#164e63',
                        'primary-foreground': '#ffffff',
                        accent: '#84cc16',
                        destructive: '#ef4444',
                        ring: '#164e63'
                    },
                    fontFamily: {
                        'black': ['Montserrat', 'sans-serif'],
                        'sans': ['Open Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-background flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-card rounded-lg shadow-lg p-8 border border-border">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-black text-card-foreground mb-2">Welcome Back</h1>
                <p class="text-muted-foreground">Sign in to your account to continue</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Styled Error Container -->
                <div id="error-container" class="bg-destructive/10 border border-destructive/20 rounded-lg p-4 {{-- Hide by default, Blade will show it --}} @if(!$errors->any()) hidden @endif">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-destructive mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-destructive mb-1">Login Failed</h3>
                            <ul id="error-list" class="text-sm text-destructive list-disc list-inside space-y-1">
                                <!-- Laravel errors will be populated here by Blade -->
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-foreground">
                        Email Address
                    </label>
                    <div class="relative">
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            required 
                            autofocus
                            {{-- Repopulate email on error --}}
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 bg-input border border-border rounded-lg focus:ring-2 focus:ring-ring focus:border-transparent transition-colors placeholder-muted-foreground"
                            placeholder="Enter your email address"
                        >
                        <svg class="absolute right-3 top-3.5 w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-foreground">
                        Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-3 bg-input border border-border rounded-lg focus:ring-2 focus:ring-ring focus:border-transparent transition-colors placeholder-muted-foreground"
                            placeholder="Enter your password"
                        >
                        <svg class="absolute right-3 top-3.5 w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-primary bg-input border-border rounded focus:ring-ring focus:ring-2">
                        <span class="ml-2 text-sm text-foreground">Remember me</span>
                    </label>
                    <a href="/forgot-password" class="text-sm text-accent hover:text-accent/80 font-medium transition-colors">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-primary hover:bg-primary/90 text-primary-foreground font-medium py-3 px-4 rounded-lg transition-colors focus:ring-2 focus:ring-ring focus:ring-offset-2 focus:outline-none"
                >
                    Sign In
                </button>

                <!-- Sign Up Link -->
                <div class="text-center pt-4 border-t border-border">
                    <p class="text-sm text-muted-foreground">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-accent hover:text-accent/80 font-medium transition-colors">
                            Sign up here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    {{-- Client-side validation script is no longer needed for backend errors --}}
    {{-- You can keep it for instant feedback, but the Blade logic handles server errors --}}
</body>
</html>
