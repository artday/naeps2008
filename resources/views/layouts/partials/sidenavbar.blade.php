<aside class="side-navbar" id="active-aside">
    <span id="aside-toggler" class="icon-bars">
        <span></span>
        <span></span>
        <span></span>
    </span>

    <a class="clr" href="{{ route('profile') }}">
        @include('user.partials.userblock')
    </a>

    <nav>
        <ul>
            <li><a href=""><span>Timeline</span></a></li>
            <li><a href="{{ route('events') }}"><span>Events</span></a></li>
            <li><a href="{{ route('people') }}"><span>People</span></a></li>
            <li><a href="{{ route('profile') }}"><span>Profile</span></a></li>
        </ul>
    </nav>

</aside>