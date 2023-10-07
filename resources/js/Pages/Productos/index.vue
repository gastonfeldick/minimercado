<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

import { Head } from '@inertiajs/vue3';


</script>

<template>
    <Head title="Productos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Productos</h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section>
                        <header class="">
                            <h2 class="text-lg font-medium text-gray-900">Filtros</h2>
                        </header>
                        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
                            <div class="p-6">
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        

        
    </AuthenticatedLayout>
</template>
