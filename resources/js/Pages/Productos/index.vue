<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Axios from 'axios';
import Swal from 'sweetalert2'
import { onMounted, ref } from 'vue'
import { TailwindPagination } from 'laravel-vue-pagination';


import { Head,useForm } from '@inertiajs/vue3';

defineProps({
    
});

const filtros = useForm({
    nombre:"", 
    codigo:"",
});

const productos = ref({'data':[]})

const eliminar = (productoEliminar) =>{
    Axios.post(route('productos.delete'),productoEliminar)
    .then(response=>{
        console.log(response)
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '¡Eliminado!',
            showConfirmButton: false,
            timer: 1000
        }).then(() => {
            location.reload();
        });
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Verifique los campos ingresados',
        });
    });
};

const getProductos = (page=1) =>{
    const ruta = route('productos.get');
    const params = new URLSearchParams({
        nombre: filtros.nombre,
        codigo: filtros.codigo,
    });
    //Axios.get(`${ruta}?page=${page}`)
    Axios.get(`${ruta}?${params.toString()}&page=${page}`)
    //Axios.get(`${ruta}?page=${page}`)
    .then(response=>{
        productos.value=response.data;
    })
    .catch(error => {
        console.log("error");
        console.log(error);
    });
};

onMounted(() => {
    getProductos();
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
                        <form @submit.prevent="getProductos()" class="mt-4 space-y-3">
                            <div class="max-w-xl">
                                <InputLabel for="name" value="Nombre del producto" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Ej: Manteca"
                                    v-model="filtros.nombre"
                                />
                            </div>

                            <div class="max-w-xl">
                                <InputLabel for="codigo" value="Codigo" />

                                <TextInput
                                    id="codigo"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                    autocomplete="Codigo"
                                    placeholder="Ej: 001"
                                    v-model="filtros.codigo"
                                />
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
                                        <template v-if="productos.data.length === 0">
                                            <tr>
                                                <td colspan="5" class="py-3 px-6 text-center">No existen registros</td>
                                            </tr>
                                        </template>
                                        <template v-else>
                                            <tr  v-for="producto in productos.data" class="border-b border-gray-200 hover:bg-gray-100">
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
                                                            <a :href="route('productos.edit',producto.id)"><i class="fa-solid fa-pen-to-square" title="Editar"  ></i></a>
                                                        </div>
                                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                            <form @submit.prevent="eliminar(producto)">
                                                                <button type="submit"><i class="fa-regular fa-trash-can" title="Eliminar"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody> 
                                </table>
                                <div class="flex justify-end p-2">
                                    <TailwindPagination
                                        :data="productos"
                                        @pagination-change-page="getProductos"
                                        :limit="2"
                                        :active-classes="['bg-blue-50', 'border-blue-500', 'text-blue-600']"  
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        
    </AuthenticatedLayout>
</template>
