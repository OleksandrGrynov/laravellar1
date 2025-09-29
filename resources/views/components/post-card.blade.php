@props(['title','excerpt' => null,'author' => 'Автор','date' => null])

<article class="card p-3 mb-2 border rounded shadow-sm">
    <h3>{{ $title }}</h3>
    @if($excerpt)
        <p>{{ $excerpt }}</p>
    @endif
    <small>{{ $author }} — {{ $date }}</small>
</article>
