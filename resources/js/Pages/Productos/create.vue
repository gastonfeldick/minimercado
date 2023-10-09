<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Axios from 'axios';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import Swal from 'sweetalert2'

const producto = useForm({
    nombre:"", 
    codigo:"",
    precio:"",
});

const guardar = () =>{
    Axios.post(route('productos.store'),producto)
    .then(response=>{
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '¡Guardado!',
            showConfirmButton: false,
            timer: 1500
        });
        producto.reset()
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Verifique los campos ingresados',
        });
    });
};

</script>

<template>
    <Head title="Productos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear producto</h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
                <div class="p-3 sm:p-8 bg-white shadow sm:rounded-lg">
                    
                    <form @submit.prevent="guardar()" class="mt-4 space-y-8">
                        <div class="max-w-xl">
                            <InputLabel for="nombre" value="Nombre (*)" />

                            <TextInput
                                id="nombre"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                                v-model="producto.nombre"
                            />
                            

                            
                        </div>
                        <div class="max-w-xl">
                            <InputLabel for="codigo" value="Codigo (*)" />

                            <TextInput
                                id="codigo"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                                v-model="producto.codigo"
                                
                            />
                        </div>
                        <div class="max-w-xl">
                            <InputLabel for="precio" value="Precio (*)" />

                            <TextInput
                                id="precio"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                                v-model="producto.precio"
                                
                            />

                            <PrimaryButton class="mt-6" :disabled="producto.processing" >GUARDAR</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </AuthenticatedLayout>
</template>