<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="flex justify-center gap-4 mt-40">
        <div class="border-2 border-solid rounded-lg border-stone-200 p-15 shadow-xl">
            <form class="w-100" action="{{ route('registerprocess') }}" method="POST">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-4">
                        <h2 class="text-lg/10 font-semibold text-gray-900">Register</h2>
                        <p class="mt-1 text-sm/6 text-gray-600">Please Enter Details To Register</p>

                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm/6 font-medium text-gray-900">Name<span
                                        class="text-red-600">*</span></label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="text" type="text" name="name"
                                            placeholder="Enter Your Name"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('name')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm/6 font-medium text-gray-900">Email<span
                                        class="text-red-600">*</span></label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="text" type="text" name="email"
                                            placeholder="Enter Your Email"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('email')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm/6 font-medium text-gray-900">Role<span
                                        class="text-red-600">*</span></label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <select name="role"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6">
                                            <option value="">Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                    @error('role')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm/6 font-medium text-gray-900">Password</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="password" type="password" name="password"
                                            placeholder="Enter Password"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('password')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('login') }}">
                            <p class="mt-4 text-sm text-blue-600">Already have an account? Login</p>
                        </a>

                        @if (session('error'))
                            <x-alert type="error" :message="session('error')" />
                        @endif

                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
