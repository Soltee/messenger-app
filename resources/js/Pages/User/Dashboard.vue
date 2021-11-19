<template>
    <Head title="Dashboard" />


    <BreezeAuthenticatedLayout>
        
        <div class="overflow-y-auto h-screen px-4 py-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 w-full">

            <div class="">
                <div class="px-3 py-3 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center"> 
                        <p class="font-bold text-md uppercase text-gray-900 dark:text-white">
                            Joined Rooms
                        </p>
                        <span class="text-lg font-semibold">
                            {{ joinedRoomsTotal }} Total
                        </span>
                    </div>

                    <div 
                        v-for="jr in joinedRooms"
                        class="mt-3 flex flex-col mb-3">
                        
                        <h2 class="text-semibold text-lg">{{jr.name}}</h2>
                        <span class="text-xs -mt-1">{{ format(jr.created_at) }}</span>
                    </div>
                </div>

            </div>

            <div class="px-3 py-3 rounded-lg shadow-lg">
                <div class="flex justify-between items-center"> 
                    <p class="font-bold text-md uppercase text-gray-900 dark:text-white">
                        Created Roooms
                    </p>
                    <span class="text-lg font-semibold">
                        {{ createdRoomsTotal }} Total
                    </span>
                </div>

                <div 
                    v-for="cr in createdRooms"
                    class="mt-3 flex flex-col mb-3">
                    <h2 class="text-semibold text-lg">{{cr.name}}</h2>
                    <span class="text-xs -mt-1">{{ format(cr.created_at) }}</span>
                </div>
            </div>

            <div class="px-3 py-3 rounded-lg shadow-lg">
                <div class="flex justify-between items-center"> 
                    <p class="font-bold text-md uppercase text-gray-900 dark:text-white">
                        Messages Sent
                    </p>
                    <span class="text-lg font-semibold">
                        {{ messagesTotal }} Total
                    </span>
                </div>

                <div 
                    v-for="message in messages"
                    class="mt-3 flex flex-col mb-3">
                    <h2 class="text-semibold text-lg">{{message.message}}</h2>
                    <span class="text-xs -mt-1">{{ format(message.created_at) }}</span>
                </div>
            </div>

        </div>

        
    </BreezeAuthenticatedLayout>

    
    
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import BreezeInput from '@/Components/Input.vue'

import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import throttle from 'lodash/throttle'
let dayjs = require('dayjs');
let relativeTime = require('dayjs/plugin/relativeTime')

export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Head,
        Link,
        BreezeInput,
    },
    props: {

        authenicated        : Object,
        joinedRooms         : Array,
        joinedRoomsTotal    : Number,
        createdRooms        : Array,
        createdRoomsTotal   : Number,
        messages            : Array,
        messagesTotal       : Number,

    },
    data(){
        return {
            
        }
    },
    computed: {
        

        errors() {
            this.roomForm.processing  = false;
            
            return this.$page.props.errors;
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0
        },
    },
    watch: {
        
    },
    mounted(){
    

    }, 
    methods: {
        format(date){
            dayjs.extend(relativeTime)
            return dayjs(date).from() // in 22 years
        },
        limit(string, num){
           return string.substring(0, num);
        },
    }
};
</script>

<style>
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: #ffffff;
    }

</style>
