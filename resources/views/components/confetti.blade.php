@props([
    'autostart' => false,
    'colors' => ['#FFD700', '#DC3545', '#0D6EFD'],
    'duration' => null,
])

@if($autostart)
    <div
        data-confetti-autostart
        data-confetti-colors="{{ json_encode($colors) }}"
        @if($duration) data-confetti-duration="{{ $duration }}" @endif
        hidden
    ></div>
@endif
