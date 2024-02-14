@include('layout.head')

<div class="admin-wrapper">
    <x-admin.aside />
    <div class="admin-wrapper__content">
        @include('layout.admin.header')
        <main class="admin-wrapper__main">
            @yield('html')
        </main>
    </div>

</div>

@include('layout.foot')