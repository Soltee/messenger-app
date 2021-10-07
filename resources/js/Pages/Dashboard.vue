<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->

        <div class="max-w-7xl mx-auto px-4 my-2 sm:px-6 lg:px-8">
            <div class="flex ">
                <div class="flex flex-col text-center items-center w-64 bg-white rounded-l-lg px-3 py-3">
                    <img
                        class="rounded-full w-24 h-24 mb-3" 
                        :src="`https://ui-avatars.com/api/?name=${authenicated.name}`" >

                    <!-- Joined Rooms -->
                    <!-- {{joinedRooms}} -->

                    <div class="mt-4 w-full">
                        <h3 class="text-md text-primary-blue">Joined Rooms</h3>
                        <div class="flex flex-col w-full mt-2">
                            <div v-for="jr in joinedRooms"
                                 class="w-full bg-white shadow-lg rounded-lg mb-5 px-3 py-3 w-full ransform hover:-rotate-2 transition">
                                <a :href="`/rooms/${jr.id}`">
                                    <div class="flex justify-between items-center mb-2">
                                        <h1 class="text-lg">
                                            {{ limit(jr.name) }}
                                        </h1>
                                        <span class="text-md font-medium text-primary-blue">{{ jr.users }} joined</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 bg-white rounded-r-lg py-3 px-3 md:pr-3">

                    <div class="mb-4">
                        
                        <div class="flex justify-between items-center">
                            <h1 class="text-lg font-semibold">
                                <span class="mr-2">{{ rooms.total }}</span>
                                Available Rooms
                            </h1>
                            <div class="flex items-center">
                                <BreezeInput 
                                    id="keyword" type="keyword" 
                                    class="mt-1 block w-full px-3 py-2 focus:border-transparent focus:border-primary-blue" 
                                    v-model="keyword"  autofocus autocomplete="keyword" />

                                
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-5">
                        <div 
                            v-for="r in rooms.data" 
                            class="bg-white shadow-lg rounded-lg mb-5 px-3 py-3 transform hover:-rotate-2 transition">
                            <a :href="`/rooms/${r.id}`">
                                <div class="flex justify-between items-center mb-2">
                                    <h1>
                                        <a :href="`/rooms/${r.id}`" class="text-lg">
                                            {{ r.name }}
                                        </a>
                                    </h1>
                                    <span class="text-md font-medium text-primary-blue">{{ r.users }} joined</span>
                                </div>
                                <span>{{ format(r.created) }}</span>
                                
                            </a>
                        </div>
                    </div>

                    <!-- Pagination forAvailble Rooms -->
                    <!-- {{rooms.total}} -->
                    <div class="mt-6 -mb-1 flex flex-wrap">
                        <template v-for="(link, key) in rooms.links">
                            <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400" :class="{ 'ml-auto': link.label === 'Next' }">
                                {{ link.label }}
                            </div>
                            <div v-else>
                                
                                <Link :href="link.url" :class="classes">

                                    <span
                                        :key="key" 
                                        class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }" >
                                        {{ link.label }}
                                    </span>
                                </Link>

                            </div>

                        </template>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeInput from '@/Components/Input.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
let dayjs = require('dayjs');

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        BreezeInput
    },
    props: {
        authenicated : Object,
        rooms        : Object,
        joinedRooms  : Object
    },
    data(){
        return {
            keyword : '',
            loading : false
        }
    },
    methods: {
        // getMoreRooms(link){
        //     axios.get(`${link}`)
        //     .then(res => {
        //         if(res.status == 200)
        //         {
        //             this.joinedRooms.push(res.data);
        //         }
        //     }).catch(err => {
        //         console.log(err);
        //     });
        // },
        format(date){
                return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
        },
        limit(string){
           return string.substring(0, 15);
        }
    }
};
</script>
