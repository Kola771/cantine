<script setup>
import AuthenticatedLayout from '@/Layouts/LayoutDash.vue';
import NavBar from '@/Layouts/navBarDash.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
const props = defineProps(['donnees']);
const form = useForm({
    lastname: props.donnees.admin_lastname,
    firstname: props.donnees.admin_firstname,
    email: '',
    matricule: '',
    idAdmin: props.donnees.id
});
console.log(props.donnees, form);
</script>
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    </AuthenticatedLayout>
    <div class="fixed top-0 bottom-0 right-0 lg:w-[85%] lg:h-screen z-50">
        <NavBar :niveau="'Administrateurs Entreprise'" />
        <div class="flex justify-center items-center h-full w-full">
            <div class="lg:w-[28%] shadow-2xl rounded-xl bg-white lg:py-10 lg:px-6 lg:mt-[-180px]">
                <form @submit.prevent="submit">
                    <div class="mb-8">
                        <input rows="4" id="entreprise" class="w-full rounded-md px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
          sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Nom de famille"
                            v-model="form.lastname" required />
                    </div>
                    <div class="mb-8">
                        <input rows="4" id="entreprise" class="w-full rounded-md px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
          sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Prénoms"
                            v-model="form.firstname" required />
                    </div>
                    <div class="mb-8">
                        <input rows="4" id="entreprise" class="w-full rounded-md px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
          sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Adresse électronique"
                            v-model="form.email" required />
                    </div>
                    <div class="mb-2">
                        <input rows="4" id="entreprise" class="w-full rounded-md px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
          sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Matricule"
                            v-model="form.matricule" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default
    {
        data() {
            return {
            }
        },

        methods: {
        },
        mounted() {
        }
    }
</script>