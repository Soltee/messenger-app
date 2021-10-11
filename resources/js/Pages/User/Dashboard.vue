<template>
    <Head title="Dashboard" />


    <BreezeAuthenticatedLayout>
        

        <template #tab>
            <div class="w-32 h-full  py-6">
   
                <div class="h-full flex flex-col bg-white w-full">
                    
                    <li 
                        @click="selectTab('rooms')"
                        class=" w-full py-2 group text-lg font-semibold flex text-gray-400 border-r-2 border-gray-300 mb-3 hover:border-gray-900 cursor-pointer w-full"
                        :class="isRooms">
                       
                        <span 
                            class=" px-4 transition group-hover:text-gray-900"
                            :class="{ '': isRooms }">Rooms</span>
                    </li>

                    <li 
                        @click="selectTab('create')"
                        class=" w-full py-2 group text-lg font-semibold flex text-gray-400 border-r-2 border-gray-300 mb-3 hover:border-gray-900 cursor-pointer w-full"
                        :class="isCreate">
                       
                        <span 
                            class=" px-4 transition group-hover:text-gray-900"
                            :class="{ '': isCreate }">Create</span>
                    </li>
                    
                </div>

            </div>

            <!-- -->
            <div
                class="bg-blue-100 w-80 h-full">
                <div
                    class="h-full flex flex-col bg-white shadow-xl ">
                    <!-- New Room Create -->
                    <div 
                        v-if="select === 'create'"
                        class="border-b border-gray-200 px-4 pt-4 mb-3">
                        <!-- New Rooms -->
                        <div class="flex items-center relative">
                            <svg 
                                @click="createNewRoom"
                                class="feather h-6 w-6 cursor-pointer absolute right-0 left-0 mt-0 ml-1 text-gray-900 hover:opacity-50"

                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            <BreezeInput 
                                id="name" type="text" 
                                class="bg-white rounded-lg shadow-md text-gray-900 block w-full pl-8 py-2 focus:border-transparent focus:border-none focus:ring-0  focus:outline-none opacity-1 "
                                @keyup="success = false"
                                :class="isSuccess" 
                                v-model="roomForm.name"  autofocus autocomplete="name" 
                                placeholder="Type name.."/>

                            <svg
                                v-if="roomForm.processing" 
                                class="absolute right-0 mt-0 mr-3 h-6 w-6 text-primary-blue"
                                xmlns="http://www.w3.org/2000/svg" 
                                xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" 
                                viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                <circle cx="50" cy="50" fill="none" stroke="#526cfe" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                </circle>
                            </svg>
                            <svg
                                v-if="success"
                                class="absolute right-0 mt-0 mr-3 h-6 w-6 text-green-500" 
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                ><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <div class="mt-1">
                            <div 
                                v-if="errors.name"
                                class="text-red-500 text-md font-semibold">
                                    {{ errors.name }}
                            </div>
                        </div>


                        
                    </div>
                    <div 
                        v-if="select === 'rooms'"
                        class="border-b border-gray-200 px-4 pt-4 shadow-xl">
                        <!-- Search -->
                            <div class="flex items-center relative mb-3">
                                <svg 
                                    @click="reset()"
                                    class="feather h-6 w-6 cursor-pointer absolute right-0 left-0 mt-0 ml-1 text-gray-900 hover:opacity-50"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                <BreezeInput 
                                    id="keyword" type="text" 
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

                    <!-- Rooms -->
                    <div
                        ref="roomsDiv"
                        id="roomsDiv"
                        class="flex-1 overflow-y-auto px-4">
                        
                        <div class="">
                            <div class="flow-root">
                                <ul role="list" class="divide-y divide-gray-200">
                                    <li 
                                        v-for="room in rooms"
                                        class="py-6 flex">

                                        <!-- <div class="flex-shrink-0 w-12 h-12 border border-gray-200 rounded-md overflow-hidden">
                                            <img 
                                            :src="`https://ui-avatars.com/api/?name=${room.user.name}&background=fff&color=3857fe`" 
                                            alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." 
                                            class="w-full h-full object-center object-cover">
                                        </div> -->
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

                            <div v-if="loading"
                                class="flex justify-center items-center my-3">
                                <svg 
                                    
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="36px" height="36px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                    <circle cx="50" cy="50" fill="none" stroke="#526cfe" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                      <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                    </circle>
                                </svg>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </template>


        <!-- Slot -->
        <div>

            <!-- Create -->
            <div 
                v-if="select === 'create'" 
                class="">
                
                Create

            </div>

            <!-- Rooms -->
            <div 
                v-if="select === 'rooms'" 
                class="">
                
                Rooms

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
// import _ from 'lodash';
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

        authenicated : Object,

    },
    data(){
        return {
            select    : 'create',
            roomsDiv  : document.getElementById('roomsDiv'),

            roomForm  : {
                name        : '',
                processing  : false,
            },
            success   : false,

            keyword   : '',
            type      : '',
            loading   : false,
            err       : false,
            roomsUrl  : '/rooms',
            rooms     : [],
            nextPage  : '',
        }
    },
    computed: {
        
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

        isCreate() {
            return {
              'border-gray-900 text-gray-900': this.select === 'create'
            }
        },
        isRooms() {
            return {
              'border-gray-900 text-gray-900': this.select === 'rooms'
            }
        },
        isSuccess(){
            return {
                'ring-2 ring-green-500' : this.success
            }
        },

        errors() {
            this.roomForm.processing  = false;
            
            return this.$page.props.errors;
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0
        },
    },
    watch: {
        keyword: {
            handler: throttle(function() {
                if(this.type){
                    this.roomsUrl  = `/rooms?search=${this.keyword}&type=${this.type}`;
                } else {
                    this.roomsUrl  = `/rooms?search=${this.keyword}`;
                }
                this.rooms     = [];
                this.nextPage  = '';
                this.getRooms();
                // this.$inertia.replace(route('dashboard', {search :this.keyword}))
              }, 200),
            deep: true,
        },
        type: {
            handler: throttle(function() {
                this.roomsUrl  = `/rooms?search=${this.keyword}&type=${this.type}`;
                this.rooms     = [];
                this.nextPage  = '';
                this.getRooms();
              }, 200),
            deep: true,
        },
        
    },
    mounted(){
        this.getRooms();
    
        this.roomsDiv = this.$refs.roomsDiv;
        this.roomsDiv.addEventListener('scroll', (e) => this.moreOnScroll(e));

    }, 
    methods: {
        moreOnScroll: throttle(function(e) {
                if (e.target) {
                    
                    let scrollTop     = e.target.scrollTop;
                    let clientHeight  = e.target.clientHeight;
                    let scrollHeight  = e.target.scrollHeight;

                    if(scrollTop + clientHeight >= scrollHeight) {
                        this.nextPage ? this.getRooms() : '';
                    }                          
                }  
            }, 100
        ),

        getRooms(){
            this.loading  = true;

            axios.get(`${this.roomsUrl}`)
            .then(res => {
                this.loading  = false;
                // console.log(res.data.rooms);
                if(res.status == 200){

                    res.data.rooms.forEach((r) => {
                        this.rooms.push(r);
                    });

                    this.nextPage  = res.data.next;
                    this.roomsUrl  = this.nextPage;
                }
            }).catch(err => {
                this.loading  = false;
                (err) ?  (this.err = true) : (this.err = false);
            });
        },

        createNewRoom(){
            this.roomForm.processing = true;

            if(this.roomForm.name.length < 1) {
                this.roomForm.processing = false;
                return;
            }

            this.$inertia.post(`/rooms`, this.roomForm, {
                preserveScroll: true,
                onSuccess: (e) => {

                    this.success   = true
                    this.reset();

                }
            })
        },

        selectTab(tab){
            this.roomsDiv   = document.getElementById('roomsDiv');
            // this.$refs.roomsDiv;
            this.select     = tab;
            this.message    = ''; 
            this.roomForm    = {
                name         : '',
                processing   : false
            }
            this.success    = false;
        },
        
        format(date){
            dayjs.extend(relativeTime)
            return dayjs(date).from() // in 22 years
        },
        limit(string, num){
           return string.substring(0, num);
        },
        reset(){
            this.keyword = '';
            this.type    = '';
            this.roomForm    = {
                name         : '',
                processing   : false
            }
        }
    }
};
</script>

<style>
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: #ffffff;
    }

</style>
