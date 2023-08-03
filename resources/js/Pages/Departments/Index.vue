<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    departments: {type:Object}
});
const form = useForm({
    id:'',
    Serial:'',
    Pais:'',
    Ciudad:'',
    Institucion:'',
    Telefono:'',
    Direccion:'',
    ubicacionEquipo:'',
    Piso:'',
});
const deleteDepartment = (id,Serial) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title:'Estás seguro de eliminar  '+Serial+' ?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si,Eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar',
    }).then((result) => {
        if(result.isConfirmed) {
            form.delete(route('departments.destroy',id));
        }
    });
}
</script>

<template>
    <Head title="Departmentos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Departmentos</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('departments.create')"
                    :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                    <i class="fa-solid fa-plus-circle"></i> AGREGAR
                    </Link>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-4">Nro</th>
                            <th class="px-4 py-4">Serial</th>
                            <th class="px-4 py-4">País</th>
                            <th class="px-4 py-4">Ciudad</th>
                            <th class="px-4 py-4">Institución</th>
                            <th class="px-4 py-4">Teléfono</th>
                            <th class="px-4 py-4">Dirección</th>
                            <th class="px-4 py-4">ubicaciónEquipo</th>
                            <th class="px-4 py-4">Piso</th>
                            <th class="px-4 py-4">EDITAR</th>
                            <th class="px-4 py-4">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dep, i in departments" :key="dep.id">
                        <td class="border border-gray-400 px-4 py-4">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ dep.Serial }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ dep.Pais }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ dep.Ciudad }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ dep.Institucion }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ dep.Telefono }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ dep.Direccion }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ dep.ubicacionEquipo }}</td>
                        <td class="border border-gray-400 px-4 py-4">{{ dep.Piso }}</td>
                        <td class="border border-gray-400 px-4 py-4">
                            <Link :href="route('departments.edit',dep.id)"
                            :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs'">
                            <i class="fa-solid fa-edit"></i>
                            </Link>
                        </td>
                        <td class="border border-gray-400 px-4 py-4">
                            <DangerButton @click="deleteDepartment(dep.id,dep.Serial)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
