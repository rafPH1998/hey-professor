<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>

       <div class="dark:text-gray-400 space-y-4 mt-6">
            @foreach ($questions as $item)
                <x-question-list :question="$item"/>
            @endforeach
       </div>

    </x-container>

</x-app-layout>
