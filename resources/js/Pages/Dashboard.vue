<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                        <div v-for="r in rooms" class="bg-white shadow-2xl rounded-lg mb-4 px-3 py-3 transform hover:-rotate-6">
                            <a :href="`/rooms/${r.id}`">
                                <div class="flex justify-between items-center mb-2">
                                    <h1>
                                        <a :href="`/rooms/${r.id}`">
                                            {{ r.name }}
                                        </a>
                                    </h1>
                                    <span class="">{{ r.messages }}</span>
                                </div>
                                <span>{{ r.created }}</span>
                                
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        authenicated : Object,
        rooms        : Array
    }
};
</script>
