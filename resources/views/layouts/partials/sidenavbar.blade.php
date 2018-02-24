<aside class="side-navbar" id="active-aside">
    <span id="aside-toggler" class="icon-bars">
        <span></span>
        <span></span>
        <span></span>
    </span>

    <div class="user-block">
        <div class="-image">
            <img src="https://www.gravatar.com/avatar/{{ md5('kingvasil123@gmail.com') }}?d=mm&s=40" alt="">
        </div>
        <div class="-profile-info">
            <span class="-name">Василий Король</span>
            <span class="-mail">kingvasil@gmail.com</span>
        </div>
    </div>

    <nav>
        <ul>
            <li><a href=""><span>Timeline</span></a></li>
            <li><a href="{{ route('events') }}"><span>Events</span></a></li>
            <li><a href=""><span>People</span></a></li>
            <li><a href=""><span>Update profile</span></a></li>
        </ul>
    </nav>

</aside>