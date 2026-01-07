<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-blue-600">
        <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1">
                <a href="{{ route('index') }}" class="-m-1.5 p-1.5">
                    <h2 class="text-white text-2xl font-bold">Project Management System</h2>
                </a>
            </div>

            <el-popover-group class="hidden lg:flex lg:gap-x-12 items-center">
                <a href="{{ route('index') }}" class="text-sm/6 font-semibold text-white">Home</a>
                <a href="{{ route('project.show') }}" class="text-sm/6 font-semibold text-white">Projects</a>
                <a href="{{ route('logout') }}" class="text-sm/6 font-semibold text-white"><button type="submit"
                        class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Logout</button></a>
            </el-popover-group>
        </nav>
    </header>

</body>

</html>
