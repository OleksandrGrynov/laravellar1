<x-layouts.app title="Пости">
    <h2>Список постів</h2>
    @foreach($posts as $post)
        <x-post-card :title="$post['title']" :content="$post['content']" />
    @endforeach
</x-layouts.app>
