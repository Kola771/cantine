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
const submit = () => {
    axios.post(route('createAdminUser', {
        form: form
    }))
        .then(response => {
            console.log(response, form);
        })
};
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
                    <div class="mb-4">
                        <input rows="4" id="entreprise" class="w-full rounded-md px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
          sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Matricule"
                            v-model="form.matricule" />
                    </div>
                    <div class="flex items-center lg:justify-end">
                        <button type="submit"
                            class="cursor-pointer flex justify-center items-center bg-green-700 hover:bg-green-800 focus:outline-none focus:shadow-outline-orange text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                            Créer l'utilisateur <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                viewBox="0 0 24 24" id="send" fill="#fff">
                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                <path
                                    d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                                </path>
                            </svg>
                        </button>
                        <div class="absolute top-8 right-8 cursor-pointer lg:w-[25px] lg:h-[25px] flex justify-center items-center bg-gray-300 hover:bg-gray-500 hover:text-white rounded-full"
                            @click="hiddenUpdate">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
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