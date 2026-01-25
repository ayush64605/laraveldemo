<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $setting->meta_title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <meta name="description" content="{{ $setting->meta_description }}">
    <meta name="keywords" content="{{ $setting->meta_keywords }}">

    <link rel="shortcut icon"
        href="{{ $setting->favicon ? asset('/storage/' . $setting->favicon) : asset('assets/images/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php $bg = $themesetting->theme_color . '1a'; @endphp

    <style>
        :root {
            --primary-theme: {{ $themesetting->theme_color }};
        }

        .sidebar .active {
            color: var(--primary-theme);
            border-left: 3px solid var(--primary-theme);
            background-color: {{ $bg }};
        }
    </style>
</head>

@php $user = Auth::user(); @endphp

<body class="bg-gray-50 font-figtree">

    <div class="flex min-h-screen overflow-hidden">

        <!-- Mobile Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:static inset-y-0 left-0 z-50 w-72 lg:w-64 bg-white border-r
                  transform -translate-x-full lg:translate-x-0 transition-transform duration-300">

            <!-- Logo -->
            <div class="h-16 flex items-center gap-3 px-4 border-b">
                <img src="{{ $setting->site_logo ? asset('/storage/' . $setting->site_logo) : asset('assets/images/logo.png') }}"
                    class="w-10 h-10 object-contain" alt="">
                <span class="font-bold text-lg truncate">{{ $setting->site_name }}</span>
            </div>

            @if ($user)
                <nav class="flex-1 px-3 py-4 space-y-1 sidebar overflow-y-auto">
                    @php
                        $navItem = 'flex items-center gap-3 px-4 py-2 text-sm rounded-md transition';
                        $inactive = 'text-gray-600 hover:bg-gray-100';
                    @endphp

                    <a href="{{ route('dashboard') }}"
                        class="{{ $navItem }} {{ request()->routeIs('dashboard') ? 'active' : $inactive }}">
                        <i class="fa fa-home"></i>
                        Dashboard
                    </a>

                    @can('project.view')
                        <a href="{{ route('project.show') }}"
                            class="{{ $navItem }} {{ request()->is('project/*') ? 'active' : $inactive }}">
                            <i class="fa-solid fa-diagram-project"></i>
                            Projects
                        </a>
                    @endcan

                    @can('employee.view')
                        <a href="{{ route('employee.show') }}"
                            class="{{ $navItem }} {{ request()->is('employee/*') ? 'active' : $inactive }}">
                            <i class="fa-solid fa-briefcase"></i>
                            Employees
                        </a>
                    @endcan

                    @can('role.view')
                        <a href="{{ route('role.show') }}"
                            class="{{ $navItem }} {{ request()->is('role/*') ? 'active' : $inactive }}">
                            <i class="fa-solid fa-building-shield"></i>
                            Roles
                        </a>
                    @endcan

                    @can('user.view')
                        <a href="{{ route('user.show') }}"
                            class="{{ $navItem }} {{ request()->is('user/*') ? 'active' : $inactive }}">
                            <i class="fa-solid fa-users"></i>
                            Users
                        </a>
                    @endcan

                    @can('tags.view')
                        <a href="{{ route('tag.show') }}"
                            class="{{ $navItem }} {{ request()->is('tag/*') ? 'active' : $inactive }}">
                            <i class="fa-solid fa-tag"></i>
                            Tags
                        </a>
                    @endcan

                    @can('setting.view')
                        <a href="{{ route('setting.general') }}"
                            class="{{ $navItem }} {{ request()->is('setting/*') ? 'active' : $inactive }}">
                            <i class="fa fa-gear"></i>
                            Settings
                        </a>
                    @endcan
                </nav>
            @endif
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1">

            <!-- Header -->
            <header class="sticky top-0 z-30 bg-white border-b h-16 px-4 flex items-center justify-between">

                <!-- Mobile Menu Button -->
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-600 hover:text-black">
                    <i class="fa fa-bars text-xl"></i>
                </button>

                <div class="flex items-center gap-3 ml-auto">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-red-600">
                                Logout
                            </button>
                        </form>

                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image->url) : asset('assets/images/user.png') }}"
                            class="w-9 h-9 rounded-full object-cover border" alt="user">
                    @endauth
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 overflow-y-auto">
                {{ $slot }}
            </main>

        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>

</html>
