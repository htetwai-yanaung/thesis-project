@props([
    'src',
    'default' => 'images/default-image.jpg'
])

@if (file_exists($src))
    <img src="{{ asset($src) }}" alt="" {{ $attributes->merge(['class' => '']) }}>
@else
    <img src="{{ asset($default) }}" {{ $attributes->merge(['class' => '']) }}/>
@endif
