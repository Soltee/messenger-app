<template>
    <Head title="Dashboard" />


    <BreezeAuthenticatedLayout>
        


        
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

        authenicated : Object,

    },
    data(){
        return {
            select        : 'rooms',
            roomsDiv      : document.getElementById('roomsDiv'),

            keyword       : '',
            type          : '',
            loading       : false,
            err           : false,
            roomsUrl      : '/rooms',
            rooms         : [],
            nextPage      : '',

            roomForm      : {
                name            : '',
                processing      : false,
            },
            success       : false,

            selectedRoom  : {},
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
                    this.roomsUrl  = `/rooms?search=${this.keyword}&type=created`;
                    this.rooms     = [];
                    this.nextPage  = '';
                    this.getRooms();

                }
            })
        },

        selectTab(tab){
            this.roomsDiv   = document.getElementById('roomsDiv');
            this.select     = tab;
            if(tab ===  'create'){
                this.roomsUrl  = `/rooms?search=${this.keyword}&type=created`;
                this.rooms     = [];
                this.nextPage  = '';
                this.getRooms();
            } else {
                this.roomsUrl  = `/rooms`;
                this.rooms     = [];
                this.nextPage  = '';
                this.getRooms();
            }
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
