<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    Serial:'',
    Pais:'',
    Ciudad:'',
    Institucion:'',
    Telefono:'',
    Direccion:'',
    ubicacionEquipo:'',
    Piso:''
});
</script>

<template>
  <Head title="Crear Cliente" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Departamento</h2>
    </template>

    <div class="py-12">
      <div class="grid grid-cols-2 gap-6">
        <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <form @submit.prevent="form.post(route('departments.store'))" class="mt-6 space-y-6 max-w-xl"  >
            <InputLabel for="Pais" value="Pais"></InputLabel>
            <TextInput id="Pais" v-model="form.Pais" autofocus required type="text" class="mt-1 block w-full"></TextInput>
            <InputError :message="form.errors.Pais" class="mt-2"></InputError>
          
            <InputLabel for="Ciudad" value="Ciudad"></InputLabel>
            <TextInput id="Ciudad" v-model="form.Ciudad" autofocus required type="text" class="mt-1 block w-full"></TextInput>
            <InputError :message="form.errors.Ciudad" class="mt-2"></InputError>

            <InputLabel for="Institucion" value="Institucion"></InputLabel>
            <TextInput id="Institucion" v-model="form.Institucion" autofocus required type="text" class="mt-1 block w-full"></TextInput>
            <InputError :message="form.errors.Institucion" class="mt-2"></InputError>

            <InputLabel for="Telefono" value="Telefono"></InputLabel>
            <TextInput id="Telefono" v-model="form.telefono" autofocus required type="tel" class="mt-1 block w-full"></TextInput>
            <InputError :message="form.errors.Telefono" class="mt-2"></InputError>

            <InputLabel for="Direccion" value="Direccion"></InputLabel>
            <TextInput id="Direccion" v-model="form.Direccion" autofocus required type="text" class="mt-1 block w-full"></TextInput>
            <InputError :message="form.errors.Direccion" class="mt-2"></InputError>

            <InputLabel for="ubicacionEquipo" value="ubicacionEquipo"></InputLabel>
            <TextInput id="ubicacionEquipo" v-model="form.ubicacionEquipo" autofocus required type="text" class="mt-1 block w-full"></TextInput>
            <InputError :message="form.errors.ubicacionEquipo" class="mt-2"></InputError>

            <InputLabel for="Piso" value="Piso"></InputLabel>
            <TextInput id="Piso" v-model="form.Piso" autofocus required 
            type="number" 
            class="mt-1 block w-full"></TextInput>
            <InputError :message="form.errors.Piso" class="mt-2"></InputError>
            <PrimaryButton :disabled="form.processing">
                <i class="fa-solid fa-save"></i> Guardar
            </PrimaryButton>
            </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>


