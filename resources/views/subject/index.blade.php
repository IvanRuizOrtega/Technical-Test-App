<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asignaturas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">  

                    <div class="grid grid-cols-2 gap-2 place-items-center">
                      <div>
                        <form action="{{ route('subjects.index') }}" method="GET">
                          <input  class="block text-gray-700 text-sm font-bold" 
                                  type="search" 
                                  placeholder="Buscar..."
                                  name="search"/>
                        </form>                          
                      </div>

                      <div>
                        <a  class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                            href="{{ route('subjects.create') }}">
                            {{ __('Crear')}} 
                        </a>
                      </div>
                    </div>

                    <br>

                    <table class="border-collapse w-full">
                      <thead>
                          <tr>
                              <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                              {{ __('#') }}
                              </th>
                              <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                              {{ __('Nombre') }}
                              </th>
                              <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                              {{ __('Creado') }}
                              </th>
                              <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                              {{ __('Opciones') }}

                              </th>
                          </tr>
                      </thead>
                      <tbody>
                      @foreach($subjects as $index => $subject)
                          <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                              <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                  {{ $index+1  }}
                              </td>
                              <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                  {{ $subject->name  }}
                              </td>
                              <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                  {{ $subject->created_at->diffForHumans()  }}
                              </td>
                              <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                  <a href="{{route('subjects.edit', $subject)}}" 
                                     class="text-blue-400 hover:text-blue-600 underline">
                                    {{_('Actualizar')}}
                                  </a>

                                  <form action="{{ route('subjects.destroy', $subject) }}" 
                                        method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button
                                          onclick="return confirm('¿Esta seguro?');"
                                          class="text-blue-400 hover:text-blue-600 underline pl-6"
                                          type="submit">
                                          {{_('Eliminar')}}
                                      </button>
                                  </form>
                              </td>
                          </tr>  
                          @endforeach                        
                      </tbody>
                    </table>

                    <br>       

                    {{$subjects->links()}} 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
