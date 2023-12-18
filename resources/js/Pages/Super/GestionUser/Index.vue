<script setup>
import AuthenticatedLayout from '@/Layouts/LayoutDash.vue';
import NavBar from '@/Layouts/navBarDash.vue';
import { Head, Link } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
</script>
<template>
    <Head title="Dashboard-Gestion des utilisateurs" />

    <AuthenticatedLayout>
    </AuthenticatedLayout>
    <div class="fixed top-0 bottom-0 right-0 lg:w-[85%] lg:h-screen z-50">
        <NavBar :niveau="'Gestion des utilisateurs'" />

        <div class="mx-auto lg:w-[80%] lg:mt-[80px] shadow-2xl rounded">
            <div class="lg:py-4 lg:px-2">
                <div class="flex items-center justify-between lg:mb-4">
                    <div class="relative lg:basis-[70%]">
                        <div class="flex items-center gap-4">
                            <button @click="showCreate"
                                class="bg-blue-700 lg:py-1.5 hover:bg-blue-800 lg:px-4 rounded text-white flex justify-center items-center gap-2">Créer
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="white" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg></button>
                            <button @click="showCreate1"
                                class="bg-green-700 lg:py-1.5 hover:bg-green-800 lg:px-4 rounded text-white flex justify-center items-center gap-2 basis-[35%]">Créer
                                via fichier excel(csv) <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg></button>
                            <button @click="showList"
                                class='bg-orange-600 lg:py-1.5 hover:bg-orange-700 lg:px-4 rounded text-white flex justify-center items-center gap-2'>Actions
                                <span v-if="variableBool">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                </span>
                                <span v-else>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span></button>
                            <transition>
                                <div v-if="variableBool"
                                    class="z-50 absolute lg:top-10 lg:left-[448px] bg-white rounded lg:w-[125px] shadow-2xl">
                                    <span @click="updateUser"
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between border-gray-100 border-b-[1px]">
                                        Modifier
                                    </span>
                                    <span @click="deleteUser"
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between">
                                        Supprimer
                                    </span>
                                </div>
                            </transition>
                            <div @click="showList1"
                                class="flex justify-center items-center gap-2 border border-[1px] rounded lg:py-1.5 cursor-pointer lg:px-4">
                                <span>Pages : </span>
                                <span>{{ pagesNumber }}</span>
                            </div>
                            <transition>
                                <div v-if="variableBool1"
                                    class="z-50 absolute lg:top-10 lg:left-[580px] bg-white rounded lg:w-[125px] shadow-2xl lg:max-h-[184px] overflow-y-auto">
                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between border-gray-100 border-b-[1px]">
                                        Page 1
                                    </span>
                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between">
                                        Page 2
                                    </span>
                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between border-gray-100 border-b-[1px]">
                                        Page 3
                                    </span>
                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between">
                                        Page 4
                                    </span>
                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between border-gray-100 border-b-[1px]">
                                        Page 5
                                    </span>
                                    <span
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 transition duration-150 ease-in-out cursor-pointer flex items-center justify-between">
                                        Page 6
                                    </span>
                                </div>
                            </transition>
                        </div>
                    </div>
                    <div class="basis-[20%] flex justify-end">
                        <input type="text"
                            class="lg:basis-[25%] rounded-full outline-none focus:border-gray-500 focus:ring-gray-500 lg:py-1"
                            placeholder="Recherchez un nom">
                    </div>
                </div>
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full">
                        <thead class="bg-gray-200 sticky top-0 shadow-xl">
                            <th class="py-3 text-sm w-[5%]">
                                <input type="checkbox">
                            </th>
                            <th class="py-3 text-sm w-[15%]">Matricule</th>
                            <th class="py-3 text-sm w-[15%]">Nom</th>
                            <th class="py-3 text-sm w-[15%]">Prénom(s)</th>
                            <th class="py-3 text-sm w-[15%]">Adresse électronique</th>
                            <th class="py-3 text-sm w-[15%]">Rôle</th>
                            <th class="py-3 text-sm w-[15%]">Entreprise reliée</th>
                        </thead>
                        <tbody>
                            <tr class="border-gray-400 border-b-[1px]" v-for="(el, i) in users" :key="i">
                                <td class="py-2 text-center"><input v-if="el.idRoleName !== 1" type="checkbox"
                                        class="checkbox" @change="changeValue(el)"></td>
                                <td class="py-2 text-center">{{ el.matricule }}</td>
                                <td class="py-2 text-center">{{ el.lastname }}</td>
                                <td class="py-2 text-center">{{ el.firstname }}</td>
                                <td class="py-2 text-center">{{ el.email }}</td>
                                <td class="py-2 text-center">{{ el.role_name }}</td>
                                <td class="py-2 text-center">{{ el.entreprise_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="rounded-b lg:py-2 lg:px-2 flex justify-between items-center bg-gray-200">
                <span class="font-bold">Total de données : </span>
                <span class="bg-blue-700 text-sm text-white lg:py-1.5 lg:px-8 rounded">{{users.length}}</span>
            </div>
        </div>
    </div>

    <div id="menuMini" class="hidden relative flex justify-center items-center z-50">
        <div class="w-full h-full bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
        </div>
    </div>
    <div id="formHidden"
        class="hidden absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 shadow-2xl bg-white rounded-lg lg:w-[25%] flex flex-col gap-2 z-50">
        <div class="bg-amber-600 text-white text-center lg:p-2 rounded-t-lg">
            Création d'un compte utilisateur
        </div>
        <form @submit.prevent="createForm" class="flex p-6 flex-col gap-4">
            <div v-if="message" :class="'my-2 md:my-4 text-sm text-center font-bold ' + color">{{ message }}</div>
            <div class="lg:basis-[100%]">
                <input rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
              sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Nom de famille*"
                    v-model="nom" required />
            </div>
            <div class="lg:basis-[100%]">
                <input rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
              sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Prénoms*"
                    v-model="prenom" required />
            </div>
            <div class="lg:basis-[100%]">
                <input rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
              sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Matricule"
                    v-model="matricule" />
            </div>
            <div class="lg:basis-[100%]">
                <input rows="4" type="email" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
      sm:leading-5 resize-none focus:outline-none focus:border-gray-200" placeholder="Adresse électronique*"
                    v-model="email" required />
            </div>
            <div class="lg:basis-[100%]">
                <select v-model="roleName" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
      sm:leading-5 resize-none focus:outline-none focus:border-gray-200" required>
                    <option selected disabled>Sélectionnez un rôle</option>
                    <option v-for="(el) in roles" :value="el.id">{{ el.role_name }}</option>
                </select>
            </div>
            <div class="lg:basis-[100%]" v-if="$page.props.auth.user.idRole === 1">
                <select v-model="entreprises" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
      sm:leading-5 resize-none focus:outline-none focus:border-gray-200" required>
                    <option selected disabled>Sélectionnez une entreprise</option>
                    <option v-for="(el) in entreprise" :value="el.id">{{ el.entreprise_name }}</option>
                </select>
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
                <div class="absolute top-2 right-2 cursor-pointer lg:w-[25px] lg:h-[25px] flex justify-center items-center bg-gray-300 hover:bg-gray-500 hover:text-white rounded-full"
                    @click="hiddenCreate">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </form>
    </div>


    <div id="menuMini1" class="hidden relative flex justify-center items-center z-50">
        <div class="w-full h-full bg-gray-900 bg-opacity-80 top-0 fixed sticky-0">
        </div>
    </div>
    <div id="formHidden1"
        class="hidden absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 shadow-2xl bg-white rounded-lg lg:w-[25%] flex flex-col gap-2 z-50">
        <div class="bg-amber-600 text-white text-center lg:p-2 rounded-t-lg">
            Création d'un compte utilisateur via fichier csv
        </div>
        <form @submit.prevent="createForm1" class="flex p-6 flex-col gap-4">
            <div v-if="message" :class="'my-2 md:my-4 text-sm text-center font-bold ' + color">{{ message }}</div>
            <div class="lg:basis-[100%]">
                <input rows="4" id="fileChoice" type="file" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
              sm:leading-5 resize-none focus:outline-none focus:border-gray-200" required />
            </div>
            <div class="lg:basis-[100%]" v-if="$page.props.auth.user.idRole === 1">
                <select v-model="entrepriseAdmin" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
      sm:leading-5 resize-none focus:outline-none focus:border-gray-200" required>
                    <option selected disabled>Sélectionnez une entreprise</option>
                    <option v-for="(el) in entreprise" :value="el.id">{{ el.entreprise_name }}</option>
                </select>
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
                <div class="absolute top-2 right-2 cursor-pointer lg:w-[25px] lg:h-[25px] flex justify-center items-center bg-gray-300 hover:bg-gray-500 hover:text-white rounded-full"
                    @click="hiddenCreate1">
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
                variableBool: false,
                variableBool1: false,
                pagesNumber: 1,
                check: [],
                users: [],
                roles: [],
                entreprise: [],
                entreprises: null,
                roleName: null,
                message: null,
                color: null,
                entrepriseAdmin: null,
                nom: null,
                prenom: null,
                email: null,
                matricule: null,
            }
        },

        methods: {
            // Fonction pour décocher
            decocher() {
                this.check = [];
                let chec = document.querySelectorAll(".checkbox");
                chec.forEach(el => {
                    el.checked = false;
                })
            },

            // Fonction supprimer un ou plusieurs utilisateurs
            deleteUser() {
                this.variableBool = !this.variableBool;
                if (this.check.length === 0) {
                    Swal.fire({
                        text: "Veuillez sélectionner au moins un utilisateur !!!",
                        icon: 'error',
                        confirmButtonColor: "red",
                    })
                } else {
                    axios.delete(route("deleteUser", {
                        tableau: this.check,
                    })).then(response => {
                        this.decocher();
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
                            })
                            this.onLoad();
                        }
                    })
                }
            },

            updateUser() {
                this.variableBool = !this.variableBool;
                if (this.check.length === 0) {
                    Swal.fire({
                        text: response.data.error,
                        icon: 'error',
                        confirmButtonColor: "red",
                    })
                }
            },

            // Fonction pour ajouter des données da mon tableau check
            changeValue(el) {
                let x = false;
                if (this.check.length === 0) {
                    this.check.push(el);
                } else {
                    let tab = [];
                    this.check.forEach(element => {
                        if (element.id === el.id) {
                            x = true;
                        } else {
                            tab.push(element);
                        }
                    })
                    if (x === false) {
                        this.check.push(el);
                    } else {
                        this.check = tab;
                    }
                }
            },

            // Fonction exécutant une fonction dans le backend pour créer un utilisateur
            createForm() {
                if (this.nom.trim() === "" || this.prenom.trim() === "") {
                    this.color = 'text-red-500';
                    this.message = "Veuillez bien remplir tous les champs !!!";
                } else {
                    this.color = null;
                    this.message = null;
                    axios.post(route('createUserNew'), {
                        nom: this.nom.trim(),
                        prenom: this.prenom.trim(),
                        email: this.email,
                        matricule: this.matricule,
                        entreprises: this.entreprises,
                        role: this.roleName
                    }).then(response => {
                        if (response.data.success) {
                            this.hiddenCreate();
                            this.onLoad();
                        } else {
                            this.color = 'text-red-500';
                            this.message = response.data.error
                        }
                    })
                }
            },
            // Fonction exécutant une fonction dans le backend pour créer un utilisateur via un fichier csv
            createForm1() {
                let formData = new FormData();
                let img = fileChoice.files[0];
                formData.append("myFile", img);
                formData.append("entreprise", this.entrepriseAdmin);
                axios.post(route('createUser'), formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    }
                }).then(response => {
                    if (response.data.success) {
                        this.hiddenCreate1();
                        this.onLoad();
                    } else {
                        this.color = 'text-red-500';
                        this.message = response.data.error
                    }
                })
            },

            // fonction pour afficher le formulaire de création d'un compte utilisateur
            showCreate() {
                menuMini.classList.remove("hidden");
                formHidden.classList.remove("hidden");
            },
            // fonction pour afficher le formulaire de création d'un compte utilisateur via fichier csv
            showCreate1() {
                menuMini1.classList.remove("hidden");
                formHidden1.classList.remove("hidden");
            },

            // fonction pour masquer le formulaire de création d'un compte utilisateur
            hiddenCreate() {
                this.color = null;
                this.message = null;
                this.nom = null;
                this.prenom = null;
                this.matricule = null;
                this.email = null;
                this.roleName = null;
                this.entreprises = null;
                menuMini.classList.add("hidden");
                formHidden.classList.add("hidden");
            },

            // fonction pour masquer le formulaire de création d'un compte utilisateur via fichier csv
            hiddenCreate1() {
                this.entrepriseAdmin = null;
                this.color = null;
                this.message = null;
                fileChoice.value = null;
                menuMini1.classList.add("hidden");
                formHidden1.classList.add("hidden");
            },

            // Fonction pour afficher les différentes actions qu'on peut mener
            showList() {
                this.variableBool = !this.variableBool;
                this.variableBool1 = false;
            },

            // Fonction pour afficher les différentes pages comportant des données
            showList1() {
                this.variableBool1 = !this.variableBool1;
                this.variableBool = false;
            },

            // fonction pour recharger les données de la page
            onLoad() {
                axios.get(route("indexUser")).then(response => {
                    this.users = response.data.users;
                    this.roles = response.data.roles;
                    this.entreprise = response.data.entreprise;
                })
            },
        },
        mounted() {
            this.onLoad();
        }
    }
</script>

<style>
.v-enter-active {
    transition: all 0.8s;
}

.v-leave-active {
    transition: all 0.5s;
}

.v-enter-from {
    opacity: 0;
    transform: translateY(-20px);
}

.v-enter-to {
    opacity: 1;
    transform: translateY(0px);
}

.v-leave-from {
    transform: translateY(0px);
}

.v-leave-to {
    transform: translateY(-10px);
    opacity: 0;
}
</style>