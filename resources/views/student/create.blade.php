<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear estudiantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">  

                    <form action="{{ route('students.store') }}" method="POST"
                        class="w-full">

                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    {{ __('Nombre') }}
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 @error('name') border border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                value="{{ old('name') }}"
                                name="name"                        
                                placeholder="{{ __('Nombre') }}"
                                type="text" >

                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    {{ __('Email') }}
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 @error('email') border border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                value="{{ old('email') }}"
                                name="email"                        
                                placeholder="{{ __('Email') }}"
                                type="email" >

                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    {{ __('Tipo de identificación') }}
                                </label>
                                <select class="appearance-none block w-full bg-gray-200 text-gray-700 @error('typeOfIdentification') border border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                        name="typeOfIdentification">
                                    <option value=0 selected disabled>{{ __('Abrir menú de selección')}}</option>
                                    @foreach($identificationTypes as $idtye)         
                                        <option value="{{ $idtye->id }}" 
                                            {{ old('typeOfIdentification') == $idtye->id ? 'selected':''  }}>{{ $idtye->name }}</option>
                                    @endforeach
                                </select>

                                @error('typeOfIdentification')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    {{ __('Identification') }}
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 @error('identification') border border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                value="{{ old('identification') }}"
                                name="identification"                        
                                placeholder="{{ __('Identification') }}"
                                type="text" >

                                @error('identification')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    {{ __('Curso') }}
                                </label>
                                <select class="appearance-none block w-full bg-gray-200 text-gray-700 @error('course') border border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                        name="course">
                                    <option value=0 selected disabled>{{ __('Abrir menú de selección')}}</option>
                                    @foreach($courses as $course)         
                                        <option value="{{ $course->id }}" 
                                            {{ old('course') == $course->id ? 'selected':''  }}>{{ $course->name }}</option>
                                    @endforeach
                                </select>

                                @error('course')
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