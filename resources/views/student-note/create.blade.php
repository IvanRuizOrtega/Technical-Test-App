<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear notas')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">  

                <form action="{{ route('students.notes.store', $student) }}" method="POST"
                        class="w-full">
                        @csrf                        
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    {{ __('Asignaturas') }}
                                </label>
                                <select class="appearance-none block w-full bg-gray-200 text-gray-700 @error('subject') border border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                        name="subject">
                                    <option value=0 selected disabled>{{ __('Abrir menú de selección')}}</option>
                                    @foreach($course->subjects as $subject) 
                                        <option value="{{ $subject->id }}" 
                                            {{ old('subject') == $subject->id ? 'selected':''  }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>

                                @error('subject')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    {{ __('Periodo') }}
                                </label>
                                <select class="appearance-none block w-full bg-gray-200 text-gray-700 @error('period') border border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                        name="period">
                                    <option value=0 selected disabled>{{ __('Abrir menú de selección')}}</option>
                                    @foreach($periods as $period)         
                                        <option value="{{ $period->id }}" 
                                            {{ old('period') == $period->id ? 'selected':''  }}>{{ $period->name }}</option>
                                    @endforeach
                                </select>

                                @error('period')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    {{ __('Nota') }}
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 @error('note') border border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                value="{{ old('note') }}"
                                name="note"                        
                                placeholder="{{ __('Nota') }}"
                                type="text">

                                @error('note')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>



                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                            type="submit">
                                {{ __('Guardar') }}
                            </button>
                        </div>
                    </form>

                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
