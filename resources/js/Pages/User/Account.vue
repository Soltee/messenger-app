<template>
    <Head title="Account" />


    <BreezeAuthenticatedLayout>
        <template #tab>
            <div class="w-32 h-full  py-6">
   
                <div class="h-full flex flex-col bg-white shadow-xl w-full">
                    <li 
                        @click="select = 'account'; message='';"
                        class="mr-3  w-auto px-3 py-2 group text-lg font-semibold flex text-gray-400 border-r-2 border-gray-300 mb-3 hover:border-gray-900 cursor-pointer w-full"
                        :class="isAccount">
                       
                        <span 
                            class="ml-3  transition group-hover:text-gray-900"
                            :class="{ '': isAccount }">Account</span>
                    </li>
                    <li 
                        @click="select = 'password'; message='';"
                        class="mr-3  w-auto px-3 py-2 group text-lg font-semibold flex text-gray-400 border-r-2 border-gray-300 mb-3 hover:border-gray-900 cursor-pointer w-full"
                        :class="isPassword">
                       
                        <span 
                            class="ml-3  transition group-hover:text-gray-900"
                            :class="{ '': isPassword }">Password</span>
                    </li>
                    <li 
                        @click="select = 'logout'; message='';"
                        class="mr-3  w-auto px-3 py-2 group text-lg font-semibold flex text-gray-400 border-r-2 border-gray-300 mb-3 hover:border-gray-900 cursor-pointer w-full"
                        :class="isLogout"
                        >
                       
                        <span 
                            class="ml-3  transition group-hover:text-gray-900"
                            >Logout</span>
                    </li>
                </div>

            </div>

        </template>

        <div class="bg-white flex-1 w-screen px-6 py-6 h-full overflow-y-auto">

            <div 
                v-if="select === 'account'"
                class="bg-white">
                
                <div class="px-4 py-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Account Information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Personal details.
                    </p>
                </div>
                <form 
                    @submit.prevent="updateAccount">
                    <div class="border-t border-gray-200">
                        <dl>
                          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <label for="name" class="text-lg font-lg">Name</label>

                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="accountForm.name"   autocomplete="new-name" />
                            </dd>
                          </div>
                            <div class="mt-1">
                                <div 
                                    v-if="errors.name"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.name }}
                                </div>
                            </div>
                          
                          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <label for="email" class="text-lg font-lg">Email</label>

                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                              <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="accountForm.email"   autocomplete="new-email" />
                            </dd>
                          </div>
                            <div class="mt-1">
                                <div 
                                    v-if="errors.email"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.email }}
                                </div>
                            </div>
                          
                          
                          <div class="bg-gray-50 px-4 py-3 flex justify-between items-center sm:gap-4 sm:px-6">
                                <dt class="">
                                    <span v-if="message" class="text-lg font-lg text-green-500">
                                        {{ message }}
                                    </span>
                                </dt>
                                <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                    <BreezeButton 
                                        class="w-full py-3 px-4 text-center bg-primary-blue flex justify-between items-center" 
                                        :class="{ 'opacity-25': passwordForm.processing }" :disabled="passwordForm.processing">
                                        <svg 
                                            v-if="processing"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="50" cy="50" fill="none" stroke="#f8f8fc" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                            </circle>
                                        </svg>

                                        <span class="ml-3">Save</span>

                                    </BreezeButton>
                                </dd>
                                
                            </div>
                          
                        </dl>
                    </div>
                </form>
            </div>

            <div 
                v-if="select === 'password'"
                class="bg-white">
                <div class="px-4 py-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Password 
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Change with your new one.
                    </p>
                </div>
                <form 
                    @submit.prevent="updatePassword">
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-lg font-lg text-gray-500">
                                  <label for="password" class="text-lg font-lg">Password</label>
                                </dt>
                                <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                  <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="passwordForm.password" placeholder="**********"  autocomplete="new-password" />
                                </dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-lg font-lg text-gray-500">
                                  <label for="password_confirmation" class="text-lg font-lg">Confirm Password</label>
                                </dt>
                                <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                  <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="passwordForm.password_confirmation" placeholder="**********"  autocomplete="new-password" />
                                </dd>
                                
                            </div>
                            <div class="mt-1">
                                <div 
                                    v-if="errors.password"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.password }}
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 flex justify-between items-center sm:gap-4 sm:px-6">
                                <dt class="">
                                    <span v-if="message" class="text-lg font-lg text-green-500">
                                        {{ message }}
                                    </span>
                                </dt>
                                <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                    <BreezeButton 
                                        class="w-full py-3 px-4 text-center bg-primary-blue flex justify-between items-center" 
                                        :class="{ 'opacity-25': passwordForm.processing }" :disabled="passwordForm.processing">
                                        <svg 
                                            v-if="processing"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="50" cy="50" fill="none" stroke="#f8f8fc" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                            </circle>
                                        </svg>

                                        <span class="ml-3">Save</span>

                                    </BreezeButton>
                                </dd>
                                
                            </div>

                            
                        </dl>
                    </div>

                </form>
              
            </div>

            <div 
                v-if="select === 'logout'"
                class="bg-white flex justify-between w-full">
                <div class="px-4 py-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Are you sure? 
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      You are going to log out.
                    </p>
                </div>

                <div class="px-4 py-2">
                    <Link 
                        :href="route('logout')"
                        method="post" 
                        as="button"
                        class="block flex justify-between items-center w-full px-4 py-2 text-left text-sm leading-5 bg-primary-blue hover:opacity-60 rounded-lg text-white focus:outline-none transition duration-150 ease-in-out">
                            Log out
                    </Link>
                    
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
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import BreezeButton from '@/Components/Button.vue'

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
        BreezeLabel,
        BreezeValidationErrors,
        BreezeButton,
        
    },
    props: {
        
        authenicated : Object,
        
    },
    data(){
        return {
            
            select  : 'account',

            message : '',
            processing :false,
            
            accountForm : {
                name   : '',
                email  : '',
            },
            passwordForm : {
                password : '',
                password_confirmation  : '',
            }
            
        }
    },
    mounted(){
        this.accountForm = {
                name   : this.authenicated.name,
                email  : this.authenicated.email
            }
    },
    computed: {
        
        isAccount() {
            return {
              'border-gray-900 text-gray-900': this.select === 'account'
            }
        },
        isPassword() {
            return {
              'border-gray-900 text-gray-900': this.select === 'password'
            }
        },
        isLogout() {
            return {
              'border-gray-900 text-gray-900': this.select === 'logout'
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
    
    methods: {
        updateAccount(){
            this.processing = true;
            this.$inertia.patch(`/account/${this.authenicated.id}`, this.accountForm, {
                preserveScroll: true,
                onSuccess: () => this.message = 'Your account has been updated.'
            })
            
        },
        updatePassword(){
            this.processing = true;
            this.$inertia.patch(`/password/${this.authenicated.id}`, this.passwordForm, {
                preserveScroll: true,
                onSuccess: () => this.message = 'Your password has been changed.'
            })

        },

        format(date){
            dayjs.extend(relativeTime)
            return dayjs(date).from() // in 22 years
                // return dayjs(date).format('ddd, MMM D, YYYY h:mm A');
        },
        limit(string, num){
           return string.substring(0, num);
        },
        reset(){
            this.passwordForm = {
                password  : '',
                password_confirmation  : ''
            }
            this.accountForm = {
                name    : '',
                email   : ''
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
