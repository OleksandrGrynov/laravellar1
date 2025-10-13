<nav class="nav">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
    <a href="{{ route('news.index') }}" class="{{ request()->routeIs('news.*') ? 'active' : '' }}">News</a>
    <a href="{{ route('lab.index') }}" class="{{ request()->routeIs('lab.index') ? 'active' : '' }}">Lab</a>
</nav>
