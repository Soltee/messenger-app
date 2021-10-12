<template>
    <Head :title="room.slug" />

    <BreezeAuthenticatedLayout>
       <template #tab>
            <div
                class="w-full h-full px-6 mb-6">
                <div
                    class="h-full flex flex-col bg-white">

                    <div
                        v-if="joined" 
                        class="relative flex items-center mt-4 w-full shadow-lg">
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


                    <!-- Rooms -->
                    <div
                        ref="messagesDiv"
                        id="messagesDiv"
                        class="mt-4 flex-1 overflow-y-auto ">
                        
                        <div class="">
                            <div class="flow-root clear-both">
                                <div
                                    class="clearfix mb-6 flex justify-between  px-3 py-2 w-2/3 transform hover:-rotate-1 transition clear-both"

                                    v-for="message in newMessagesArray"
                                    :class="isLoggedUser(message.user.id)"
                                    >
                                        <img
                                            class="rounded-full border-2 border-gray-300 p-1 w-12 h-12  text-center" 
                                            :src="`https://ui-avatars.com/api/?name=${message.user.name}&&background=fff`" >

                                        
                                        <div class="ml-3 rounded-lg border border-gray-300 px-3 py-3 flex flex-col">
                                            <span class="text-xs mb-2">{{ format(message.created) }}</span>

                                            <p>{{ message.content }}</p>

                                        </div>

                                </div> 

                                    
                            </div>


                            <div                                 
                                class="flex flex-col justify-center items-center my-3">

                                <svg 
                                    v-if="nextPage"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="36px" height="36px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                    <circle cx="50" cy="50" fill="none" stroke="#526cfe" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                      <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                    </circle>
                                </svg>

                                <span 
                                    v-else 
                                    class="mt-2 text-red-300 text-lg">
                                    Oops!
                                </span>
                            </div>
                        

                        </div>
                    </div>

                </div>
            </div>

        </template>
    
        <template #room>
             <div class="h-full flex flex-col text-center  w-64 bg-gray-100 pb-6">
                <div class="px-4 py-6 flex flex-col items-center">
                    <img
                        class="rounded-full w-24 h-24 mb-3 text-center" 
                        :src="`https://ui-avatars.com/api/?name=${admin.name}&&background=fff`" >

                    <!-- Authenticated user Status -->
                    <div 
                        v-if="!joined"
                        @click="toggleRoom" 
                        class="w-full px-5 py-2 rounded flex justify-between items-center 
                            border border-primary-blue text-lg font-semibold text-primary-blue cursor-pointer hover:bg-primary-blue hover:text-white">
                        <span class="mr-3">Join</span>
                        <span>{{ joinedUsers.length }}</span>
                    </div>
                    <div 
                        v-else 
                        @click="toggleRoom" 
                        class="w-full px-5 py-2 flex justify-between items-center rounded text-lg font-semibold bg-primary-blue hover:opacity-80 text-white">
                        <span class="mr-3">Leave</span>
                        <span>{{ joinedUsers.length }}</span>
                    </div>
                </div>

                    <!-- Joined Users -->
                    <div
                        ref="joinedUsers" 
                        class="mt-4 w-full  overflow-y-auto">
                       
                        <div class="flex flex-col w-full">
                            <div v-for="ju in newJoinedUsersArray"
                                 class="px-3 py-2 mb-3 w-full border rounded-lg transition">
                                    <div class="rounded-full w-12 h-12 text-center">
                                        <img
                                            class="rounded-full w-12 h-12 mb-3 text-center"
                                            :src="`https://ui-avatars.com/api/?name=${ju.name}&&background=fff`" >
                                        <h1 class="text-lg text-gray-900">
                                            {{ limit(ju.name) }}
                                        </h1>
                                    </div>
                            </div>
                            <div v-for="ju in arr"
                                class="px-3 py-2 mb-3 w-full border rounded-lg">
                                <div class="flex justify-between items-center">
                                    <img
                                        class="rounded-full w-12 h-12 text-center"
                                        :src="`https://ui-avatars.com/api/?name=${ju.name}&&background=fff`" >
                                    <h1 class="text-lg text-gray-900">
                                        {{ ju }}
                                    </h1>
                                </div>
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
import throttle from 'lodash/throttle'
let dayjs = require('dayjs');
let duration = require('dayjs/plugin/duration')
let relativeTime = require('dayjs/plugin/relativeTime')
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
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
            messagesDiv      : '',

            newMessage       : '',
            sending          : false,
            newMessagesArray     : [],
            nextPage         : '',

            newJoinedUsersArray  : [],
            nextPageForUsers     : '',
           
            arr : [
            1,2,3,4,5,6,7,8,9,0,10,11,12,13,14,15,161,71,8,0,10,11,12,13,14,15,161,7],
        }
    },

    mounted(){
        this.messagesDiv      = this.$refs.messagesDiv;
        this.joinedUsersDiv   = this.$refs.joinedUsers;
        this.messagesDiv.addEventListener('scroll', (e) => this.previousMessages(e));
        this.joinedUsersDiv.addEventListener('scroll', (e) => this.moreJoinedUsers(e));

    }, 

    created() {
        this.messagesArray.data.forEach((m) => {
            this.newMessagesArray.push(m);
        });
        
        this.nextPage  = this.messagesArray.next;

        this.joinedUsers.data.forEach((u) => {
            this.newJoinedUsersArray.push(u);
        });
        
        this.nextPageForUsers  = this.joinedUsers.next;

        this.setUpEcho();
    },

    methods:{

        previousMessages: throttle(function(e) {
                if (e.target) {
                    
                    let scrollTop     = e.target.scrollTop;
                    let clientHeight  = e.target.clientHeight;
                    let scrollHeight  = e.target.scrollHeight;

                    if(scrollTop + clientHeight >= scrollHeight) {
                        if(this.nextPage){
                            this.$inertia.visit(`${this.nextPage}`, {
                                method: 'get',
                                data: {},
                                replace: false,
                                preserveState: true,
                                preserveScroll: false,
                                only: [],
                                headers: {},
                                errorBag: null,
                                forceFormData: false,
                                onCancelToken: cancelToken => {},
                                onCancel: () => {},
                                onBefore: visit => {},
                                onStart: visit => {},
                                onProgress: progress => {},
                                onSuccess: page => {
                                    this.joinedUsers.data.forEach((m) => {
                                        this.newJoinedUsersArray.push(m);
                                    });
                                    this.nextPageForUsers   = this.joinedUsers.next;
                                    console.log(this.joinedUsers.next);
                                },
                                onError: errors => {},
                                onFinish: visit => {},
                            })

                        }

                        
                    }                          
                }  
            }, 100
        ),

        moreJoinedUsers: throttle(function(e) {
                if (e.target) {
                    
                    let scrollTop     = e.target.scrollTop;
                    let clientHeight  = e.target.clientHeight;
                    let scrollHeight  = e.target.scrollHeight;

                    if(scrollTop + clientHeight >= scrollHeight) {
                        // this.arr2.forEach(r => {
                        //     this.arr.push(r);
                        // });
                        if(this.nextPageForUsers){
                            this.$inertia.visit(`${this.nextPageForUsers}`, {
                                method: 'get',
                                data: {},
                                replace: false,
                                preserveState: true,
                                preserveScroll: false,
                                only: [],
                                headers: {},
                                errorBag: null,
                                forceFormData: false,
                                onCancelToken: cancelToken => {},
                                onCancel: () => {},
                                onBefore: visit => {},
                                onStart: visit => {},
                                onProgress: progress => {},
                                onSuccess: page => {
                                    this.messagesArray.data.forEach((m) => {
                                        this.newMessagesArray.push(m);
                                    });
                                    this.nextPageForUsers   = this.newMessagesArray.next;
                                    console.log(this.messagesArray.next);
                                },
                                onError: errors => {},
                                onFinish: visit => {},
                            })

                        }

                        
                    }                          
                }  
            }, 100
        ),


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
                        this.newMessagesArray.unshift(message);
                    });

            }
        },

        isLoggedUser(user){
            return {
                'even:float-right odd:clear-both' : user === this.authenicated.id
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
