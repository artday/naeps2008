<div class="top-navbar"{!! !Auth::check() ? 'style="padding-left: 10px"' : '' !!}>
    <div class="brand"><a href="{{ !Auth::check() ? route('index') : route('feed') }}"><span>NAEPS</span></a></span></div>


{{--        @if(!Auth::check())
            <div class="auth-toggler">
                <a href="{{ route('auth') }}"><span>Login</span><i data-feather="log-in"></i></a>
            </div>
        @else
            <div class="auth-toggler">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span>Logout</span><i data-feather="log-out"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        @endif--}}
    <div class="btn-gr -right">
        @if(!Auth::check())
            <a href="{{ route('login') }}" class="btn"><span>Login</span><i data-feather="log-in"></i></a>
        @else
            <a class="btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span>Logout</span><i data-feather="log-out"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endif
    </div>

</div>