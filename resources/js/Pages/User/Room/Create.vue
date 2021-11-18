<template>
    <Head title="New Room" />

    <BreezeAuthenticatedLayout>
       <template #tab>
            <div 
                class="border-b border-gray-200 py-4 shadow-xl w-80 overflow-y-auto h-full">

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
                                class="clearfix flex justify-between  px-5 py-2  clear-both divide-y divide-gray-300 text-gray-700 border-r-4 mb-3 divide-y divide-gray-200"

                                v-for="room in rooms.data"
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
                                <!-- <template v-for="(link, key) in rooms.links">
                                    <div v-if="link.url === null" :key="key" class="mr-1 hover:bg-gray-900 hover:text-white mb-1 px-4 py-3 text-sm border rounded-lg text-gray-400 cursor-pointer" :class="{ 'ml-auto': link.label === 'Next' }">
                                        {{ link.label }}
                                    </div>
                                    <div v-else>
                                        
                                        <Link :href="link.url" :class="classes">

                                            <span
                                                :key="key" 
                                                class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-gray-900 hover:text-white focus:border-indigo-500 focus:text-indigo-500 cursor-pointer" :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }" >
                                                {{ link.label }}
                                            </span>
                                        </Link>

                                    </div>

                                </template> -->
                            </div>
                           


                        </div>




                    </div>
                </div>

                
    
            </div>

        </template>

        <div
            class="bg-white flex-1 px-6 py-6 h-full ">

            Create Or Update Room
            
        </div>
       
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Link, Head } from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue'

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
            loading       : false,
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

    mounted(){
    
        this.roomsDiv = this.$refs.roomsDiv;
        // this.roomsDiv.addEventListener('scroll', (e) => this.moreOnScroll(e));
    }, 

    methods:{
        moreOnScroll: throttle(function(e) {
                if (e.target) {
                    
                    let scrollTop     = e.target.scrollTop;
                    let clientHeight  = e.target.clientHeight;
                    let scrollHeight  = e.target.scrollHeight;

                    if(scrollTop + clientHeight >= scrollHeight) {
                        this.next ? 
                            this.$inertia.replace(this.next)
                            : '';
                    }                          
                }  
            }, 100
        ),

        isLoggedUser(user){
            return {
                'even:float-right odd:clear-both ml-auto flex-row-reverse' : user === this.authenicated.id
            }
        },

        ifSelected(room){
            return {
                'border-gray-900 text-gray-900 font-bold'  : room === this.selected
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

        }
    }
};
</script>
