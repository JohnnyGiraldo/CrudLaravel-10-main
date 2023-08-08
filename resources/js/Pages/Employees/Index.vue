<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head,useForm } from '@inertiajs/vue3';
import { nextTick,ref } from 'vue';
import Swal from 'sweetalert2';
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';

const SerialInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');

const props = defineProps({
    employees: {type:Object},
    departments: {type:Object}
});
const form = useForm({
    Serial:'', Modelo:'', Estado:'',fechaFabricacion:'',tipoAsistencia:'',fechaInstalacion:'',tipoMantenimiento:'',fechaMantenimiento:'',tipoPieza:'',fechaCambioPieza:'',numeroCiclos:'',fechaIncidente:'',Telefono:'',Observaciones:'',Img:'',department_id:''
});
const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('employees.index',{page:event}));
}
const openModal = (op,Serial,Modelo,fechaFabricacion,tipoAsistencia,fechaInstalacion,tipoMantenimiento,fechaMantenimiento,tipoPieza,fechaCambioPieza,numeroCiclos,fechaIncidente,Telefono,Observaciones,Img,department,employee) =>{
    modal.value = true;
    nextTick( () => SerialInput.value.focus());
    operation.value = op;
    id.value = employee;
    if(op == 1){
        title.value = 'Crear Maceradora';
    }
    else{
        title.value = 'Editar Maceradora';
        form.Serial=Serial;
        form.Modelo=Modelo;
        form.Estado=Estado;
        form.fechaFabricacion=fechaFabricacion;
        form.tipoAsistencia=tipoAsistencia;
        form.fechaInstalacion=fechaInstalacion;
        form.tipoMantenimiento=tipoMantenimiento;
        form.fechaMantenimiento=fechaMantenimiento;
        form.tipoPieza=tipoPieza;
        form.fechaCambioPieza=fechaCambioPieza;
        form.numeroCiclos=numeroCiclos;
        form.fechaIncidente=fechaIncidente;
        form.Telefono=Telefono;
        form.Observaciones=Observaciones;
        form.Img=Img;
        form.department_id=department;
    }
}
const closeModal = () =>{
    modal.value = false;
    form.reset();
}
const save = () =>{
    if(operation.value == 1){
        form.post(route('employees.store'),{
            onSuccess: () => {ok('Maceradora creada con Éxito')}
        });
    }
    else{
        form.put(route('employees.update',id.value),{
            onSuccess: () => {ok('Maceradora Actualizada')}
        });
    }
}
const ok = (msj) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'Éxito'});
}
const deleteEmployee = (id,Serial) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title:'Estas seguro de Eliminar '+Serial+' ?',
        icon:'Pregunta', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si,Eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed) {
            form.delete(route('employees.destroy',id),{
                onSuccess: () =>{ok('Maceradora Eliminado')}
            });
        }
    });
}
</script>

<template>
    <Head title="Maceradoras" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">EMPLEADOS</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <PrimaryButton @click="openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i> AGREGAR
                    </PrimaryButton>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center overflow-x-auto py-3">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">NRO</th>
                            <th class="px-2 py-2">Modelo</th>
                            <th class="px-2 py-2">Estado</th>
                            <th class="px-2 py-2">fechaFabricacion</th>
                            <th class="px-2 py-2">tipoAsistencia</th>
                            <th class="px-2 py-2">fechaInstalacion</th>
                            <th class="px-2 py-2">tipoMantenimiento</th>
                            <th class="px-2 py-2">fechaMantenimiento</th>
                            <th class="px-2 py-2">tipoPieza</th>
                            <th class="px-2 py-2">fechaCambioPieza</th>
                            <th class="px-2 py-2">numeroCiclos</th>
                            <th class="px-2 py-2">fechaIncidente</th>
                            <th class="px-2 py-2">Telefono</th>
                            <th class="px-2 py-2">Observaciones</th>
                            <th class="px-2 py-2">Img</th>
                            <th class="px-2 py-2">EDITAR</th>
                            <th class="px-2 py-2">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="emp, i in employees.data" :key="emp.department_id">
                        <td class="border border-gray-400 px-2 py-2">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.Modelo }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.Estado }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.fechaFabricacion }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.tipoAsistencia }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.fechaInstalacion }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.tipoMantenimiento }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.fechaMantenimiento }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.tipoPieza }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.fechaCambioPieza }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.numeroCiclos }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.fechaIncidente }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.Telefono }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.Observaciones }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ emp.Img }}</td>
                    <WarningButton 
                        @click="openModal(2,emp.Serial,emp.Modelo,emp.Estado,emp.fechaFabricacion,
                        emp.tipoAsistencia,emp.fechaInstalacion,emp.tipoMantenimiento,
                        emp.fechaMantenimiento,emp.tipoPieza,emp.fechaCambioPieza,
                        emp.numeroCiclos,emp.fechaIncidente,emp.Telefono,emp.Observaciones,
                        emp.Img,emp.department_id,emp.id)">
                        <i class="fa-solid fa-edit"></i>
                    </WarningButton>
                        <td class="border border-gray-400 px-2 py-2">
                            <DangerButton @click="deleteEmployee(emp.id,emp.Serial)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <VueTailwindPagination
                    :current="employees.currentPage" :total="employees.total"
                    :per-page="employees.perPage"
                    @page-changed="onPageClick($event)"
                ></VueTailwindPagination>
            </div>
        </div>
        <Modal :show="modal" @close="closeModal">
            <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
            
            <div class="p-3 mt-6">
                <InputLabel for="Modelo" value="Modelo:"></InputLabel>
                <TextInput id="Modelo" ref="ModeloInput"
                v-model="form.Modelo" type="text" class="mt-1 block w-3/4"
                placeholder="Modelo de la Maceradora"></TextInput>
                <InputError :message="form.errors.Modelo" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="fechaFabricacion" value="fecha de Fabricacion:"></InputLabel>
                <TextInput id="fechaFabricacion"
                v-model="form.fechaFabricacion" type="date" class="mt-1 block w-3/4"
                placeholder="Fecha de Fabricación"></TextInput>
                <InputError :message="form.errors.fechaFabricacion" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="tipoAsistencia" value="tipo de Asistencia:"></InputLabel>
                <TextInput id="tipoAsistencia"
                v-model="form.tipoAsistencia" type="text" class="mt-1 block w-3/4"
                placeholder="tipo de Asistencia"></TextInput>
                <InputError :message="form.errors.tipoAsistencia" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="fechaInstalacion" value="fecha de Instalacion:"></InputLabel>
                <TextInput id="fechaInstalacion"
                v-model="form.fechaInstalacion" type="date" class="mt-1 block w-3/4"
                placeholder="fecha de Instalacion"></TextInput>
                <InputError :message="form.errors.fechaInstalacion" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="tipoMantenimiento" value="tipo de Mantenimiento:"></InputLabel>
                <TextInput id="tipoMantenimiento"
                v-model="form.tipoMantenimiento" type="text" class="mt-1 block w-3/4"
                placeholder="tipo de Mantenimiento"></TextInput>
                <InputError :message="form.errors.tipoMantenimiento" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="fechaMantenimiento" value="fecha de Mantenimiento:"></InputLabel>
                <TextInput id="fechaMantenimiento"
                v-model="form.fechaMantenimiento" type="date" class="mt-1 block w-3/4"
                placeholder="fecha de Mantenimiento"></TextInput>
                <InputError :message="form.errors.fechaMantenimiento" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="tipoPieza" value="tipo de Pieza:"></InputLabel>
                <TextInput id="tipoPieza"
                v-model="form.tipoPieza" type="text" class="mt-1 block w-3/4"
                placeholder="tipo de Pieza"></TextInput>
                <InputError :message="form.errors.tipoPieza" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="fechaCambioPieza" value="fecha Cambio de Pieza:"></InputLabel>
                <TextInput id="fechaCambioPieza"
                v-model="form.fechaCambioPieza" type="date" class="mt-1 block w-3/4"
                placeholder="fecha Cambio de Pieza"></TextInput>
                <InputError :message="form.errors.fechaCambioPieza" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="numeroCiclos" value="numero de Ciclos:"></InputLabel>
                <TextInput id="numeroCiclos"
                v-model="form.numeroCiclos" type="number" class="mt-1 block w-3/4"
                placeholder="numero de Ciclos"></TextInput>
                <InputError :message="form.errors.numeroCiclos" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="fechaIncidente" value="fecha del Incidente:"></InputLabel>
                <TextInput id="fechaIncidente"
                v-model="form.fechaIncidente" type="date" class="mt-1 block w-3/4"
                placeholder="fecha del Incidente"></TextInput>
                <InputError :message="form.errors.fechaIncidente" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="Telefono" value="Teléfono:"></InputLabel>
                <TextInput id="Telefono"
                v-model="form.Telefono" type="tel" class="mt-1 block w-3/4"
                placeholder="Teléfono"></TextInput>
                <InputError :message="form.errors.Telefono" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="Observaciones" value="Observaciones:"></InputLabel>
                <TextInput id="Observaciones"
                v-model="form.Observaciones" type="text" class="mt-1 block w-3/4"
                placeholder="Observaciones"></TextInput>
                <InputError :message="form.errors.Observaciones" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="Img" value="Imagen:"></InputLabel>
                <TextInput id="Img"
                v-model="form.Img" type="text" class="mt-1 block w-3/4"
                placeholder="Imgagen"></TextInput>
                <InputError :message="form.errors.Img" class="mt-2"></InputError>
            </div>
                <div class="p-3">
                <InputLabel for="department_id" value="Departamento:"></InputLabel>
                <SelectInput id="department_id" :options="departments"
                v-model="form.department_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.department_id" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <PrimaryButton :disabled="form.processing" @click="save">
                    <i class="fa-solid fa-save"></i> Guardar
                </PrimaryButton>
            </div>
            <div class="p-3 mt-6 flex justify-end">
                <SecondaryButton class="ml-3" :disabled="form.processing"
                @click="closeModal">
                    Cancel
                </SecondaryButton>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

