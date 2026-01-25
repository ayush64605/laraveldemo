    <style>
        .nav-link .active {
            color: {{ $themesetting->theme_color }}
        }
    </style>
    <div class="p-4 border h-fit border-solid rounded-md border-white-200 bg-white nav-link">
        <a href="{{ route('setting.general') }}">
            <div
                class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/general') ? 'active' : '' }}">
                <h1>General Settings</h1>
            </div>
        </a>
        <a href="{{ route('setting.theme') }}">
            <div
                class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/theme') ? 'active' : '' }}">
                <h1>Theme Setting</h1>
            </div>
        </a>
        <a href="{{ route('setting.captcha') }}">
            <div
                class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/captcha') ? 'active' : '' }}">
                <h1>Re-captcha Settings</h1>
            </div>
        </a>
        <a href="{{ route('setting.email') }}">
            <div
                class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/email') ? 'active' : '' }}">
                <h1>Email Settings</h1>
            </div>
        </a>
        <a href="{{ route('setting.annoucement') }}">
            <div
                class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/annoucement') ? 'active' : '' }}">
                <h1>Annoucement</h1>
            </div>
        </a>
    </div>
