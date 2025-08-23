<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-background flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-serif font-bold text-foreground mb-2">Create Your Account</h1>
            <p class="text-muted-foreground">Join us today and get started</p>
        </div>

        <!-- Registration Form -->
        <div class="bg-card rounded-lg shadow-lg border border-border p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Display All Errors at the Top -->
                @if ($errors->any())
                    <div class="bg-destructive/10 border border-destructive/20 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-destructive mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <h3 class="text-sm font-medium text-destructive">Please fix the following errors:</h3>
                        </div>
                        <ul class="text-sm text-destructive space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Name Field -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-foreground">
                        Full Name <span class="text-destructive">*</span>
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus
                        class="w-full px-4 py-3 bg-input border border-border rounded-lg focus:ring-2 focus:ring-ring focus:border-transparent transition-colors placeholder:text-muted-foreground"
                        placeholder="Enter your full name"
                    >
                </div>

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-foreground">
                        Email Address <span class="text-destructive">*</span>
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required
                        class="w-full px-4 py-3 bg-input border border-border rounded-lg focus:ring-2 focus:ring-ring focus:border-transparent transition-colors placeholder:text-muted-foreground"
                        placeholder="Enter your email address"
                    >
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-foreground">
                        Password <span class="text-destructive">*</span>
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required
                        class="w-full px-4 py-3 bg-input border border-border rounded-lg focus:ring-2 focus:ring-ring focus:border-transparent transition-colors placeholder:text-muted-foreground"
                        placeholder="Create a secure password"
                    >
                    <p class="text-xs text-muted-foreground">Password must be at least 8 characters long</p>
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-foreground">
                        Confirm Password <span class="text-destructive">*</span>
                    </label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required
                        class="w-full px-4 py-3 bg-input border border-border rounded-lg focus:ring-2 focus:ring-ring focus:border-transparent transition-colors placeholder:text-muted-foreground"
                        placeholder="Confirm your password"
                    >
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-primary hover:bg-primary/90 text-primary-foreground font-medium py-3 px-4 rounded-lg transition-colors focus:ring-2 focus:ring-ring focus:ring-offset-2 focus:ring-offset-background"
                >
                    Create Account
                </button>

                <!-- Sign In Link -->
                <div class="text-center pt-4 border-t border-border">
                    <p class="text-sm text-muted-foreground">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary hover:text-primary/80 font-medium transition-colors">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-xs text-muted-foreground">
                By creating an account, you agree to our 
                <a href="#" class="text-primary hover:text-primary/80 transition-colors">Terms of Service</a> 
                and 
                <a href="#" class="text-primary hover:text-primary/80 transition-colors">Privacy Policy</a>
            </p>
        </div>
    </div>
</body>
</html>
