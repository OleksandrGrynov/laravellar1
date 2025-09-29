<nav class="nav">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
    <a href="{{ route('about', ['mode' => 'two']) }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
    <a href="{{ route('posts.index', ['mode' => 'one']) }}" class="{{ request()->routeIs('posts.index') ? 'active' : '' }}">Posts</a>
    <a href="{{ route('lab.index', ['mode' => 'three']) }}" class="{{ request()->routeIs('lab.index') ? 'active' : '' }}">Lab</a>
</nav>
