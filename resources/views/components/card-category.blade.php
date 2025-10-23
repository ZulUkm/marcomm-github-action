@props(['id', 'image', 'name', 'product' => null])
<li id="{{ $id }}" class="category-tab">
    <a href="javascript:void(0);">
        <img src="{{ Storage::disk('public_raw')->url($image) }}" alt="{{ $name }}">
    </a>
    <h6><a href="javascript:void(0);">{{ $name }}</a></h6>
</li>
