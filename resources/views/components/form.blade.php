
@props([
    'action',
    'post' => null,
    'put' => null,
    'delete' => null,
])

<form action="{{route('question.store')}}" method="POST" class="mt-16">
    @csrf

    @if ($put)
        @method("PUT")
    @endif

    @if ($delete)
        @method("DELETE")
    @endif

    {{ $slot }}
</form>
