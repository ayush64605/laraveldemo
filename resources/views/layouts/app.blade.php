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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <style type="text/css">
        body {
            font-family: "Figtree", ui-sans-serif, system-ui, sans-serif;
        }

        .sidebar .active {
            background-color: #ff010113;
            color: red;
            border-left: 2px solid red;
            border-radius: 0px 5px 5px 0px;
        }
    </style>

</head>

<body>
    <div class="min-h-screen  flex">
        <aside class="border-r border-solid border-gray-200 w-2/15">
            <div class="border-b border-gray-300 flex justify-left h-fit gap-3 w-full p-3" style="margin-top: 4px">
                <p class="p-2 text-black font-bold">PMS</p>
            </div>
            <div class="p-4 sidebar">
                <a href="{{ route('dashboard') }}">
                    <div
                        class="flex gap-2 items-center text-gray-500 mt-4 text-sm p-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <h1>Dashboard</h1>
                    </div>
                </a>
                <a href="{{ route('project.show') }}">
                    <div
                        class="flex gap-2 items-center text-gray-500 mt-2 text-sm p-2 {{ request()->is('project/*') ? 'active' : '' }}">
                        <i class="fa-solid fa-diagram-project"></i>
                        <h1>Projects</h1>
                    </div>
                </a>
                @if (Auth::user() && Auth::user()->role == 'admin')
                    <a href="{{ route('employee.show') }}">
                        <div
                            class="flex gap-2 items-center text-gray-500 mt-2 text-sm p-2 {{ request()->is('employee/*') ? 'active' : '' }}">
                            <i class="fa-solid fa-briefcase"></i>
                            <h1>Employees</h1>
                        </div>
                    </a>
                    <a href="{{ route('user.show') }}">
                        <div
                            class="flex gap-2 items-center text-gray-500 mt-2 text-sm p-2 {{ request()->is('user/*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i>
                            <h1>Users</h1>
                        </div>
                    </a>
                    <a href="{{ route('tag.show') }}">
                        <div
                            class="flex gap-2 items-center text-gray-500 mt-2 text-sm p-2 {{ request()->is('tag/*') ? 'active' : '' }}">
                            <i class="fa-solid fa-tag"></i>
                            <h1>Tags</h1>
                        </div>
                    </a>
                @endif
                <a href="{{ route('general') }}">
                    <div
                        class="flex gap-2 items-center text-gray-500 text-sm mt-2 p-2 {{ request()->is('setting/*') ? 'active' : '' }}">
                        <i class="fa fa-gear" aria-hidden="true"></i>
                        <h1>Settings</h1>
                    </div>
                </a>
            </div>
        </aside>

        <div class="flex flex-col flex-1">

            <header class="border-b border-gray-300 flex justify-end h-fit gap-3 w-full p-3">
                @if (Auth::user())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
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

            <main class="p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>


</html>
