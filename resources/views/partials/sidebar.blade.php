<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="text-center mt-2">
        <img src="{{ asset('img/logo.png') }}" height="60" width="60"/>
    </div>
    <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-title">{{ __('Manage Data') }}</li>

            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{route('customer.index')}}">
                    {{ __('Customers') }}</a>
            </li>

            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{route('group.index')}}">
                    {{ __('Groups') }}</a>
            </li>


            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{route('template.index')}}">
                    {{ __('Templates') }}</a>
            </li>



        <li class="c-sidebar-nav-title">{{ __('Email Notification Center') }}</li>
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{route('dashboard.index')}}">{{ __('Dashboard') }}
                </a>
            </li>

    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
