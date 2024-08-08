@if($rotator)

    @if($type === 'main')
        @include('default.rotator.main', ['rotator' => $rotator])
    @else
        @include('default.rotator.default', ['rotator' => $rotator])
    @endif

@endif
