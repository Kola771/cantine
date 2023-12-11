<script setup>
import AuthenticatedLayout from '@/Layouts/LayoutDash.vue';
import NavBar from '@/Layouts/navBarDash.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    </AuthenticatedLayout>
    <div class="fixed top-0 bottom-0 right-0 lg:w-[85%] lg:h-screen z-50">
        <NavBar :niveau="'Administrateurs Entreprise'" />
        <div class="">
                <div class="flex justify-center items-center">
                    <form class="basis-[50%] lg:my-6 flex border border-b-2">
                        <div class="basis-[8%] flex justify-center items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="red" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                        </div>

                        <div class="flex justify-center items-center lg:gap-2 lg:basis-[84%]">
                            <input type="text" class="border-none w-full lg:py-2.5 outline-none" placeholder="Recherche par entreprise"
                                v-model="search">
                        </div>
                        <div class="cursor-pointer lg:basis-[8%] flex justify-center items-center" @click="reset">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </form>
                </div>
               <fieldset class="lg:p-2 border border-[1px] rounded shadow-xl mx-auto lg:max-w-[80%] overflow-y-auto">
                   <legend class="border bg-amber-600 text-white lg:py-2 lg:px-10 flex justify-center items-center lg:w-[30%] rounded-full"> Liste des administrateurs par entreprise</legend>
                   <div
                       class="mx-auto lg:p-3 lg:max-h-[700px] overflow-y-auto flex lg:gap-x-2 lg:gap-y-8 flex-wrap">
                       <div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 border-gray-300 border-[1px] hover:border-orange-600 basis-[23%]">
                           <div class="flex items-center lg:gap-2">
                               <div
                                   class="relative overflow-hidden rounded-l-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-[url('/storage/imgCantine/cantine.jpg')] bg-no-repeat bg-cover w-[150px] h-[120px]">
                               </div>
                               <div class="text-sm h-full">
                                <div>
                                    <span class="font-bold">Nom Complet :</span>
                                    <span>Charles-Emmanuel Berc</span>
                                </div>
                                <div>
                                    <span class="font-bold">Entreprise concernée :</span>
                                    <span>VIPP</span>
                                </div>
                               </div>
                           </div>
                           <div class="absolute bottom-0 w-full">
                               <div class="p-1 flex justify-end items-center gap-2">
                                   <span @click="updateCategory(el.id)"
                                       class="border p-1 rounded shadow-xl cursor-pointer"><svg
                                           xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                           stroke-width="1.5" stroke="green" class="font-bold w-5 h-5">
                                           <path stroke-linecap="round" stroke-linejoin="round"
                                               d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                       </svg>
                                   </span>
                                   <span @click="deleteCategory(el.id)"
                                       class="border p-1 rounded shadow-xl cursor-pointer"><svg
                                           xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                           stroke-width="1.5" stroke="red" class="font-bold w-5 h-5">
                                           <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                       </svg>
                                   </span>
                               </div>
                           </div>
                       </div>
                   </div>
               </fieldset>
        </div>
    </div>
</template>
