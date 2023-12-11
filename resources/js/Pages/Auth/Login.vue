<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

// const submit = () => {
//     form.post(route('login'), {
//         onFinish: () => form.reset('password'),
//     });
// };
</script>

<template>
    <div class="absolute top-[27%] left-[18%] w-[80px] h-[80px] md:w-[100px] md:h-[100px] lg:w-[150px] lg:h-[150px] rounded-full bg-blue-800 sm:top-[24%] sm:left-[8%] md:top-[19%] md:left-[10%] lg:top-[170px] lg:left-[500px] z-0 blur border-white border-2">
    </div>
    <div class="absolute top-[69%] left-[69%] w-[80px] h-[80px] md:w-[100px] md:h-[100px] lg:w-[150px] lg:h-[150px] rounded-full bg-orange-600 sm:top-[70%] sm:left-[79%] md:top-[72%] md:left-[78%] lg:top-[660px] lg:left-[1270px] z-0 blur border-white border-2">
    </div>
    <div class="h-screen w-full flex justify-center items-center pt-6 sm:pt-0 bg-gray-800">
        <div>
            <Link href="/">
            </Link>
        </div>

        <div class="w-full max-w-[50%] md:max-w-[70%] sm:max-w-[75%] lg:max-w-[40%] h-[350px] sm:h-[400px] md:h-[450px] mt-6 bg-white shadow-md overflow-hidden sm:rounded-lg z-50">

            <Head title="Se connecter" />

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>
            <div class="flex h-full sm:justify-between">
                <div class="hidden basis-[48%] sm:flex justify-center items-center bg-[url('/storage/imgCantine/cantine.jpg')] bg-no-repeat bg-cover">
                    <div>
                        <span class="bg-white sm:w-[90px] sm:h-[90px] rounded-full flex items-center justify-center sm:opacity-80"> <span class="lg:text-3xl">R</span><span class="text-red-600">esto</span></span>
                    </div>
                </div>
                <form @submit.prevent="submit" class="basis-full relative sm:basis-1/2 px-4 py-8 sm:p-0">
                    <div class="mx-auto w-[90%] sm:mt-[30%] md:mt-[25%]">
                        <div v-if="message" :class="'my-2 md:my-4 text-sm text-center font-bold ' + color ">{{ message }}</div>
                        <div>
                            <InputLabel for="email" value="Adresse électronique" />
                            <TextInput id="email" type="email" class="mt-1 block w-full sm:px-2 sm:py-1 md:px-2.5 md:py-2" v-model="email" required
                                autofocus autocomplete="username" placeholder="Entrez votre adresse électronique" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="password" value="Mot de passe" />
                            <TextInput id="password" type="password" class="mt-1 block w-full sm:px-2 sm:py-1 md:px-2.5 md:py-2" v-model="password"
                                required autocomplete="current-password" placeholder="Entrez votre mot de passe" />
                        </div>
                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="remember" required/>
                                <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <!-- <Link :href="route('password.request')" -->
                            <Link :href="route('logIn')"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Mot de passe oublié?
                            </Link>
                            <button
                                class="inline-flex items-center px-2 py-3 md:px-4 md:py-3 bg-blue-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-4 absolute bottom-4"
                                :class="{ 'opacity-25': form.processing }">
                                Connexion
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: null,
            password: null,
            remember: true,
            color: null,
            message: null,
        }
    },
    methods: {
        submit() {
            axios.post(route("login"), {
                email: this.email,
                password: this.password,
                remember: this.remember
            }).then(response => {
                if(response.data.error)
                {
                    this.color = 'text-red-600';
                    this.message = response.data.error;
                } else {
                    this.color = 'text-green-600';
                    this.message = "Connexion réussie !!!";
                    window.location.href = response.data.success;
                }
            })
        }
    }
}
</script>