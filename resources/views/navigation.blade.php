<nav>
	<div class="main-navbar">
		<div id="mainnav">
			<div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
			<div class="menu-overlay"></div>
			<ul class="nav-menu">
				
				<li>
					<a href="/" class="nav-link menu-title">Flights</a>
				</li>
				<li>
					<a href="/dashboard" class="nav-link menu-title">Dashboard</a>
				</li>
				<li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link menu-title"
                            href="{{route('logout')}}" onclick="event.preventDefault();
                                            this.closest('form').submit();">logout</a>
                    </form>
				</li>
				
			</ul>
		</div>
	</div>
</nav>