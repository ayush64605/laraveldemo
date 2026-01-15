<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-indigo-600">
        <nav aria-label="Global" class="mx-auto flex max-w-8xl items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1">
                <a href="{{ route('index') }}" class="-m-1.5 p-1.5">
                    <h2 class="text-white text-2xl font-bold">Project Management System</h2>
                </a>
            </div>

            @if (Auth::user())
                <div class="flex lg:flex-1">
                    <el-popover-group class="hidden lg:flex lg:gap-x-12 items-center">
                        <a href="{{ route('index') }}" class="text-sm/6 font-semibold text-white">Home</a>
                        <a href="{{ route('project.show') }}" class="text-sm/6 font-semibold text-white">Projects</a>
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('employee.show') }}"
                                class="text-sm/6 font-semibold text-white">Employees</a>
                            <a href="{{ route('user.show') }}" class="text-sm/6 font-semibold text-white">Users</a>
                        @endif
                        <a href="{{ route('logout') }}"> <x-button type="button" color="bg-orange-600" text="Logout"
                                icon="sign-out" /> </a>
                    </el-popover-group>
                </div>
            @endif

            @if (Auth::user())
                <div class="flex lg:flex-1 justify-end items-center">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image->url) : asset('assets/images/user.png') }}"
                        alt="" width="40">&nbsp;
                    <p class="text-sm/6 font-semibold text-white">{{ Auth::user()->name }}</p>
                </div>
            @else
                <div class="flex lg:flex-1 justify-end items-center">
                    <p class="text-sm/6 font-semibold text-white"> Welcome, {{ session()->get('employeedata')->name }}
                    </p>
                </div>
                &nbsp;&nbsp;
                <a href="{{ route('employee.logout') }}"> <x-button type="button" color="bg-orange-600" text="Logout"
                        icon="sign-out" /> </a>
            @endif
        </nav>
    </header>

</body>

</html>
