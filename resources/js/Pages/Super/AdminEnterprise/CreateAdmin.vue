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
// Fonction pour enrégistrer les données
const submit = () => {
    if (form.lastname.trim() === '' || form.firstname.trim() === '' || form.email.trim() === '') {
        Swal.fire({
            text: "Veuillez remplir tous les champs s'il vous plaît !!!",
            icon: 'error',
            confirmButtonColor: "red",
        })
    } else {
        axios.post(route('createAdminUser', {
            form: form
        }))
            .then(response => {
                if (response.data.error) {
                    Swal.fire({
                        text: response.data.error,
                        icon: 'error',
                        confirmButtonColor: "red",
                    })
                } else {
                    Swal.fire({
                        text: response.data.success,
                        icon: 'success',
                        confirmButtonColor: "green",
                    });

                    setTimeout(() => {
                        window.location.href = "/adminEnterprise";
                    }, 1500);
                }
            })
    }
};
</script>
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    </AuthenticatedLayout>
    <div class="fixed top-0 bottom-0 right-0 lg:w-[85%] lg:h-screen z-50">
        <NavBar :niveau="'Administrateurs Entreprise'" />
        <div class="flex justify-center items-center h-full w-full">
            <div class="lg:flex lg:basis-[40%] lg:mt-[-160px] shadow-2xl rounded-xl">
                <div class="lg:basis-[50%] bg-amber-600 text-white justify-center items-center rounded-l">
                    <div
                        class="border lg:w-[70px] lg:h-[70px] rounded-full flex justify-center items-center bg-gray-100 mx-auto lg:mt-[170px]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="orange" class="w-7 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                </div>
                <div class="lg:basis-[50%] bg-white lg:py-8 lg:px-6 rounded-r">
                    <form @submit.prevent="submit">
                        <div class="mb-2 flex flex-col gap-2">
                            <label for="nom">Nom de l'utilisateur : <span class="text-red-600 font-bold">*</span></label>
                            <input rows="4" id="nom" class="w-full rounded px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
                          sm:leading-5 resize-none focus:outline-none focus:border-gray-200"
                                placeholder="Nom de famille" v-model="form.lastname" required />
                        </div>
                        <div class="mb-2 flex flex-col gap-2">
                            <label for="prenom">Prénom de l'utilisateur : <span
                                    class="text-red-600 font-bold">*</span></label>
                            <input rows="4" id="prenom" class="w-full rounded px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
                          sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Prénoms"
                                v-model="form.firstname" required />
                        </div>
                        <div class="mb-2 flex flex-col gap-2">
                            <label for="email">Adresse électronique : <span class="text-red-600 font-bold">*</span></label>
                            <input rows="4" id="email" type="email" class="w-full rounded px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
                          sm:leading-5 resize-none focus:outline-none focus:border-gray-200"
                                placeholder="Adresse électronique" v-model="form.email" required />
                        </div>
                        <div class="mb-4 flex flex-col gap-2">
                            <label for="matricule">Matricule :</label>
                            <input rows="4" id="matricule" class="w-full rounded px-4 py-2.5 leading-5 transition duration-150 ease-in-out sm:text-sm
                          sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Matricule"
                                v-model="form.matricule" />
                        </div>
                        <div class="flex items-center lg:justify-end">
                            <button type="submit"
                                class="cursor-pointer flex justify-center items-center bg-blue-700 hover:bg-blue-800 focus:outline-none focus:shadow-outline-orange text-white p-2.5 rounded-md transition duration-300 gap-2 text-sm">
                                Créer<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                    id="send" fill="#fff">
                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                    <path
                                        d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
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