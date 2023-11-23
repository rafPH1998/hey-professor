<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>
        @if (session('success'))
            <x-alerts.success/>
        @endif

        <x-form post :action="route('question.store')">
            <x-textarea label="Question" name="question"/>
            <x-btn.primary>
                SAVE
            </x-btn.primary>
            <x-btn.reset>
                CANCEL
            </x-btn.reset>
        </x-form>
    </x-container>

</x-app-layout>
