<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Questions') }}
        </x-header>
    </x-slot>

    <x-container>
        @if (session('success'))
            <x-alerts.success/>
        @endif

        <x-form post :action="route('question.store')">
            <x-textarea label="Pergunta" name="question"/>
            <x-btn.primary>
                SALVAR
            </x-btn.primary>
            <x-btn.reset>
                CANCELAR
            </x-btn.reset>
        </x-form>

        <hr class="border-gray-700 border-dashed my-4">

        <div class="dark:text-gray-400 uppercase font-bold mb-1">
            Minhas perguntas
        </div>

       <div class="dark:text-gray-400 space-y-4">
            @foreach ($questions as $item)
                <x-question-list :question="$item"/>
            @endforeach
       </div>


    </x-container>

</x-app-layout>
