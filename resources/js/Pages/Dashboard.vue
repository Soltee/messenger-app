<template>
    <Head title="Home" />


    <BreezeAuthenticatedLayout>
        <template #tab>
            
            <div class="h-full flex flex-col bg-white shadow-xl ">
                <div class="border-b border-gray-200 py-4 px-4 ">
                    <!-- Search -->
                        <div class="flex items-center relative">
                            <svg 
                                @click="reset()"
                                class="feather h-6 w-6 cursor-pointer absolute right-0 left-0 mt-0 ml-1 text-gray-900 hover:opacity-50"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            <BreezeInput 
                                id="keyword" type="keyword" 
                                class="bg-white rounded-lg shadow-md text-gray-900 block w-full pl-8 py-2 focus:border-transparent focus:border-none focus:ring-0  focus:outline-none opacity-1" 
                                v-model="keyword"  autofocus autocomplete="keyword" 
                                placeholder="Search rooms.."/>
                        </div>

                        <div class="flex items-center mt-2 overflow-x-auto">
                            

                            <li 
                                @click="type = 'joined'"
                                class="mr-3  w-auto py-2 group text-lg font-semibold flex text-gray-300 border-b-2 border-transparent hover:border-gray-900 cursor-pointer w-full"
                                :class="isJoined">
                               
                                <span 
                                    class="ml-3  transition group-hover:text-gray-900"
                                    :class="{ '': isJoined }">Joined</span>
                            </li>
                            <li 
                                @click="type = 'available'"

                                class="py-2 group text-lg font-semibold flex text-gray-300 border-b-2 border-transparent hover:border-gray-900 cursor-pointer w-full"
                                :class="isAvailable">
                               
                                <span 
                                    class="ml-3  transition group-hover:text-gray-900"
                                    :class="{ '': isAvailable }"
                                    >Browse</span>
                            </li>

                            <li 
                                class="list-none">
                                <span class="py-2 ">{{ rooms.total }}</span>
                            </li>

                        </div>
                
                </div>
                <div class="flex-1 overflow-y-auto px-4">
                    
                    <div class="">
                      <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200">
                            <li 
                                v-for="room in rooms.data"
                                class="py-6 flex">

                                <div class="flex-shrink-0 w-12 h-12 border border-gray-200 rounded-md overflow-hidden">
                                    <img 
                                    :src="`https://ui-avatars.com/api/?name=${room.user.name}&background=fff&color=3857fe`" 
                                    alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." 
                                    class="w-full h-full object-center object-cover">
                                </div>
                                <div class="ml-4 flex-1 flex justify-between">
                                    <div class="flex flex-col">
                                        <h1 class="text-lg text-gray-900">
                                            {{ limit(room.name, 12) }}
                                        </h1>
                                        <span class="text-xs text-gray-900 -mt-1">{{ format(room.created) }}</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-md text-gray-900">Joined</span>
                                        <span class="text-xs font-medium text-gray-900">{{ room.users }}</span>
                                    </div>
                                </div>
                            </li>
                            
                           
                        </ul>
                      </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 py-4 px-4 flex flex-wrap">
                    <template v-for="(link, key) in rooms.links">
                    
                        <div 
                            v-if="link.url === null"  >
                            <span
                                :key="key" 
                                class="px-6 py-1 text-gray-900 text-lg opacity-50 border border-gray-900 mr-2 rounded" >
                                {{ link.label }}
                            </span>
                        </div>

                        <Link 
                            v-else
                            :href="link.url" 
                            :class="classes"
                            class="mb-4">

                            <span
                                :key="key" 
                                class="cursor-pointer mr-1 mb-1 px-6 py-1 text-lg border text-gray-900 rounded hover:bg-gray-900 hover:text-white border border-gray-900 focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-gray-900 text-gray-900': link.active, 'ml-auto': link.label === 'Next' }" >
                                {{ link.label }}
                            </span>
                        </Link>


                    </template>
                </div>
            </div>

        </template>

        <div>

            Content
            
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
import BreezeLabel from '@/Components/Label.vue'
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'

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
        BreezeButton,

        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,


        authenicated : Object,
        rooms        : Object,
        joinedRooms  : Object
    },
    data(){
        return {
            formStatus : false,
            processing :false,
            loginForm  : {
                email    : '',
                password : '',
                remember : false,
            },
            signupForm : {
                name     : '',
                email    : '',
                password : '',
                password_confirmation  : '',
            },


            keyword : '',
            type    : '',
            loading : false
        }
    },
    computed: {
        errors() {
            this.processing  = false;
            return this.$page.props.errors
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0
        },
        isJoined() {
            return {
              'border-gray-900 text-gray-900': this.type === 'joined'
            }
        },
        isAvailable() {
            return {
              'border-gray-900 text-gray-900': this.type === 'available'
            }
        },
    },
    watch: {
        keyword: {
            handler: throttle(function() {
                this.$inertia.replace(route('dashboard', {search :this.keyword}))
              }, 200),
            deep: true,
        },
        type: {
            handler: throttle(function() {
                this.$inertia.replace(route('dashboard', {type :this.type}))
              }, 200),
            deep: true,
        },
        
    },
    methods: {
        format(date){
            dayjs.extend(relativeTime)
            return dayjs(date).from() // in 22 years
                // return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
        },
        limit(string, num){
           return string.substring(0, num);
        },
        reset(){
            this.keyword = '';
            this.type    = '';
        }
    }
};
</script>

<style>
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: #ffffff;
    }

</style>
