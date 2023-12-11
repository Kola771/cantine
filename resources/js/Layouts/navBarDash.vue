<script setup>
import { ref } from 'vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

</script>
<template>
    <nav
        class="flex bg-white/10 lg:justify-between lg:items-center mx-auto lg:px-1 lg:py-[18.5px] border-[#333] border-b-[1px] shadow bg-gray-100">
        <div class="lg:basis-[50%]">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight lg:ml-4">Dashboard<span class="text-red-600" v-if="niveau">/{{ niveau }}</span></h2>
        </div>
        <div class="lg:basis-[50%] flex lg:justify-end">
            <ul class="flex lg:gap-2 lg:items-center">
                <li class="cursor-pointer flex gap-4 items-center mr-4" @click="openAndClose">
                    <div
                        :class="'bg-red-500 lg:w-[45px] lg:h-[45px] rounded-full flex items-center justify-center uppercase text-white font-bold'">
                        {{ $page.props.auth.user.lastname[0] }}{{ $page.props.auth.user.firstname[0] }}</div>
                    <span class="font-bold">{{ $page.props.auth.user.firstname }} {{ $page.props.auth.user.lastname
                    }}</span>
                    <div v-if="varBool">
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
                </li>
            </ul>
        </div>
        <div class="hidden lg:absolute lg:top-[80px] lg:right-[30px] lg:w-[10%] lg:shadow-xl bg-white rounded border-gray-300 border-[1px]"
            id="navList">
            <ul class="flex flex-col w-full">

                <DropdownLink :href="route('profile.edit')"> Mon profil </DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">
                    Déconnexion
                </DropdownLink>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    props: {
        niveau: String,
    },
    data() {
        return {
            varBool: true,
            x: 0
        }
    },
    methods: {
        openAndClose() {
            if (this.x === 0) {
                this.varBool = false;
                navList.classList.add("lg:flex")
                this.x++
            } else {
                this.varBool = true;
                navList.classList.remove("lg:flex")
                this.x = 0;
            }
        },
    },
}
</script>