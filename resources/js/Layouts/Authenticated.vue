<template>

   <div class="fixed inset-0 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <div class="fixed inset-0 flex">
                <!-- -->
                <div class=" h-full bg-gray-100 shadow-lg">
                    <div class="h-full flex flex-col  py-4">
                        

                        <div class="flex-1 overflow-y-auto">
                            

                            <div class="">
                              <div class="">
                                <ul class="flex flex-col text-center justify-center items-center">
                                    <BreezeNavLink
                                        :href="route('dashboard')"
                                        :active="route().current('dashboard')"
                                        >
                                        <svg 
                                            :class="{ 'text-gray-900' : route().current('dashboard') }"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                            class="h-8 w-8 text-gray-300  transition group-hover:text-gray-900 feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            
                                    </BreezeNavLink>
                                    <a 
                                        href="/chat" 
                                        :class="ifChatPage"
                                        class="px-4 py-2 border-r-4 mb-3 hover:border-gray-900">
                                        
                                        <svg 
                                         :class="{ 'text-gray-900' : route().current('chat') }"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-gray-300  transition  transform -rotate-90 group-hover:text-gray-900 feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                       
                                    </a>

                                    <BreezeNavLink
                                        :href="route('new')"
                                        :active="route().current('new')">
            
                                        <svg
                                            :class="{ 'text-gray-900' : route().current('new') }" 
                                            class="h-8 w-8 text-gray-300  transition  transform -rotate-90 group-hover:text-gray-900 feather-message-circle"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                       
                                    </BreezeNavLink>
                                    
                                    <BreezeNavLink
                                        :href="route('account')"
                                        :active="route().current('account')"
                                        >
                                       <svg 
                                         :class="{ 'text-gray-900' : route().current('account') }"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-gray-300  transition group-hover:text-gray-900 feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                    </BreezeNavLink>

                                </ul>
                              </div>
                            </div>
                        </div>

                        <div class="flex flex-col text-center justify-center items-center border-t border-gray-200 py-4">
                            <img 
                                class="h-8 w-8 border-2 border-gray-900 rounded-full"
                                :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&background=fff&color=0f1624`" >
                            
                        </div>
                    </div>
                </div>
                
                <!-- Second Column  -->
                <slot name="tab" />

                
                <slot />
            

                <slot name="room" />
            </div>
        </div>
    </div>
    
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        }
    },
    methods:{
        isChatPage(){
            return route().current('chat')
                ? 'inline-flex items-center border-r-4 w-full px-4 py-2 border-gray-900 text-sm text-gray-900 font-medium group leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition  duration-150 ease-in-out mb-3'
                : 'inline-flex items-center border-r-4 w-full px-4 py-2 border-gray-300 text-sm text-gray-300 font-medium group leading-5 text-gray-500 hover:text-gray-900 hover:border-gray-900 focus:outline-none focus:text-gray-900 focus:border-gray-900 transition duration-150 ease-in-out mb-3'
        }
    }
};
</script>
