@props([
    'src',
    'default' => 'images/default-image.jpg'
])

@if (count(explode('.',$src)) > 1 && file_exists($src))
    <img src="{{ asset($src) }}" alt="" {{ $attributes->merge(['class' => '']) }}>
@else
    <img src="{{ asset($default) }}" {{ $attributes->merge(['class' => '']) }}/>
@endif
