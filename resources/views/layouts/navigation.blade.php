<div class="col-lg-3">
    <div class="pro_sticky_info" data-sticky_column>
        <div class="dashboard-sidebar">
            <div class="profile-top">
                <div class="profile-image">
                    <img src="/assets/images/avtar/1.jpg" class="img-fluid blur-up lazyload" alt="">
                    <a class="profile-edit" href="javascript:void(0)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                            </path>
                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                        </svg>
                    </a>
                </div>
                <div class="profile-detail">
                    <h5>{{ Auth::user()->name }}</h5>
                    <h6>{{ Auth::user()->phone }}</h6>
                    <h6>{{ Auth::user()->email }}</h6>
                </div>
                
            </div>
            
            <div class="faq-tab">
                <ul class="nav nav-tabs" id="top-tab" role="tablist">
                    @php
                        $active='';
                        if(request()->routeIs('dashboard')):
                            $active = 'active';
                        endif;
                    @endphp
                    <li class="nav-item"><a class="nav-link {{$active}}"
                            href="/dashboard">dashboard</a></li>
                    @php
                        $active='';
                        if(request()->routeIs('global-settings')):
                            $active = 'active';
                        endif;
                    @endphp
                    <li class="nav-item"><a class="nav-link {{$active}}"
                            href="/global-settings">global setting</a></li>
                    @php
                        $active='';
                        if(request()->routeIs('bookings')):
                            $active = 'active';
                        endif;
                    @endphp
                    <li class="nav-item"><a class="nav-link {{$active}}"
                            href="/bookings">my bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Book Flight</a></li>
                    
                    <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a data-toggle="tab" class="nav-link"
                            href="{{route('logout')}}" onclick="event.preventDefault();
                                            this.closest('form').submit();">logout</a>
                    </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- <ul class="nav">
    @php
    $active='';
    if(request()->routeIs('dashboard')):
        $active = 'active';
    endif;
    @endphp
    <li class="nav-item {{$active}} show">
        <x-nav-link :href="route('dashboard')" class="nav-link">
            <i class="typcn typcn-chart-area-outline"></i> {{ __('Dashboard') }}
        </x-nav-link>
    </li>
    @php
    $active='';
    if(request()->routeIs('dashboard')):
        $active = 'list_flights';
    endif;
    @endphp
    <li class="nav-item {{$active}} show">
        <x-nav-link :href="route('list_flights')" class="nav-link">
            <i class="typcn typcn-plane-outline"></i> Search Flights
        </x-nav-link>
    </li>
</ul> -->
<!-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!- - Primary Navigation Menu - ->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!- - Logo - ->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!- - Navigation Links - ->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!- - Settings Dropdown - ->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!- - Authentication - ->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!- - Hamburger - ->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!- - Responsive Navigation Menu - ->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!- - Responsive Settings Options - ->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!- - Authentication - ->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav> -->
