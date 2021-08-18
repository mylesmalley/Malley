<h1 class="text-center">{!!  $announcement->content ?? "Malley Industries Home Page" !!}</h1>
<p class="text-center">
    Hi
    @auth
        {{ Auth::user()->first_name }}! Did you want to <a href="/" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            log out</a>?
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endauth
    @guest
        there! Did you want to <a href="/login">log in</a>?
    @endguest
</p>
