<x-layout>
    <div class="flex flex-col items-center mt-4">
        <h1 class="mb-4 text-2xl font-semibold">Departamentos</h1>

        <div class="border border-gray-200 shadow">
            <table>
                <thead class="bg-gray-50">
                    <tr>

                        <th class="px-6 py-2 text-xs text-gray-500">

                                Denominación

                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">

                                Localidad

                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Editar
                        </th>
                        <th class="px-6 py-2 text-xs text-gray-500">
                            Borrar
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($departamentos as $depart)
                        <tr class="whitespace-nowrap">
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                {{$depart->denominacion}}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{$depart->localidad}}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="/depart/{{$depart->id}}/edit" class="px-4 py-1 text-sm text-white bg-blue-400 rounded">Editar</a>
                            </td>
                            <td class="px-6 py-4">
                                <form action="/depart/{{$depart->id}}/destroy" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button  class="px-4 py-1 text-sm text-white bg-red-400 rounded" onclick='confirm("Seguro deseas borrarlo")' type="submit">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <form action="/depart/insertar" method="post">
                            @csrf
                            <td class="border border-black">
                                <input  class="border-black" type="text" name="denominacion" id="">
                            </td>
                            <td  class="border border-black">
                                <input type="text" name="localidad" id="">
                            </td>
                            <td>
                                <button class="px-4 py-1 text-sm text-white bg-blue-400 rounded" type="submit">Insertar</button>
                            </td>
                        </form>
                    </tr>

                     {{-- <a href="/depart/create" class="mt-4 text-blue-900 hover:underline">Insertar un nuevo departamento</a> --}}
                </tbody>
            </table>
        </div>

    </div>
</x-layout>
