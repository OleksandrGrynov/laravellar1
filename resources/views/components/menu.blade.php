<nav style="display:flex;gap:12px;padding:10px;border-bottom:1px solid #ddd">
    <a href="{{ route('home') }}">Home</a>

    {{-- Blog -> gate=one --}}
    <a href="{{ route('blog.index', [], false) }}?gate=one">Blog</a>
    <a href="{{ route('blog.about', [], false) }}?gate=one">Blog About</a>
    <a href="{{ route('blog.show', ['slug'=>'first-post'], false) }}?gate=one">Blog Post</a>

    {{-- Shop -> gate=two --}}
    <a href="{{ route('shop.index', [], false) }}?gate=two">Shop</a>
    <a href="{{ route('shop.cart', [], false) }}?gate=two">Cart</a>
    <a href="{{ route('shop.product', ['sku'=>'SKU123'], false) }}?gate=two">Product</a>

    {{-- Dashboard -> gate=three --}}
    <a href="{{ route('dashboard.index', [], false) }}?gate=three">Dashboard</a>
    <a href="{{ route('dashboard.stats', [], false) }}?gate=three">Stats</a>
    <a href="{{ route('dashboard.settings', [], false) }}?gate=three">Settings</a>
</nav>
