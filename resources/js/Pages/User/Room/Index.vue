<template>
    <Head title="Chat" />

    <BreezeAuthenticatedLayout>
       <template #tab>
            <div 
                class="border-b border-gray-200 pt-4 shadow-xl w-80">

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
                    class="overflow-y-auto h-full">
                    
                    <div class="">
                        <div class="flow-root ">
                            <div
                                class="clearfix flex justify-between  px-5 py-3  clear-both divide-y divide-gray-300 text-gray-700 border-r-4 mb-4 divide-y divide-gray-200"

                                v-for="room in rooms"
                                @click="selectRoom(room.id)"
                                :class="ifSelected(room.id)"
                                >
                                    <div class="flex flex-col">
                                        <h1 class="text-lg m-0 capitalize">
                                            {{ limit(room.name, 12) }}
                                        </h1>
                                        <span class="text-xs -mt-2">{{ format(room.created) }}</span>
                                    </div>
                                    <!-- <div class="flex flex-col items-end">
                                        <span class="text-md ">Joined</span>
                                        <span class="text-xs font-medium ">{{ room.users }}</span>
                                    </div> -->

                            </div> 

                                
                        </div>


                        <div                                 
                            class="flex flex-col justify-center items-center my-3">

                            <svg 
                                v-if="selectedRoomMessages.nextPage"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="36px" height="36px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                <circle cx="50" cy="50" fill="none" stroke="#526cfe" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                </circle>
                            </svg>

                            <span 
                                v-if="selected && !selectedRoomMessages.nextPage" 
                                class="mb-2 text-red-300 text-lg">
                                    Oops ! 
                            </span>
                        </div>
                    

                    </div>
                </div>

            
            </div>

        </template>

        <div
            class="bg-white flex-1 px-6 py-6 h-full ">

            <div
                v-if="joinedSelectedRoom" 
                class="relative flex items-center w-full shadow-lg">
                <input
                    type="text"
                    name="message"
                    class="w-full rounded-lg px-10 py-3 border-none"
                    placeholder="Type your message here..."
                    v-model="newMessage"
                    @keyup.enter="sendMessage"
                >
                <svg
                    v-if="sending"
                    class="absolute mt-0 left-3 h-6 w-6 text-primary-blue"
                    xmlns="http://www.w3.org/2000/svg" 
                    xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" 
                    viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <circle cx="50" cy="50" fill="none" stroke="#526cfe" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                      <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                    </circle>
                </svg>
                <svg 
                    @click="sendMessage"
                    class="absolute right-0 mt-0 mr-3 h-6 w-6 text-primary-blue"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                
            </div>


            <!-- Messages -->
            <div
                ref="messagesDiv"
                id="messagesDiv"
                class="mt-4 overflow-y-auto h-full">
                
                <div class="">
                    <div class="flow-root clear-both">
                        <div
                            class="clearfix mb-6 flex   px-3 py-2 w-2/3 transform hover:-rotate-1 transition clear-both"

                            v-for="message in selectedRoomMessages.messages"
                            :class="isLoggedUser(message.user.id)"
                            >
                                <img
                                    class="rounded-full border-2 border-gray-300 p-1 w-12 h-12  text-center" 
                                    :src="`https://ui-avatars.com/api/?name=${message.user.name}&&background=fff`" >

                                
                                <div class="mx-3 rounded-lg border border-gray-300 px-3 py-3 flex flex-col">
                                    <span class="text-xs mb-2">{{ format(message.created) }}</span>

                                    <p>{{ message.content }}</p>

                                </div>

                        </div> 

                            
                    </div>


                    <div                                 
                        class="flex flex-col justify-center items-center my-3">

                        <svg 
                            v-if="selectedRoomMessages.nextPage"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="36px" height="36px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                            <circle cx="50" cy="50" fill="none" stroke="#526cfe" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                            </circle>
                        </svg>

                        <span 
                            v-if="selected && !selectedRoomMessages.nextPage" 
                            class="mb-2 text-red-300 text-lg">
                                Oops ! 
                        </span>
                    </div>
                

                </div>
            </div>
            
        </div>

        <template #room>

            <div 
                class="h-full flex flex-col text-center  w-64 bg-gray-100 pb-6 right-0">
                <div class="px-4 py-6 flex flex-col items-center">
                    <img
                        class="rounded-full w-24 h-24 mb-3 text-center" 
                        :src="`https://ui-avatars.com/api/?name=${selectedCreatedUser.name}&&background=fff`" >

                    <!-- Authenticated user Status -->
                    <div 
                        v-if="!joinedSelectedRoom"
                        @click="toggleRoom" 
                        class="w-full px-5 py-2 rounded flex justify-between items-center 
                            border border-primary-blue text-lg font-semibold text-primary-blue cursor-pointer hover:bg-primary-blue hover:text-white">
                        <span class="mr-3">Join</span>
                        <span>{{ selectedJoinedUsers.users.length }}</span>
                    </div>
                    <div 
                        v-else 
                        @click="toggleRoom" 
                        class="w-full px-5 py-2 flex justify-between items-center rounded text-lg font-semibold bg-primary-blue hover:opacity-80 text-white">
                        <span class="mr-3">Leave</span>
                        <span>{{ selectedJoinedUsers.users.length }}</span>
                    </div>
                </div>

                <div
                    ref="joinedUsers" 
                    id="joinedUsers"
                    class="mt-4 w-full overflow-y-auto">

                        <div class="flex flex-col w-full">

                            <div v-for="ju in selectedJoinedUsers.users"
                                 class="px-3 py-3 w-full border flex justify-between items-center rounded-lg transition">
                                    <img
                                        class="rounded-full w-12 h-12 mb-3 text-center"
                                        :src="`https://ui-avatars.com/api/?name=${ju.name}&&background=fff`" >
                                    <h1 class="text-lg text-gray-900">
                                        {{ limit(ju.name) }}
                                    </h1>
                            </div>

                        </div>

                </div>

            </div>

        </template>
    
       
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
    },
    data(){
        return {
            roomsDiv      : document.getElementById('roomsDiv'),

            keyword       : '',
            loading       : false,
            err           : false,
            roomsUrl      : '/rooms',
            rooms         : [],
            nextPage      : '',   

            selected          : '',
            joinedSelectedRoom  : false, 
            selectedCreatedUser : {},


            joinedUsers              : document.getElementById('joinedUsers'),
            selectedJoinedUsersUrl   : '',
            selectedJoinedUsers      : {
                users        : [],
                nextPage     : '',
            },


            messagesDiv              : document.getElementById('messagesDiv'),
            selectedRoomMessagesUrl  : '',
            selectedRoomMessages         : {
                messages     : [],
                nextPage     : ''
            },

            sending          : false,
            newMessage       : '',
        }
    },
    watch: {
        keyword: {
            handler: throttle(function() {
                if(this.type){
                    this.roomsUrl  = `/rooms?search=${this.keyword}&type=${this.type}`;
                } else {
                    this.roomsUrl  = `/rooms?search=${this.keyword}&type=joined`;
                }
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

        this.joinedUsers = this.$refs.joinedUsers;
        this.joinedUsers.addEventListener('scroll', (e) => this.getMoreJoinedUsers(e));

        this.messagesDiv      = this.$refs.messagesDiv;
        this.messagesDiv.addEventListener('scroll', (e) => this.previousMessages(e));
    }, 

    methods:{
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

        getMoreJoinedUsers: throttle(function(e) {
                if (e.target) {
                    
                    let scrollTop     = e.target.scrollTop;
                    let clientHeight  = e.target.clientHeight;
                    let scrollHeight  = e.target.scrollHeight;

                    if(scrollTop + clientHeight >= scrollHeight) {
                        this.selectedJoinedUsers.nextPage ? this.getSelectedRoom() : '';
                    }                          
                }  
            }, 100
        ),

        previousMessages: throttle(function(e) {
                if (e.target) {
                    
                    let scrollTop     = e.target.scrollTop;
                    let clientHeight  = e.target.clientHeight;
                    let scrollHeight  = e.target.scrollHeight;

                    if(scrollTop + clientHeight >= scrollHeight) {
                        this.selectedRoomMessages.nextPage ? 
                            this.getSelectedRoomMessages() : '';
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
                    this.selectRoom(this.rooms[0].id);
                    this.setUpEcho();
                }
            }).catch(err => {
                this.loading  = false;
                (err) ?  (this.err = true) : (this.err = false);
            });
        },

        getSelectedRoom(){

            axios.get(`${this.selectedJoinedUsersUrl}`)
            .then(res => {
                this.loading  = false;
                if(res.status == 200){

                    this.joinedSelectedRoom         = res.data.joined;
                    this.selectedCreatedUser        = res.data.admin;

                    if(this.selectedJoinedUsers.nextPage){
                        res.data.joinedUsers.data.forEach((u) => {

                            this.selectedJoinedUsers.users.push(u);

                        });
                    } else {

                        this.selectedJoinedUsers.users  = res.data.joinedUsers.data;

                    }
                    
                    this.selectedJoinedUsers.nextPage  = res.data.joinedUsers.next;
                    this.selectedJoinedUsersUrl        = this.selectedJoinedUsers.nextPage;

                    this.setUpEcho();
                }
            }).catch(err => {
                this.loading  = false;
                (err) ?  (this.err = true) : (this.err = false);
            });
        },

        getSelectedRoomMessages(){
            console.log(`${this.selectedRoomMessagesUrl}`);
            axios.get(`${this.selectedRoomMessagesUrl}`)
            .then(res => {
                this.loading  = false;
                if(res.status == 200){

                    if(this.selectedRoomMessages.nextPage){

                        res.data.messagesArray.data.forEach((u) => {

                            this.selectedRoomMessages.messages.push(u);

                        });

                    } else {

                        this.selectedRoomMessages.messages  = res.data.messagesArray.data;

                    }
                    
                    this.selectedRoomMessages.nextPage   = res.data.messagesArray.next;
                    this.selectedRoomMessagesUrl         = this.selectedRoomMessages.nextPage;
                
                }
            }).catch(err => {
                this.loading  = false;
                (err) ?  (this.err = true) : (this.err = false);
            });            

        },


        selectRoom(room){
            this.loading     = true;
            this.selected    = room;

            this.selectedJoinedUsers      = {
                users        : [],
                nextPage     : '',
            };


            this.selectedRoomMessages     = {
                messages     : [],
                nextPage     : ''
            };

            this.selectedJoinedUsersUrl  = `/chat/${room}`;
            this.selectedRoomMessagesUrl = `/chat/${room}/messages`;
            this.getSelectedRoom();
            this.getSelectedRoomMessages();
        },

        toggleRoom(){
            axios.patch(`/rooms/${this.selected}`)
            .then(res => {
                
                if(res.status == 200){
                    this.joinedSelectedRoom      = !this.joinedSelectedRoom;
                    this.selectedJoinedUsersUrl  = `/chat/${this.selected}`;
                    this.getSelectedRoom();
                    this.setUpEcho();
                }

            }).catch(err => {
                this.$swal('Server error.', 'error');
            });
        },

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

        sendMessage(){
            this.sending  = true;

            if(this.newMessage.length < 1)
            {
                this.sending   = false;
                return;
            }

            axios.post('/messages', {
                room    : this.selected,
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

        setUpEcho(){
            if(this.selected){
                Echo.join(`rooms.${this.selected}`)
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
                        this.selectedRoomMessages.messages.unshift(message);
                    });

            }
        },

        format(date){
            // dayjs.extend(duration)
            dayjs.extend(relativeTime)
            return dayjs(date).from() // in 22 years
            
        },
        limit(string){
           return string.substring(0, 16);
        },
        reset(){

        }
    }
};
</script>
