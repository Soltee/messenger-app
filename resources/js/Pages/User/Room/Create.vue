<template>
    <Head title="New Room" />

    <BreezeAuthenticatedLayout>
       <template #tab>
            <div 
                class="border-b border-gray-200 py-4 shadow-xl w-72 overflow-y-auto h-full">

                <!-- Search -->
                <div class="flex items-center relative mb-3 px-4">
                    <svg 
                        @click="reset()"
                        class="feather h-6 w-6 cursor-pointer absolute right-0 left-5 mt-0 ml-1 text-gray-900 hover:opacity-50"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    <BreezeInput 
                        id="keyword" type="text" 
                        class="bg-white rounded-lg shadow-md text-gray-900 block w-full pl-8 py-2 focus:border-transparent focus:border-none focus:ring-0  focus:outline-none opacity-1" 
                        v-model="keyword"  autofocus autocomplete="keyword" 
                        placeholder="Search rooms.."/>
            

                </div>

                <!-- Rooms -->
                <div
                    ref="roomsDiv"
                    id="roomsDiv"
                    class="">
                    
                    <div class="">
                        <div class="flow-root ">
                            <div
                                class="clearfix flex justify-between  px-5 py-2  clear-both divide-y divide-gray-300 text-gray-700 border-r-4 mb-3 divide-y divide-gray-200 cursor-pointer"

                                v-for="room in rooms.data"
                                @click="selectRoom(room)"
                                :class="ifSelected(room.id)"
                                >
                                    <div class="flex flex-col">
                                        <h1 class="text-lg m-0 capitalize">
                                            {{ limit(room.name, 12) }}
                                        </h1>
                                        <span class="text-xs -mt-2">{{ format(room.created) }}</span>
                                    </div>
                                
                            </div>
                                
                            <!-- Links -->
                            <div class="mt-3 flex justify-center items-center">
                                <span class="px-4 py-2 rounded-lg border border-gray-200">{{ rooms.first }}</span> - <span class="px-4 py-2 rounded-lg  border border-gray-200">{{ rooms.last }}</span> <span class="px-4 py-2 rounded-lg ">out of</span> <span class="px-4 py-2 rounded-lg border border-gray-200"> {{ rooms.total }}</span>
                                
                            </div>
                            <div class="mt-2 flex flex-wrap justify-between">
                                <Link
                                    v-if="rooms.prev" 
                                    :href="rooms.prev" 
                                    :class="classes">
                                    <span
                                        class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-gray-900 hover:text-white cursor-pointer" :class="{ }" >
                                        Prev
                                    </span>
                                </Link>

                                <span
                                    v-else
                                    class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded  bg-gray-200" :class="{  }" >
                                        Prev
                                    </span>

                                <Link
                                    v-if="rooms.next" 
                                    :href="rooms.next" 
                                    :class="classes">
                                    <span
                                        class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-gray-900 hover:text-white cursor-pointer" :class="{  }" >
                                            Next
                                    </span>
                                </Link>

                                <span
                                    v-else
                                   class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded bg-gray-200 cursor-pointer" :class="{  }" >
                                        Next
                                    </span>
                              
                            </div>
                           


                        </div>




                    </div>
                </div>

                
    
            </div>

        </template>

        <div class="bg-white flex-1 w-screen px-3 py-4 h-full overflow-y-auto">

            <div 
                v-if="select === 'new'"
                class="bg-white">
                
                <div class="px-4 py-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        New Room
                    </h3>
                    <p class="mt-1 max-w-2xl text-xs text-gray-500">
                      Create a new room for your friends to join.
                    </p>
                </div>
                <form 
                    @submit.prevent="createOrUpdateRoom">
                    <div class="border-t border-gray-200">
                        <dl>
                          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <label for="name" class="text-lg font-lg">Name</label>

                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="inputForm.name"   autocomplete="new-name" />
                            </dd>
                          </div>
                            <div class="mt-1 px-4">
                                <div 
                                    v-if="errors.name"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.name }}
                                </div>
                            </div>
                          
                          
                          
                          
                          <div class="bg-gray-50 px-4 py-3 flex justify-between items-center sm:gap-4 sm:px-6 ">
                                <dt class="">
                                    <span v-if="message" class="text-lg font-lg text-green-500">
                                        {{ message }}
                                    </span>
                                </dt>
                                <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                    <BreezeButton 
                                        class="w-full py-3 px-4 text-center rounded-lg cursor-pointer bg-primary-blue hover:opacity-75 flex justify-between items-center" 
                                        :class="{ 'opacity-25': processing }" :disabled="processing">
                                        <svg 
                                            v-if="processing"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="50" cy="50" fill="none" stroke="#f8f8fc" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                            </circle>
                                        </svg>

                                        <span class="ml-3 text-white">Save</span>

                                    </BreezeButton>
                                </dd>
                                
                            </div>
                          
                        </dl>
                    </div>
                </form>
            </div>

            <!-- Edit Section -->
            <div 
                v-if="select === 'edit' && selected"
                class="bg-white">
                
                <div class="px-4 py-2 flex justify-between">
                    <div class="">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Edit {{ selected.name }}
                        </h3>
                    </div>

                    <div class="flex items-center">
                        <span 
                            @click="reset"
                            class="text-semibold cursor-pointer mr-3">New Room</span>
                        <span 
                            @click="dropRoom"
                            class="text-semibold cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="feather feather-trash text-red-400 h-8 w-8"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </span>
                    </div>
                </div>

                <form 
                    @submit.prevent="createOrUpdateRoom">
                    <div class="border-t border-gray-200">
                        <dl>
                          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <label for="name" class="text-lg font-lg">Name</label>

                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="inputForm.name"   autocomplete="new-name" />
                            </dd>
                          </div>
                            <div class="mt-1 px-4">
                                <div 
                                    v-if="errors.name"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.name }}
                                </div>
                            </div>
                          
                          
                          
                          
                          <div class="bg-gray-50 px-4 py-3 flex justify-between items-center sm:gap-4 sm:px-6 ">
                                <dt class="">
                                    <span v-if="message" class="text-lg font-lg text-green-500">
                                        {{ message }}
                                    </span>
                                </dt>
                                <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                    <BreezeButton 
                                        class="w-full py-3 px-4 text-center rounded-lg cursor-pointer bg-primary-blue hover:opacity-75 flex justify-between items-center" 
                                        :class="{ 'opacity-25': processing }" :disabled="processing">
                                        <svg 
                                            v-if="processing"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="50" cy="50" fill="none" stroke="#f8f8fc" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                            </circle>
                                        </svg>

                                        <span class="ml-3 text-white">Edit</span>

                                    </BreezeButton>
                                </dd>
                                
                            </div>
                          
                        </dl>
                    </div>
                </form>
            </div>
            
        </div>
       
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Link, Head } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue'
import BreezeButton from '@/Components/Button.vue'

import throttle from 'lodash/throttle'
let dayjs = require('dayjs');
let duration = require('dayjs/plugin/duration')
let relativeTime = require('dayjs/plugin/relativeTime')
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,

        BreezeInput,
        BreezeButton,
    },
    props: {
        authenicated      : Object,
        search            : String,
        rooms             : Object,
    },
    data(){
        return {
            roomsDiv      : document.getElementById('roomsDiv'),

            keyword       : '',
            select        : 'new',
            processing    : false,
            message       : '', 
            inputForm       : {
                name      : '',
            }, 

            selected : {},
        }
    },
    watch: {
        keyword: {
            handler: throttle(function() {
                this.$inertia.replace(route('new', {search :this.keyword}))
            }, 150),
            deep: true,
        },
    },

    computed: {
        
        isNew() {
            return {
              'border-gray-900 text-gray-900': this.select === 'new'
            }
        },
        isUpdate() {
            return {
              'border-gray-900 text-gray-900': this.select === 'edit'
            }
        },

        errors() {
            this.processing  = false;
            
            return this.$page.props.errors;
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0
        },
    }, 

    methods:{
        createOrUpdateRoom(){
            this.processing = true;

            if(this.select === 'edit'){
                this.$inertia.patch(`/rooms/${this.selected.id}`, this.inputForm, {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.message = 'Room has been updated.';
                        this.$inertia.replace(route('new'));;
                    }
                })
            } else {

                this.$inertia.post(`/rooms`, this.inputForm, {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.message        = 'Room has been created.';
                        this.inputForm.name = '';
                        this.$inertia.replace(route('new'));

                    }
                })
            }
            
        },

        dropRoom(){

            this.processing = true;

            this.$inertia.delete(`/rooms/${this.selected.id}`, {
                preserveScroll: true,
                    onSuccess: () => {
                        this.message = 'Room has been deleted.';
                        this.reset();
                        this.$inertia.replace(route('new'));

                    }
            })

        },

        selectRoom(room){
            this.select      = 'edit';
            this.selected    = room;
            this.inputForm.name  = room.name;
            this.message    = '';
        },

        isLoggedUser(user){
            return {
                'even:float-right odd:clear-both ml-auto flex-row-reverse' : user === this.authenicated.id
            }
        },

        ifSelected(room){
            return {
                'border-gray-900 text-gray-900 font-bold'  : room === this.selected.id
            }
        },

        format(date){
            // dayjs.extend(duration)
            dayjs.extend(relativeTime)
            return dayjs(date).from() // in 22 years
            
        },
        limit(s){
           return s.substring(0, 16);
        },
        reset(){
            this.select           = 'new';
            this.selected         = {};
            this.message          = '';
            this.inputForm.name   = '';

        }
    }
};
</script>
