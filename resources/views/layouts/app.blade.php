<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    {{--
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style type="text/css">
        body {
            font-family: "Figtree", ui-sans-serif, system-ui, sans-serif;
        }
    </style>

</head>

<body>
    <div class="min-h-screen  flex">
        <aside class="border-r border-gray-200 w-1/5 min-h-screen flex flex-col">
            <div class="border-b border-gray-300 flex items-center h-16 px-4">
                <p class="text-black font-bold text-lg">PMS</p>
            </div>

            <nav class="flex-1 p-4 space-y-2 sidebar">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 p-3 text-sm rounded
           {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-600 border-l-2 border-red-600' : 'text-gray-500 hover:bg-gray-100' }}">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('project.show') }}"
                    class="flex items-center gap-2 p-3 text-sm rounded
           {{ request()->is('project/*') ? 'bg-red-50 text-red-600 border-l-2 border-red-600' : 'text-gray-500 hover:bg-gray-100' }}">
                    <i class="fa-solid fa-diagram-project"></i>
                    <span>Projects</span>
                </a>

                @if (Auth::user() && Auth::user()->role === 'admin')
                    <a href="{{ route('employee.show') }}"
                        class="flex items-center gap-2 p-3 text-sm rounded
                           {{ request()->is('employee/*') ? 'bg-red-50 text-red-600 border-l-2 border-red-600' : 'text-gray-500 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-briefcase"></i>
                        <span>Employees</span>
                    </a>

                    <a href="{{ route('user.show') }}"
                        class="flex items-center gap-2 p-3 text-sm rounded
                           {{ request()->is('user/*') ? 'bg-red-50 text-red-600 border-l-2 border-red-600' : 'text-gray-500 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Users</span>
                    </a>

                    <a href="{{ route('tag.show') }}"
                        class="flex items-center gap-2 p-3 text-sm rounded
                           {{ request()->is('tag/*') ? 'bg-red-50 text-red-600 border-l-2 border-red-600' : 'text-gray-500 hover:bg-gray-100' }}">
                        <i class="fa-solid fa-tag"></i>
                        <span>Tags</span>
                    </a>
                @endif

                <a href="{{ route('setting.general') }}"
                    class="flex items-center gap-2 p-3 text-sm rounded
           {{ request()->is('setting/*') ? 'bg-red-50 text-red-600 border-l-2 border-red-600' : 'text-gray-500 hover:bg-gray-100' }}">
                    <i class="fa fa-gear"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </aside>


        <div class="flex flex-col flex-1">

            <header class="border-b border-gray-300 flex justify-end h-fit gap-3 w-full p-3">
                @if (Auth::user())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image->url) : asset('assets/images/user.png') }}"
                        alt="" width="40">
                @else
                    <a href="{{ route('employee.logout') }}"><button>Logout</button></a>
                @endif
            </header>

            <main class="p-6 ">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>


</html>