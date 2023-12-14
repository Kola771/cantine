<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

</script>


<template>
    <div class="absolute top-[27%] left-[18%] w-[80px] h-[80px] md:w-[100px] md:h-[100px] lg:w-[100px] lg:h-[100px] rounded-full bg-blue-800 sm:top-[24%] sm:left-[8%] md:top-[19%] md:left-[10%] lg:top-[8%] lg:left-[20%] z-0 blur border-white border-2">
    </div>
    <div class="absolute top-[69%] left-[69%] w-[80px] h-[80px] md:w-[100px] md:h-[100px] lg:w-[160px] lg:h-[160px] rounded-full bg-orange-600 lg:top-[660px] lg:left-[1270px] z-0 blur border-white border-2">
    </div>
    <div class="absolute top-[27%] left-[18%] w-[80px] h-[80px] md:w-[100px] md:h-[100px] lg:w-[120px] lg:h-[120px] rounded-full bg-red-600 sm:top-[24%] sm:left-[8%] md:top-[19%] md:left-[10%] lg:top-[70%] lg:left-[-1%] z-0 blur border-white border-2">
    </div>
    <div class="absolute top-[69%] left-[69%] w-[80px] h-[80px] md:w-[100px] md:h-[100px] lg:w-[180px] lg:h-[180px] rounded-full bg-yellow-600 lg:top-[10%] lg:left-[90%] z-0 blur border-white border-2">
    </div>
    <div id="menu"
        class="fixed top-0 bottom-0 left-0 bg-white/10 col-span-3 p-4 hidden lg:block lg:w-[15%] bg-gray-100 border border-r-[1px] z-50">
        <div class="flex items-center justify-between">
            <a href="#"
                class="flex flex-col space-y-2 md:space-y-0 md:flex-row mb-2 items-center md:space-x-2 hover:bg-white/10 group transition duration-150 ease-linear rounded-lg group w-full">
                <div
                    :class="'bg-red-500 lg:w-[50px] lg:h-[50px] rounded-full flex items-center justify-center uppercase text-white font-bold'">
                    {{ $page.props.auth.user.lastname[0] }}{{ $page.props.auth.user.firstname[0] }}</div>
                <div class="flex flex-col items-center">
                    <p class="font-medium group-hover:text-orange-600 text-[12px] text-black text-black">{{ $page.props.auth.user.firstname }} {{ $page.props.auth.user.lastname[0] }}.</p>
                    <p class="font-medium group-hover:text-orange-600 text-[12px] text-black text-black">Connecté(e)</p>
                </div>
            </a>
            <h1 class="font-bold text-lg shadow-xl px-2 border-red-300 border-[1px] rounded-2xl">
                <span class="text-2xl">R</span><span class="text-red-600">esto</span></h1>
        </div>
        <hr class="my-2 border-slate-700">
        <div id="menu" class="flex flex-col space-y-2 my-5">
            <Link href="/dashboard" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="black" class="w-6 h-6 group-hover:text-orange-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                    </div>
                    <div>
                        <p class="font-bold text-base lg:text-md text-black leading-4 group-hover:text-orange-600">
                            Dashboard
                        </p>
                    </div>

                </div>
            </Link>
            <a href="#" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group" @click="navUser()">
                <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="black" class="w-6 h-6 group-hover:text-orange-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div class="w-full">
                        <p class="font-bold text-base lg:text-md text-black leading-4 group-hover:text-orange-600 flex justify-between items-center">
                            Utilisateurs
                            <div v-if="varBool1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                        <div v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                        </p>
                    </div>

                </div>
            </a>
            <div id="idUser" class="hidden flex flex-col gap-2 my-5 mx-auto w-[80%]">
                <Link :href="route('adminEnterprise')" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-2 px-2 group">
                    <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="black" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-base lg:text-sm text-black leading-4 group-hover:text-orange-600">
                               Administrateurs entreprises
                            </p>
                        </div>
                    </div>
                </Link>
                <Link :href="route('gestionUserIndex')" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-2 px-2 group">
                    <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="black" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-base lg:text-sm text-black leading-4 group-hover:text-orange-600">
                               Gestion des utilisateurs
                            </p>
                        </div>
                    </div>
                </Link>
            </div>
            <a href="/" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="black" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-base lg:text-md text-black leading-4 group-hover:text-orange-600">
                            Accueil</p>
                    </div>

                </div>
            </a>
            <a href="#" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="black" class="w-6 h-6 group-hover:text-orange-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                    </div>
                    <div>
                        <p class="font-bold text-base lg:text-md text-black leading-4 group-hover:text-orange-600">
                            Paramètrages
                        </p>
                    </div>

                </div>
            </a>
        </div>

    </div>
</template>


<script>
export default {
    data() {
        return {
            varBool: true,
            varBool1: true,
            x: 0,
            y: 0,
        }
    },
    props: {
        bgColor: String,
        pseudo: String,
    },
    methods: {
        navArticle() {
            if (this.x === 0) {
                this.varBool = false;
                this.varBool1 = true;
                idUser.classList.add("hidden")
                this.y = 0;
                this.x++
            } else {
                this.varBool = true;
                this.x = 0;
            }
        },
        navUser() {
            if (this.y === 0) {
                this.varBool1 = false;
                this.varBool = true;
                idUser.classList.remove("hidden")
                this.x = 0;
                this.y++
            } else {
                this.varBool1 = true;
                idUser.classList.add("hidden")
                this.y = 0;
            }
        }
    },
};
</script>
