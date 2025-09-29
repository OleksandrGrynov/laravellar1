<nav class="bg-light p-2">
    <a href="{{ route('home') }}">Home</a> |
    <a href="{{ route('about', ['mode' => 'two']) }}">About</a> |
    <a href="{{ route('posts.index', ['mode' => 'one']) }}">Posts</a> |
    <a href="{{ route('lab.index', ['mode' => 'three']) }}">Lab</a>
</nav>
