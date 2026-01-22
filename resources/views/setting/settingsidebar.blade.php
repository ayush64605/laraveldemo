<style>
    .nav-link .active {
        color: {{ $themesetting->theme_color }}
    }
</style>
<div class="p-4 mt-4 border border-solid rounded-md border-gray-200 nav-link">
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
    <a href="#">
        <div
            class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/email') ? 'active' : '' }}">
            <h1>Email Settings</h1>
        </div>
    </a>
    <a href="#">
        <div
            class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/captcha') ? 'active' : '' }}">
            <h1>Re-captcha Settings</h1>
        </div>
    </a>
    <a href="#">
        <div
            class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/slack') ? 'active' : '' }}">
            <h1>Slack Settings</h1>
        </div>
    </a>
</div>
