<template>
    <Head title="Welcome" />

    <GuestLayout>
    
        <div class="max-w-3xl mx-auto px-3 sm:px-6 lg:px-8 py-3 bg-white rounded-lg flex">
            <div class="w-full md:w-1/2 pl-3 md:pl-4 pr-3 md:pr-6  py-3">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    stroke-linecap="round" stroke-linejoin="round" 
                    class="h-6 w-6 text-primary-blue">

                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>

                <!-- Form -->
                <div class="mt-6">
                    <!-- <BreezeValidationErrors /> -->
                    
                    <!-- Login Form -->
                    <form 
                        v-if="!formStatus"
                        @submit.prevent="login"
                        >
                        <div>
                            <BreezeLabel for="email" value="Email" />
                            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="loginForm.email"  autofocus autocomplete="username" />
                            <div class="mt-1">
                                <div 
                                    v-if="errors.email"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="password" value="Password" />
                            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="loginForm.password"  autocomplete="current-password" />
                            <div class="mt-1">
                                <div 
                                    v-if="errors.password"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.password }}
                                </div>
                            </div>
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <BreezeCheckbox name="remember" v-model:checked="loginForm.remember" />
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <!-- <Link  :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Forgot your password?
                            </Link> -->

                            <BreezeButton 
                                class="w-full py-3 px-4 text-center bg-primary-blue flex justify-between items-center" 
                                :class="{ 'opacity-25': loginForm.processing }" :disabled="loginForm.processing">
                                <span>Log in</span>
                                <svg 
                                    v-if="processing"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                    <circle cx="50" cy="50" fill="none" stroke="#f8f8fc" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                      <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                    </circle>
                                </svg>
                            </BreezeButton>

                        </div>
                        <div class="flex justify-center mt-2">
                            <span 
                                @click="toggleForm"
                                class="underline cursor-pointer text-center text-sm text-gray-600 hover:text-gray-900 font-medium">
                                Don't have an account? Signup
                            </span>
                        </div>
                    </form>
                    <!-- Signup Form -->
                    <form 
                        v-else
                        @submit.prevent="signup">
                        <div>
                            <BreezeLabel for="name" value="Name" />
                            <BreezeInput id="name" type="text" 
                                class="mt-1 block w-full border"
                                :class="`{errors.name ? 'border-red-400' : ''}`" 
                                v-model="signupForm.name" 
                                 autofocus autocomplete="name" />

                            <div class="mt-1">
                                <div 
                                    v-if="errors.name"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.name }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="email" value="Email" />
                            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="signupForm.email"  autocomplete="username" />
                            <div class="mt-1">
                                <div 
                                    v-if="errors.email"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="password" value="Password" />
                            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="signupForm.password"  autocomplete="new-password" />

                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="password_confirmation" value="Confirm Password" />
                            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="signupForm.password_confirmation"  autocomplete="new-password" />
                            <div class="mt-1">
                                <div 
                                    v-if="errors.password"
                                    class="text-red-500 text-md font-semibold">
                                        {{ errors.password }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">


                            <BreezeButton 
                                class="w-full px-3 py-3 bg-primary-blue flex justify-between items-center" 
                                :class="{ 'opacity-25': signupForm.processing }" :disabled="signupForm.processing">
                                <span class="mr-2">Signup</span>
                                <svg 
                                    v-if="processing"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  none repeat scroll 0% 0%; display: block; shape-rendering: auto; padding:0;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                    <circle cx="50" cy="50" fill="none" stroke="#f8f8fc" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
                                      <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                                    </circle>
                                </svg>
                                
                            </BreezeButton>
                        </div>
                        <div class="flex justify-center mt-2">
                            <span 
                                @click="toggleForm"
                                class="underline cursor-pointer text-center text-sm text-gray-600 hover:text-gray-900 font-medium">
                                Already registered?
                            </span>
                        </div>
                    </form>

                </div>
                
            </div>
            
            <div class="hidden md:flex md:w-1/2 py-2"> 
                
                <img 
                    :src="`/images/messenger2.svg`"
                    class="w-full h-full inset-0">

            </div>
            
        </div>

    </GuestLayout>

</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
import GuestLayout from '@/Layouts/Guest.vue'
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        GuestLayout,
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
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
            }
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
    },
    methods: {
        login(){
            this.processing = true;
            this.$inertia.post(`/login`, this.loginForm, {
                preserveScroll: true,
            })
        },
        signup(){
            this.processing = true;
            this.$inertia.post(`/signup`, this.signupForm, {
                preserveScroll: true,
            })
        },
        reset(){
            this.loginForm = {
                    email     : '',
                    password  : '',
                    remember  : ''
                };

            this.signupForm = {
                    name         : '',
                    email        : '',
                    password     : '',
                    password_confirmation : ''
                };

        },
        toggleForm(){
            this.formStatus = !this.formStatus;
            this.processing = false;
            this.$page.props.errors = {};
            this.reset();
        }
    }
};
</script>
