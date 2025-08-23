<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Geist+Sans:wght@400;600;900&family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#ffffff',
                        foreground: '#475569',
                        card: '#f1f5f9',
                        'card-foreground': '#475569',
                        primary: '#059669',
                        'primary-foreground': '#ffffff',
                        secondary: '#f1f5f9',
                        'secondary-foreground': '#475569',
                        muted: '#f9fafb',
                        'muted-foreground': '#475569',
                        accent: '#10b981',
                        'accent-foreground': '#ffffff',
                        destructive: '#be123c',
                        'destructive-foreground': '#ffffff',
                        border: '#e5e7eb',
                        sidebar: '#f1f5f9',
                        'sidebar-foreground': '#475569',
                        'sidebar-primary': '#059669',
                        'sidebar-primary-foreground': '#ffffff',
                        'sidebar-accent': '#10b981',
                        'sidebar-accent-foreground': '#ffffff',
                        'sidebar-border': '#e5e7eb'
                    },
                    fontFamily: {
                        'sans': ['Manrope', 'ui-sans-serif', 'system-ui'],
                        'serif': ['Geist Sans', 'ui-serif', 'Georgia']
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full bg-background font-sans">
    <div class="flex h-full">
        <!-- Mobile menu button -->
        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button id="mobile-menu-button" class="bg-primary text-primary-foreground p-2 rounded-md shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-sidebar border-r border-sidebar-border transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:static lg:inset-0">
            <div class="flex flex-col h-full">
                <!-- User Profile Section -->
                <div class="p-6 border-b border-sidebar-border">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif font-black text-sidebar-foreground">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-muted-foreground">Buyer</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 p-4 space-y-2">
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-sidebar-primary text-sidebar-primary-foreground">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sidebar-foreground hover:bg-secondary hover:text-secondary-foreground transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                        </svg>
                        <span class="font-medium">My Orders</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sidebar-foreground hover:bg-secondary hover:text-secondary-foreground transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span class="font-medium">My Products</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sidebar-foreground hover:bg-secondary hover:text-secondary-foreground transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="font-medium">Sales Analytics</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sidebar-foreground hover:bg-secondary hover:text-secondary-foreground transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <span class="font-medium">Manage Users</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sidebar-foreground hover:bg-secondary hover:text-secondary-foreground transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Account Settings</span>
                    </a>
                </nav>

                <!-- Logout Button -->
                <div class="p-4 border-t border-sidebar-border">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 w-full px-3 py-2 rounded-lg text-destructive hover:bg-destructive hover:text-destructive-foreground transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-medium">Log Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-0">
            <div class="p-6 lg:p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-serif font-black text-foreground">Dashboard Overview</h1>
                </div>

                <!-- Key Metrics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-card rounded-lg p-6 shadow-sm border border-border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-muted-foreground">Orders Placed</p>
                                <p class="text-3xl font-serif font-black text-card-foreground">12</p>
                            </div>
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M8 11v6h8v-6M8 11H6a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2v-6a2 2 0 00-2-2h-2"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-card rounded-lg p-6 shadow-sm border border-border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-muted-foreground">Items in Wishlist</p>
                                <p class="text-3xl font-serif font-black text-card-foreground">5</p>
                            </div>
                            <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-card rounded-lg p-6 shadow-sm border border-border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-muted-foreground">Total Spent</p>
                                <p class="text-3xl font-serif font-black text-card-foreground">$450.75</p>
                            </div>
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Recent Orders -->
                    <div class="bg-card rounded-lg p-6 shadow-sm border border-border">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-serif font-black text-card-foreground">Recent Orders</h2>
                            <a href="#" class="text-primary hover:text-primary/80 font-medium text-sm">View All Orders</a>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-border">
                                        <th class="text-left py-3 text-sm font-medium text-muted-foreground">Order ID</th>
                                        <th class="text-left py-3 text-sm font-medium text-muted-foreground">Date</th>
                                        <th class="text-left py-3 text-sm font-medium text-muted-foreground">Total</th>
                                        <th class="text-left py-3 text-sm font-medium text-muted-foreground">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border">
                                    <tr>
                                        <td class="py-3 text-sm font-medium text-card-foreground">#ORD-001</td>
                                        <td class="py-3 text-sm text-muted-foreground">Jan 15, 2024</td>
                                        <td class="py-3 text-sm font-medium text-card-foreground">$89.99</td>
                                        <td class="py-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent/10 text-accent">
                                                Shipped
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 text-sm font-medium text-card-foreground">#ORD-002</td>
                                        <td class="py-3 text-sm text-muted-foreground">Jan 12, 2024</td>
                                        <td class="py-3 text-sm font-medium text-card-foreground">$156.50</td>
                                        <td class="py-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                                Processing
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 text-sm font-medium text-card-foreground">#ORD-003</td>
                                        <td class="py-3 text-sm text-muted-foreground">Jan 10, 2024</td>
                                        <td class="py-3 text-sm font-medium text-card-foreground">$204.26</td>
                                        <td class="py-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent/10 text-accent">
                                                Delivered
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Sales Summary Placeholder -->
                    <div class="bg-card rounded-lg p-6 shadow-sm border border-border">
                        <h2 class="text-xl font-serif font-black text-card-foreground mb-6">Sales Summary</h2>
                        <div class="flex items-center justify-center h-48 bg-muted rounded-lg">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-muted-foreground mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <p class="text-muted-foreground font-medium">Sales analytics will be displayed here for sellers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        });

        mobileOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        });
    </script>
</body>
</html>
