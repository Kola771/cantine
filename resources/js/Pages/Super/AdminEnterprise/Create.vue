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
        <NavBar :niveau="'Administrateurs Entreprise'" />
        <div>
            <div class="flex justify-center items-center">
                <form class="basis-[50%] lg:my-6 flex border border-b-2">
                    <div class="basis-[8%] flex justify-center items-center cursor-pointer hover:bg-orange-600 hover:text-white"
                        @click="showCreate">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>

                    <div class="flex justify-center items-center lg:gap-2 lg:basis-[84%]">
                        <input type="text" class="border-none w-full lg:py-2.5 outline-none"
                            placeholder="Recherche par entreprise" v-model="search">
                    </div>
                    <div class="cursor-pointer lg:basis-[8%] flex justify-center items-center hover:bg-blue-800 hover:text-white"
                        @click="reset">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </form>
            </div>
            <fieldset
                class="lg:p-2 border border-[1px] rounded shadow-xl mx-auto lg:max-w-[80%] lg:max-h-[690px] overflow-y-auto">
                <legend
                    class="border bg-amber-600 text-white lg:py-2 lg:px-10 flex justify-center items-center lg:w-[30%] rounded-lg">
                    Liste des administrateurs par entreprise</legend>
                <div class="mx-auto lg:p-3 flex lg:gap-x-14 lg:gap-y-8 flex-wrap">
                    <div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 border-gray-300 border-[1px] hover:border-orange-600 basis-[30%] cursor-pointer"
                        v-for="(el, index) in allAdmins" :key="index" @click="showFonction(el.id)">
                        <div class="flex items-center lg:gap-2">
                            <div
                                class="relative overflow-hidden rounded-l-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-[url('/storage/imgCantine/cantine.jpg')] bg-no-repeat bg-cover w-[200px] h-[120px]">
                            </div>
                            <div class="text-sm h-full flex flex-col lg:gap-4 lg:basis-[70%]">
                                <div class="lg:mt-2">
                                    <span class="font-bold">Nom Complet : </span>
                                    <span>{{ el.admin_lastname }} {{ el.admin_firstname }}</span>
                                </div>
                                <div>
                                    <span class="font-bold">Entreprise concernée : </span>
                                    <span>{{ el.entreprise_name }}</span>
                                </div>
                            </div>
                        </div>
                        <div :id="'id-' + el.id" class="z-50 hidden absolute top-16 left-52 bg-gray-100 lg:w-[180px]">

                            <Link :href="route('showAdmin', el.id)"
                                class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer">
                            Créer son compte utilisateur
                            </Link>

                            <Link @click="updateAdminstrator(el.id)"
                                class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between border-black border-y-[1px]">
                            Modifier
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="black" class="font-bold w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                            </Link>

                            <Link @click="delSup(el.id)"
                                class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between">
                            Supprimer
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="red" class="font-bold w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <div id="menuMini" class="hidden relative flex justify-center items-center z-50">
        <div class="w-full h-full bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
        </div>
    </div>
    <div id="formHidden"
        class="hidden absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 shadow-2xl bg-white p-6 rounded-lg lg:w-[30%] flex flex-col gap-2 z-50">
        <div
            class="bg-[url('/storage/imgCantine/cantine1.jpg')] bg-no-repeat bg-cover w-full h-[200px] rounded-xl lg:mb-4 flex justify-center items-center text-xl text-white">
            Création d'un compte administrateur entreprise
        </div>
        <form @submit.prevent="createForm">
            <div v-if="message" :class="'my-2 md:my-4 text-sm text-center font-bold ' + color">{{ message }}</div>
            <div class="flex lg:justify-between lg:mb-6">
                <div class="lg:basis-[48%]">
                    <input rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                  sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Nom de famille"
                        v-model="nom" required />
                </div>
                <div class="lg:basis-[48%]">
                    <input rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                  sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Prénoms"
                        v-model="prenom" required />
                </div>
            </div>
            <div class="mb-4">
                <input rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
      sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Nom de l'entreprise"
                    v-model="enterprise" required />
            </div>
            <div class="flex lg:justify-between lg:mb-6">
                <div class="lg:basis-[48%]">
                    <label for="start">Date de début :</label>
                    <input type="date" id="start" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                  sm:leading-5 resize-none focus:outline-none focus:border-gray-200" v-model="start" required />
                </div>
                <div class="lg:basis-[48%]">
                    <label for="end">Date de fin :</label>
                    <input type="date" id="end" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                  sm:leading-5 resize-none focus:outline-none focus:border-gray-200" v-model="end" required />
                </div>
            </div>
            <div class="flex items-center lg:justify-end">
                <button type="submit"
                    class="flex justify-center items-center bg-green-700 hover:bg-green-800 focus:outline-none focus:shadow-outline-orange text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                    Créer <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" id="send"
                        fill="#fff">
                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                        <path
                            d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                        </path>
                    </svg>
                </button>
                <div class="absolute top-8 right-8 cursor-pointer lg:w-[25px] lg:h-[25px] flex justify-center items-center bg-gray-300 hover:bg-gray-500 hover:text-white rounded-full"
                    @click="hiddenCreate">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </form>
    </div>

    <div id="updateForm" class="hidden relative flex justify-center items-center z-50">
        <div class="w-full h-full bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
        </div>
    </div>
    <div id="upadeFormulaire"
        class="hidden absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 shadow-2xl bg-white p-6 rounded-lg lg:w-[30%] flex flex-col gap-2 z-50">
        <div
            class="bg-[url('/storage/imgCantine/cantine1.jpg')] bg-no-repeat bg-cover w-full h-[200px] rounded-xl lg:mb-4 flex justify-center items-center text-xl text-white">
            Modification d'un compte administrateur entreprise
        </div>
        <form>
            <div v-if="message" :class="'my-2 md:my-4 text-sm text-center font-bold ' + color">{{ message }}</div>
            <div class="flex lg:justify-between lg:mb-6">
                <div class="lg:basis-[48%]">
                    <input rows="4" id="nom" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                  sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Nom de famille"
                        v-model="nom" required />
                </div>
                <div class="lg:basis-[48%]">
                    <input rows="4" id="prenom" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                  sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Prénoms"
                        v-model="prenom" required />
                </div>
            </div>
            <div class="mb-4">
                <input rows="4" id="entreprise" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
      sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Nom de l'entreprise"
                    v-model="enterprise" required />
            </div>
            <div class="flex lg:justify-between lg:mb-6">
                <div class="lg:basis-[48%]">
                    <label for="start">Date de début :</label>
                    <input type="date" id="starts" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                  sm:leading-5 resize-none focus:outline-none focus:border-gray-200" v-model="start" required />
                </div>
                <div class="lg:basis-[48%]">
                    <label for="end">Date de fin :</label>
                    <input type="date" id="ends" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                  sm:leading-5 resize-none focus:outline-none focus:border-gray-200" v-model="end" required />
                </div>
            </div>
            <div class="flex items-center lg:justify-end">
                <span type="submit" @click="updateForm"
                    class="cursor-pointer flex justify-center items-center bg-green-700 hover:bg-green-800 focus:outline-none focus:shadow-outline-orange text-white py-2 px-4 rounded-md transition duration-300 gap-2">
                    Modifier <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" id="send"
                        fill="#fff">
                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                        <path
                            d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z">
                        </path>
                    </svg>
                </span>
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
            }
        },

        methods: {
            // fonction pour afficher le formulaire de création d'un administrateur d'entreprise
            showCreate() {
                menuMini.classList.remove("hidden");
                formHidden.classList.remove("hidden");
            },

            // fonction pour masquer le formulaire de création d'un administrateur d'entreprise
            hiddenCreate() {
                this.color = null;
                this.message = null;
                this.nom = null;
                this.prenom = null;
                this.enterprise = null;
                this.start = null;
                this.end = null;
                menuMini.classList.add("hidden");
                formHidden.classList.add("hidden");
            },

            // fonction pour créer un administrateur d'entreprise
            createForm() {
                if (this.nom.trim() === '' || this.prenom.trim() === '' || this.enterprise.trim() === '' || this.start === null || this.end === null) {
                    this.color = 'text-red-600';
                    this.message = "Veuillez remplir tous les champs s'il vous plaît !!!";
                } else {
                    this.color = null;
                    this.message = null;
                    if (this.start >= this.end) {
                        this.color = 'text-red-600';
                        this.message = "Il y'a un problème. La date de début de licence ne peut être supérieure à celle de fin licence !!!";
                    } else {
                        axios.post(route("createAdminEnt", {
                            nom: this.nom,
                            prenom: this.prenom,
                            enterprise: this.enterprise,
                            start: this.start,
                            end: this.end
                        })).then(response => {
                            if (response.data.error) {
                                this.color = 'text-red-600';
                                this.message = response.data.error;
                            } else {
                                this.color = 'text-green-600';
                                this.message = response.data.success;
                                this.onLoad();
                                setTimeout(() => {
                                    this.hiddenCreate();
                                }, 1500);
                            }
                        })
                    }
                }
            },

            // fonction pour recharger les données de la page
            onLoad() {
                axios.get(route("indexAdmin")).then(response => {
                    this.allAdmins = response.data.admins;
                })
            },

            // Fonction pour afficher les actions qu'on peut mener
            showFonction(index) {
                this.allAdmins.forEach(admins => {
                    if (index === admins.id) {
                        let variable = 'id-' + index
                        if (document.getElementById(`${variable}`).className.includes("hidden")) {
                            document.getElementById(`${variable}`).classList.remove("hidden")
                        } else {
                            document.getElementById(`${variable}`).classList.add("hidden")
                        }
                    } else {
                        let variable = 'id-' + admins.id
                        document.getElementById(`${variable}`).classList.add("hidden")
                    }
                })
            },

            // Fonction pour modifier les informations d'un administrateur entreprise
            updateAdminstrator(id) {
                axios.get(route('getInfoAdminEnt', {
                    id: id
                })).then(response => {
                    if (response.data.error) {
                        Swal.fire({
                            text: response.data.error,
                            icon: 'error',
                            confirmButtonColor: "red",
                        })
                    } else {
                        this.data = response.data;
                        this.nom = response.data.admin_lastname;
                        this.prenom = response.data.admin_firstname;
                        this.enterprise = response.data.entreprise_name;
                        this.start = response.data.licence_year_start;
                        this.end = response.data.licence_year_end;
                        updateForm.classList.remove("hidden");
                        upadeFormulaire.classList.remove("hidden");
                    }
                })
            },

            // fonction pour cacher le formulaire de modification
            hiddenUpdate() {
                this.color = null;
                this.message = null;
                this.nom = null;
                this.prenom = null;
                this.enterprise = null;
                this.start = null;
                this.end = null;
                updateForm.classList.add("hidden");
                upadeFormulaire.classList.add("hidden");
            },

            // fonction pour modifier les données d'un administrateur
            updateForm() {
                if (this.nom.trim() === '' || this.prenom.trim() === '' || this.enterprise.trim() === '' || this.start === null || this.end === null) {
                    this.colors = 'text-red-600';
                    this.message = "Veuillez remplir tous les champs s'il vous plaît !!!";
                } else {
                    this.color = null;
                    this.message = null;
                    if (this.start >= this.end) {
                        this.color = 'text-red-600';
                        this.message = "Il y'a un problème. La date de début de licence ne peut être supérieure à celle de fin licence !!!";
                    } else {
                        axios.post(route("updateAdminEnt", {
                            tableau: this.data,
                            nom: this.nom,
                            prenom: this.prenom,
                            enterprise: this.enterprise,
                            start: this.start,
                            end: this.end
                        })).then(response => {
                            if (response.data.error) {
                                this.color = 'text-red-600';
                                this.message = response.data.error;
                            } else {
                                this.color = 'text-green-600';
                                this.message = response.data.success;
                                this.onLoad();
                                setTimeout(() => {
                                    this.hiddenUpdate();
                                }, 1500);
                            }
                        })
                    }
                }
            },

            // Fonction pour supprimer un administrateur d'entreprise
            delSup(id) {
                Swal.fire({
                    title: "Êtes-vous sûr(e)?",
                    text: "Si vous supprimez l'administrateur de cette entreprise, vous supprimez directement tous les comptes utilisateurs reliés à lui !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Oui!",
                    cancelButtonText: "Non"
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(route("delSupAdminEnt", {
                            id: id
                        })).then(response => {
                            if (response.data.success) {
                                Swal.fire({
                                    text: response.data.success,
                                    icon: "success",
                                    confirmButtonColor: "green",
                                });
                                this.onLoad();
                            } else {
                                Swal.fire({
                                    text: response.data.error,
                                    icon: 'error',
                                    confirmButtonColor: "red",
                                })
                            }
                        })
                    }
                });
            },
        },
        mounted() {
            this.onLoad();
        }
    }
</script>