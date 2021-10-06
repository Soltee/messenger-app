<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Room
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden">
                    <div class="flex flex-col justify-center py-3">
                        <div v-if="sending">
                                Sending .........
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

                        <div class="clear-both">
                            <div
                                class="clearfix mb-6 rounded shadow-lg px-3 py-2 even:float-right odd:clear-both w-2/3 transform hover:-rotate-3"
                                v-for="message in newMessagesArray"
                            >
                                <div class="flex items-center justify-between mb-2">
                                    <h1 class="font-semibold text-lg ">{{ message.user.name }}</h1>
                                    <span>{{ message.created }}</span>
                                </div>
                                <p>{{ message.content }}</p>
                            </div>

                            
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
        authenicated      : Object,
        room              : Object,
        messagesArray     : Array,        
    },
    data(){
        return {
            newMessage       : '',
            sending          : false,
            newMessagesArray     : [],
        }
    },
    created() {
        this.messagesArray.forEach((m) => {
            this.newMessagesArray.push(m);
        });

        this.setUpEcho();


        // Echo.private(`rooms.${this.room.id}`)
        //     .listen('MessageSentEvent', (message) => {
        //         console.log(e);
        //         this.newMessagesArray.push(message);
        // });
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
                    // console.log(res.data);
                    this.setUpEcho();
                    // this.messagesArray.push(res.data.newMessage);
                }
            }).catch(err => {
                this.newMessage   = '';
                this.sending      = false;
                // console.log(err);
            });
        },
        setUpEcho(){
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
                    console.log(this.newMessagesArray);
                    this.newMessagesArray.unshift(message);
                });
        }
    }
};
</script>
