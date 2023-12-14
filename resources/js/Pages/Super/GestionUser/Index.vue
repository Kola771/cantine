<script setup>
import AuthenticatedLayout from '@/Layouts/LayoutDash.vue';
import NavBar from '@/Layouts/navBarDash.vue';
import { Head, Link } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
</script>
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    </AuthenticatedLayout>
    <div class="fixed top-0 bottom-0 right-0 lg:w-[85%] lg:h-screen z-50">
        <NavBar :niveau="'Gestion des utilisateurs'" />

        <div>
            <div class="mx-auto lg:w-[65%] lg:mt-[80px] shadow-2xl lg:py-4 lg:px-2">
                <div class="w-full flex justify-end lg:mb-2">
                    <input type="text" class="basis-[30%] rounded-full" placeholder="Recherchez un nom">
                </div>
                <table class="w-full">
                    <thead class="">
                        <th class="py-2 border-gray-400 border-y-[1px] border-t-[1px] w-[20%]">Matricule</th>
                        <th class="py-2 border-gray-400 border-[1px] w-[20%]">Nom & Prénom(s)</th>
                        <th class="py-2 border-gray-400 border-[1px] w-[20%]">Adresse électronique</th>
                        <th class="py-2 border-gray-400 border-[1px] w-[20%]">Rôle</th>
                        <th class="py-2 border-gray-400 border-y-[1px] border-t-[1px] w-[20%]">Entreprise reliée</th>
                    </thead>
                    <tbody>
                        <tr class="border-gray-400 border-b-[1px]">
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                        </tr>
                        <tr class="border-gray-400 border-b-[1px]">
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                        </tr>
                        <tr class="border-gray-400 border-b-[1px]">
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                            <td class="py-2 text-center">a</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
export default
    {
        data() {
            return {
                nom: null,
                prenom: null,
                enterprise: null,
                start: null,
                end: null,
                message: null,
                color: null,
                data: [],
                allAdmins: [],
                search: null
            }
        },

        methods: {
            // fonction pour recharger les données de la page
            onLoad() {
                axios.get(route("indexAdmin")).then(response => {
                    this.allAdmins = response.data.admins;
                })
            },
        },
        mounted() {
            this.onLoad();
        }
    }
</script>