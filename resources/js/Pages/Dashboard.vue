<script setup>
import AuthenticatedLayout from '@/Layouts/LayoutDash.vue';
import NavBar from '@/Layouts/navBarDash.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    </AuthenticatedLayout>
    <div class="fixed top-0 bottom-0 right-0 lg:w-[85%] lg:h-screen">
        <NavBar />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Vous êtes connectés en tant que : <span class="font-bold uppercase">{{
                        $page.props.auth.user.lastname }} {{ $page.props.auth.user.firstname }}</span> !</div>
                </div>
            </div>
        </div>
    </div>
</template>
