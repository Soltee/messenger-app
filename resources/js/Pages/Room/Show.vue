<template>
    <Head :title="room.slug" />

    <BreezeAuthenticatedLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Room
            </h2>
        </template> -->

        <div class="max-w-7xl mx-auto px-4 my-2 sm:px-6 lg:px-8 bg-white">
            <div class=" overflow-hidden">
                <div class="flex ">
                    <!-- Left-->
                    <div class="flex flex-col text-center items-center w-72 rounded-l-lg px-3 py-3">
                        <img
                            class="rounded-full w-24 h-24 mb-3" 
                            :src="`https://ui-avatars.com/api/?name=${admin.name}`" >

                        <!-- Authenticated user Status -->
                        <div 
                            v-if="!joined"
                            @click="toggleRoom" 
                            class="mt-4 px-5 py-2 rounded 
                                border border-primary-blue text-primary-blue cursor-pointer hover:bg-primary-blue hover:text-white">
                            Join
                        </div>
                        <div 
                            v-else 
                            @click="toggleRoom" 
                            class="mt-4 px-5 py-2 rounded bg-primary-blue hover:opacity-80 text-white">
                            Leave
                        </div>

                        <!-- Joined Users -->
                        <div class="mt-4 w-full">
                            <h3 class="text-md text-primary-blue">
                                Users
                                <span class="mr-2">{{ joinedUsers.length }}</span>
                            </h3>
                            <div class="flex flex-col w-full mt-2">
                                <div v-for="ju in joinedUsers"
                                     class="w-full bg-white shadow-lg rounded-lg mb-5 px-3 py-3 w-full ransform hover:-rotate-2 transition">
                                        <div class="flex justify-between items-center mb-2">
                                            <h1 class="text-lg">
                                                {{ limit(ju.name) }}
                                            </h1>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="flex-1 flex flex-col justify-center py-3">
                        

                        <div class="clear-both">
                            <div
                                class="clearfix mb-6 rounded shadow-lg px-3 py-2 even:float-right odd:clear-both w-2/3 transform hover:-rotate-2 transition"
                                v-for="message in newMessagesArray"
                            >
                                <div class="flex items-center justify-between mb-2">
                                    <h1 class="font-semibold text-lg ">{{ message.user.name }}</h1>
                                    <span>{{ format(message.created) }}</span>
                                </div>
                                <p>{{ message.content }}</p>
                            </div>

                            
                        </div>

                        <!-- {{ joined }} -->
                        <div v-if="sending">
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="36px" height="36px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                <circle cx="50" cy="50" fill="none" stroke="#f8f8fc" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                </circle>
                            </svg>
                        </div>


                        <div  v-else class="flex items-center mb-4 w-full shadow-lg">
                            <input
                                type="text"
                                name="message"
                                class="w-full rounded-l-lg px-3 py-3 border-none"
                                placeholder="Type your message here..."
                                v-model="newMessage"
                                @keyup.enter="sendMessage"
                            >

                            <button
                                class="px-6 py-3 rounded-r-lg bg-blue-500 hover:bg-blue-600 text-white font-semibold"
                                @click="sendMessage"
                            >
                                Send
                            </button>
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
let dayjs = require('dayjs');
let duration = require('dayjs/plugin/duration')
let relativeTime = require('dayjs/plugin/relativeTime')
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        authenicated      : Object,
        admin             : Object,
        room              : Object,
        joinedUsers       : Object,
        joined            : Boolean,
        messagesArray     : Object,        
    },
    data(){
        return {
            newMessage       : '',
            sending          : false,
            newMessagesArray     : [],
        }
    },
    created() {
        this.messagesArray.data.forEach((m) => {
            this.newMessagesArray.push(m);
        });
        this.setUpEcho();
    },
    methods:{
        sendMessage(){
            this.sending  = true;

            if(this.newMessage.length < 1)
            {
                this.sending   = false;
                return;
            }

            axios.post('/messages', {
                room    : this.room.id,
                message : this.newMessage
            }).then(res => {
                this.newMessage  = '';
                this.sending     = false;
                if(res.status == 201){
                    this.setUpEcho();
                }
            }).catch(err => {
                this.newMessage   = '';
                this.sending      = false;
            });
        },
        toggleRoom(){
            axios.patch(`/rooms/${this.room.id}`)
            .then(res => {
                
                if(res.status == 200){
                    this.$page.props.joined      = !this.$page.props.joined;
                    this.$page.props.joinedUsers = res.data.users;
                    this.setUpEcho();
                }

            }).catch(err => {
                this.$swal('Server error.', 'error');
            });
        },
        setUpEcho(){
            if(this.joined){
                Echo.join(`rooms.${this.room.id}`)
                    .here(function (members) {
                        // runs when you join
                        // console.table(members);
                    })
                    .joining(function (joiningMember, members) {
                        // runs when another member joins
                        // console.table(joiningMember);
                    })
                    .leaving(function (leavingMember, members) {
                        // runs when another member leaves
                        // console.table(leavingMember);
                    })
                    .listen('MessageSentEvent', (message) => {
                        this.newMessagesArray.push(message);
                    });

            }
        },

        format(date){
            // dayjs.extend(duration)
            dayjs.extend(relativeTime)
            return dayjs(date).from() // in 22 years
            
        },
        limit(string){
           return string.substring(0, 18);
        },
        reset(){
            this.keyword = '';
        }
    }
};
</script>
