<style>
    .nav-link .active{
        color: red
    }
</style>
<div class="p-4 mt-4 border-1 border-solid rounded-md border-gray-200 nav-link">
    <a href="{{ route('general') }}">
        <div
            class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/general') ? 'active' : '' }}">
            <h1>General Settings</h1>
        </div>
    </a>
    <a href="{{ route('lemon') }}">
        <div
            class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/lemon') ? 'active' : '' }}">
            <h1>Lemon Squzy Settings</h1>
        </div>
    </a>
    <a href="{{ route('email') }}">
        <div
            class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/email') ? 'active' : '' }}">
            <h1>Email Settings</h1>
        </div>
    </a>
    <a href="{{ route('captcha') }}">
        <div
            class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/captcha') ? 'active' : '' }}">
            <h1>Re-captcha Settings</h1>
        </div>
    </a>
    <a href="{{ route('slack') }}">
        <div
            class="flex gap-4 items-center border-b border-gray-300 p-3 text-gray-500 hover:bg-gray-100 cursor-pointer {{ request()->is('setting/slack') ? 'active' : '' }}">
            <h1>Slack Settings</h1>
        </div>
    </a>
</div>
