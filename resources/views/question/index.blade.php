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

       <div class="mt-12">
            <div class="dark:text-gray-400 uppercase font-bold mb-1">
                Meus rascunhos
            </div>

            <div class="dark:text-gray-400 space-y-4">
                <x-table>
                    <x-table.thead>
                        <tr>
                            <x-table.th>Question</x-table.th>
                            <x-table.th>Actions</x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                        @foreach($questions as $question)
                            @if ($question->draft)
                                <x-table.tr>
                                    <x-table.td>{{ $question->question }}</x-table.td>
                                    <x-table.td>
                                        <x-form :action="route('question.destroy', $question)" delete>
                                            <button type="submit" class="hover:underline text-blue-500">
                                                Deletar
                                            </button>
                                        </x-form>

                                        <x-form :action="route('question.publish', $question)" put>
                                            <button type="submit" class="hover:underline text-blue-500">
                                                Publicar
                                            </button>
                                        </x-form>
                                    </x-table.td>
                                </x-table.tr>
                            @endif
                        @endforeach
                    </tbody>
                </x-table>
            </div>
       </div>

        <hr class="border-gray-700 border-dashed my-4">

        <div class="dark:text-gray-400 uppercase font-bold mb-1">
            Minhas perguntas
        </div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                @foreach($questions as $question)
                    @if ($question->draft === false)
                        <x-table.tr>
                            <x-table.td>{{ $question->question }}</x-table.td>
                            <x-table.td>
                                <x-form :action="route('question.destroy', $question)" delete>
                                    <button type="submit" class="hover:underline text-blue-500">
                                        Deletar
                                    </button>
                                </x-form>
                            </x-table.td>
                        </x-table.tr>
                    @endif
                @endforeach
                </tbody>
            </x-table>

        </div>


    </x-container>

</x-app-layout>
