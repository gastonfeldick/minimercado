<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


import { Head } from '@inertiajs/vue3';
defineProps({
    productos: Array,
});

</script>

<template>
    <Head title="Productos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Productos</h2>
        </template>

     
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-3 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header class="">
                            <h2 class="text-lg font-medium text-gray-900 ">Filtros</h2>
                        </header>
                        <form @submit.prevent="" class="mt-4 space-y-3">
                            <div class="max-w-xl">
                                <InputLabel for="name" value="Nombre del producto" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                    required
                                    autocomplete="name"
                                    placeholder="Ej: Manteca"
                                />
                            </div>

                            

                            <div class="max-w-xl">
                                <InputLabel for="actualizado" value="Actualizado" />

                                <select id="actualizado" class="select select-primary w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option>Game of Thrones</option>
                                    <option>Lost</option>
                                    <option>Breaking Bad</option>
                                    <option>Walking Dead</option>
                                </select>
                                <PrimaryButton class="mt-2">
                                    BUSCAR
                                </PrimaryButton>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ Productos }}
                    <!-- component -->
                <div class="overflow-x-auto">
                        <div class=" bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                            <div class="w-full lg:w-full">
                                <div class="bg-white shadow-md rounded">
                                    <table class="min-w-max w-full table-auto">
                                        <thead>
                                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                <th class="py-3 px-6 text-left">Producto</th>
                                                <th class="py-3 px-6 text-left">Codigo</th>
                                                <th class="py-3 px-6 text-center">Precio</th>
                                                <th class="py-3 px-6 text-center">Ultima Actualizacion</th>
                                                <th class="py-3 px-6 text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 text-sm font-light">
                                            
                                            <tr  v-for="producto in productos" class="border-b border-gray-200 hover:bg-gray-100">
                                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                                    <div class="flex items-center font-medium">
                                                        {{ producto.nombre_producto }}
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-left">
                                                    # 
                                                    <span>{{ producto.codigo }}</span>
                                                </td>
                                                <td class="py-3 px-6 text-center">     
                                                    $
                                                    <span> {{ producto.precio }}</span>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <span class="">{{ producto.fecha_actualizacion}}</span>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex item-center justify-center">
                                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                            <i class="fa-solid fa-pen-to-square" title="Editar"></i>
                                                        </div>
                                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                            <i class="fa-regular fa-trash-can" title="Eliminar"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    
        
    </AuthenticatedLayout>
</template>
