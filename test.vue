<!-- <div>
        <div>
            <img 
                class="h-8 w-8 rounded-full border-2 border-primary-blue "
                :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&background=fff&color=3857fe`" >
        </div>
    </div> -->
    <!-- <div>
        <div class="bg-gray-100 max-h-screen overflow-y-scroll">
            <nav class="bg-white border-b border-gray-100"> -->
                <!-- Primary Navigation Menu -->
                <!-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex"> -->
                            <!-- Logo -->
                            <!-- <div class="flex-shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <BreezeApplicationLogo class="block h-9 w-auto" />
                                </Link>
                            </div> -->

                            <!-- Navigation Links -->
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </BreezeNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6"> -->
                            <!-- Settings Dropdown -->
                            <!-- <div class="ml-3 relative">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div> -->

                        <!-- Hamburger -->
                        <!-- div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div> -->

                <!-- Responsive Navigation Menu -->
                <!-- <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </BreezeResponsiveNavLink>
                        
                    </div> -->

                    <!-- Responsive Settings Options -->
                    <!-- <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </BreezeResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav> -->

            <!-- Page Heading -->
            <!-- <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header> -->

            <!-- Page Content -->
            <!-- <main>
                <slot />
            </main>
        </div>
    </div> -->

<!-- <BreezeAuthenticatedLayout>
        <div class="max-w-7xl mx-auto px-4 my-2 sm:px-6 lg:px-8">
            <div class="flex "> -->
                <!-- <div class="flex flex-col text-center items-center w-72 bg-white rounded-l-lg px-3 py-3">
                    <img
                        class="rounded-full w-24 h-24 mb-3" 
                        :src="`https://ui-avatars.com/api/?name=${authenicated.name}`" >
                    <div class="mt-4 w-full">
                        <h3 class="text-md text-primary-blue">
                            Joined Rooms
                            <span class="mr-2">{{ joinedRooms.length }}</span>
                        </h3>
                        <div class="flex flex-col w-full mt-2">
                            <div v-for="jr in joinedRooms"
                                 class="w-full bg-white shadow-lg rounded-lg mb-5 px-3 py-3 w-full ransform hover:-rotate-2 transition">
                                <a :href="`/rooms/${jr.id}`">
                                    <div class="flex justify-between items-center mb-2">
                                        <h1 class="text-lg">
                                            {{ limit(jr.name) }}
                                        </h1>
                                        <span class="text-md font-medium text-primary-blue">{{ jr.users }} joined</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="flex-1 bg-white rounded-r-lg py-3 px-3 md:pr-3"> -->

                    <!-- <div class="mb-4">
                        
                        <div class="flex justify-between items-center">
                            <h1 class="text-lg font-semibold">
                                <span class="mr-2">{{ rooms.total }}</span>
                                Available Rooms
                            </h1>
                            <div class="flex items-center relative">
                                <BreezeInput 
                                    id="keyword" type="keyword" 
                                    class=" border block w-full px-3 py-2 focus:border-transparent focus:border-white rounded-l" 
                                    v-model="keyword"  autofocus autocomplete="keyword" />
                                <svg 
                                    @click="reset"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather h-8 w-8 cursor-pointer absolute right-0 top-0 mt-1 text-red-400 hover:text-red-500"
                                        ><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                
                                
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="flex flex-col ">
                        <div 
                            v-for="r in rooms.data" 
                            class="bg-white shadow-lg rounded-lg mb-8 px-3 py-3 transform hover:-rotate-2 transition">
                            <a :href="`/rooms/${r.id}`">
                                <div class="flex justify-between items-center mb-2">
                                    <h1>
                                        <a :href="`/rooms/${r.id}`" class="text-lg">
                                            {{ r.name }}
                                        </a>
                                    </h1>
                                    <span class="text-md font-medium text-primary-blue">{{ r.users }} joined</span>
                                </div>
                                <span>{{ format(r.created) }}</span>
                                
                            </a>
                        </div>
                    </div> -->

                    <!-- Pagination forAvailble Rooms -->
                    <!-- {{rooms.total}} -->
                    <!-- <div class="mt-6 -mb-1 flex flex-wrap">
                        <template v-for="(link, key) in rooms.links">
                            <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400" :class="{ 'ml-auto': link.label === 'Next' }">
                                {{ link.label }}
                            </div>
                            <div v-else>
                                
                                <Link :href="link.url" :class="classes">

                                    <span
                                        :key="key" 
                                        class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }" >
                                        {{ link.label }}
                                    </span>
                                </Link>

                            </div>

                        </template>
                    </div> -->
                    <!-- <a
                                v-if="rooms.prev"
                                :href="`${rooms.prev}`"
                                class="cursor-pointer mr-1 mb-1 px-4 py-2 text-lg border hover:bg-white text-white hover:text-primary-blue  rounded" :class="{ }" >
                                    Prev
                                </a>
                            <span
                                v-else
                                class=" mr-1 mb-1 px-4 py-2 text-lg border rounded text-white opacity-40" :class="{  }" >
                                    Prev
                                </span>
                            <a
                                v-if="rooms.next"
                                :href="`${rooms.next}`"
                                class="cursor-pointer mr-1 mb-1 px-4 py-2 text-lg border hover:bg-white text-white hover:text-primary-blue  rounded " :class="{  }" >
                                    Next
                                </a>
                            <span
                                v-else
                                class=" mr-1 mb-1 px-4 py-2 text-lg border rounded text-white opacity-40" :class="{  }" >
                                    Next
                                </span> -->
                <!-- </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout> -->




    <div class="flex shadow-lg rounded-lg h-full">
            <!--- Left Panel  -->
            <div class="w-96 rounded-l-lg filter shadow-right bg-primary-blue h-full max-h-screen overflow-y-scroll">
                <!-- Top -->
                <div class="rounded-l-lg flex items-center justify-between px-4 py-3 ">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round" 
                        class="h-10 w-10 text-white">

                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>

                    <div class="hidden sm:flex sm:items-center sm:ml-6 ">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <BreezeDropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex bg-transparent">
                                        <button type="button" class="inline-flex shadow-none items-center py-2  text-sm leading-4 font-medium rounded-lg text-gray-500 bg-transparent hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <img 
                                                class="h-8 w-8 rounded-full border border-white"
                                                :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&background=fff&color=000`" >

                                            
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <Link 
                                        :href="route('dashboard')" 
                                        method="get" 
                                        as="button"
                                        class="px-3 py-2 rouned-t-lg block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Dashboard</span>
                                    </Link>
                                    <Link 
                                        :href="route('logout')" 
                                        method="get" 
                                        as="button"
                                        class="px-3 py-2 block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Profile</span>
                                    </Link>
                                    <Link 
                                        :href="route('logout')" 
                                        method="post" 
                                        as="button"
                                        class="px-3 py-2 rouned-b-lg block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Log Out</span>
                                    </Link>
                                    
                                </template>
                            </BreezeDropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>

                <div>
                    <!-- Search -->
                    <div class="flex items-center relative mt-4 mx-4">
                        <svg 
                            @click="reset()"
                            class="feather h-6 w-6 cursor-pointer absolute right-0 left-0 mt-0 ml-1 text-white hover:opacity-50"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <BreezeInput 
                            id="keyword" type="keyword" 
                            class="bg-primary-light rounded-tl-md rounded-bl-md text-white block w-full pl-8 py-2 focus:border-transparent focus:border-none focus:ring-0  focus:outline-none opacity-1" 
                            v-model="keyword"  autofocus autocomplete="keyword" 
                            placeholder="Search rooms.."/>
                        <label class="w-40">
                            <select
                            v-model="type" 
                            class="form-select 
                                px-3 py-2
                                rounded-r-md
                                border-white
                                form-select block focus:border-transparent focus:border-white  focus:outline-none">
                                <option value="joined">Joined</option>
                                <option value="available">Available</option>
                            </select>
                        </label>  
                        
                    </div>

                    <div class="flex flex-col text-center items-center mt-4">
                        
                        <div class="mb-4">
                                
                            <div class="flex justify-between items-center">
                                <h1 class="text-lg font-semibold text-white">
                                    <span class="mr-1">{{ rooms.total }}</span>
                                    {{ (type === 'joined') ? 'Joined' : 'Available' }} Rooms
                                </h1>
                            </div>

                        </div>
                        
                        <div class="flex flex-col w-full">
                            <div 
                                v-for="r in rooms.data" 
                                class=" px-3 py-5 transform hover:-rotate-2 transition hover:shadow-lg">
                                <a :href="`/rooms/${r.id}`">
                                    <div class="flex justify-between">
                                        <div class="flex flex-col justify-between items-start">
                                            <h1 class="text-lg text-white">
                                                {{ limit(r.name) }}
                                            </h1>
                                            <span class="text-xs text-white -mt-1">{{ format(r.created) }}</span>
                                        </div>
                                        <div class="flex flex-col justify-between items-end">
                                            
                                            <span class="text-md font-medium text-white">{{ r.users }} joined</span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </div>
                        </div>

                        <div class="mt-6 mb-4  flex flex-wrap mx-4">
                            <template v-for="(link, key) in rooms.links">
                            
                                <div 
                                    v-if="link.url === null"  >
                                    <span
                                        :key="key" 
                                        class="px-6 py-1 text-white text-lg opacity-50 border border-white mr-2 rounded" >
                                        {{ link.label }}
                                    </span>
                                </div>

                                <Link 
                                    v-else
                                    :href="link.url" 
                                    :class="classes"
                                    class="mb-4">

                                    <span
                                        :key="key" 
                                        class="cursor-pointer mr-1 mb-1 px-6 py-1 text-lg border text-white rounded hover:bg-white hover:text-primary-blue focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white text-primary-blue': link.active, 'ml-auto': link.label === 'Next' }" >
                                        {{ link.label }}
                                    </span>
                                </Link>


                            </template>
                          
                            
                        </div>

                    </div>

                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 w-2/3 px-6 py-4 rouned-r-lg h-full max-h-screen overflow-y-scroll">
                <div class="flex flex-col ">
                        <div 
                            v-for="r in rooms.data" 
                            class="bg-white shadow-lg rounded-lg mb-8 px-3 py-5 transform hover:-rotate-2 transition">
                            <a :href="`/rooms/${r.id}`">
                                <div class="flex justify-between items-center mb-2">
                                    <h1>
                                        <a :href="`/rooms/${r.id}`" class="text-lg">
                                            {{ r.name }}
                                        </a>
                                    </h1>
                                    <span class="text-md font-medium text-primary-blue">{{ r.users }} joined</span>
                                </div>
                                <span>{{ format(r.created) }}</span>
                                
                            </a>
                        </div>
                    </div>

                    
                
            </div>

    </div>

    <!-- <Guest -->

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

    <!-- Dashboard -->
    <div class="flex shadow-lg rounded-lg h-full">
            <!--- Left Panel  -->
            <div class="w-96 rounded-l-lg filter shadow-right bg-primary-blue h-full max-h-screen overflow-y-scroll">
                <!-- Top -->
                <div class="rounded-l-lg flex items-center justify-between px-4 py-3 ">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round" 
                        class="h-10 w-10 text-white">

                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>

                    <div class="hidden sm:flex sm:items-center sm:ml-6 ">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <BreezeDropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex bg-transparent">
                                        <button type="button" class="inline-flex shadow-none items-center py-2  text-sm leading-4 font-medium rounded-lg text-gray-500 bg-transparent hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <img 
                                                class="h-8 w-8 rounded-full border border-white"
                                                :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&background=fff&color=000`" >

                                            
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <Link 
                                        :href="route('dashboard')" 
                                        method="get" 
                                        as="button"
                                        class="px-3 py-2 rouned-t-lg block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Dashboard</span>
                                    </Link>
                                    <Link 
                                        :href="route('logout')" 
                                        method="get" 
                                        as="button"
                                        class="px-3 py-2 block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Profile</span>
                                    </Link>
                                    <Link 
                                        :href="route('logout')" 
                                        method="post" 
                                        as="button"
                                        class="px-3 py-2 rouned-b-lg block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Log Out</span>
                                    </Link>
                                    
                                </template>
                            </BreezeDropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>

                <div>
                    <!-- Search -->
                    <div class="flex items-center relative mt-4 mx-4">
                        <svg 
                            @click="reset()"
                            class="feather h-6 w-6 cursor-pointer absolute right-0 left-0 mt-0 ml-1 text-white hover:opacity-50"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <BreezeInput 
                            id="keyword" type="keyword" 
                            class="bg-primary-light rounded-tl-md rounded-bl-md text-white block w-full pl-8 py-2 focus:border-transparent focus:border-none focus:ring-0  focus:outline-none opacity-1" 
                            v-model="keyword"  autofocus autocomplete="keyword" 
                            placeholder="Search rooms.."/>
                        <label class="w-40">
                            <select
                            v-model="type" 
                            class="form-select 
                                px-3 py-2
                                rounded-r-md
                                border-white
                                form-select block focus:border-transparent focus:border-white  focus:outline-none">
                                <option value="joined">Joined</option>
                                <option value="available">Available</option>
                            </select>
                        </label>  
                        
                    </div>

                    <div class="flex flex-col text-center items-center mt-4">
                        
                        <div class="mb-4">
                                
                            <div class="flex justify-between items-center">
                                <h1 class="text-lg font-semibold text-white">
                                    <span class="mr-1">{{ rooms.total }}</span>
                                    {{ (type === 'joined') ? 'Joined' : 'Available' }} Rooms
                                </h1>
                            </div>

                        </div>
                        
                        <div class="flex flex-col w-full">
                            <div 
                                v-for="r in rooms.data" 
                                class=" px-3 py-5 transform hover:-rotate-2 transition hover:shadow-lg">
                                <a :href="`/rooms/${r.id}`">
                                    <div class="flex justify-between">
                                        <div class="flex flex-col justify-between items-start">
                                            <h1 class="text-lg text-white">
                                                {{ limit(r.name) }}
                                            </h1>
                                            <span class="text-xs text-white -mt-1">{{ format(r.created) }}</span>
                                        </div>
                                        <div class="flex flex-col justify-between items-end">
                                            
                                            <span class="text-md font-medium text-white">{{ r.users }} joined</span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </div>
                        </div>

                        <div class="mt-6 mb-4  flex flex-wrap mx-4">
                            <template v-for="(link, key) in rooms.links">
                            
                                <div 
                                    v-if="link.url === null"  >
                                    <span
                                        :key="key" 
                                        class="px-6 py-1 text-white text-lg opacity-50 border border-white mr-2 rounded" >
                                        {{ link.label }}
                                    </span>
                                </div>

                                <Link 
                                    v-else
                                    :href="link.url" 
                                    :class="classes"
                                    class="mb-4">

                                    <span
                                        :key="key" 
                                        class="cursor-pointer mr-1 mb-1 px-6 py-1 text-lg border text-white rounded hover:bg-white hover:text-primary-blue focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white text-primary-blue': link.active, 'ml-auto': link.label === 'Next' }" >
                                        {{ link.label }}
                                    </span>
                                </Link>


                            </template>
                          
                            
                        </div>

                    </div>

                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 w-2/3 px-6 py-4 rouned-r-lg h-full max-h-screen overflow-y-scroll">
                <div class="flex flex-col ">
                        <div 
                            v-for="r in rooms.data" 
                            class="bg-white shadow-lg rounded-lg mb-8 px-3 py-5 transform hover:-rotate-2 transition">
                            <a :href="`/rooms/${r.id}`">
                                <div class="flex justify-between items-center mb-2">
                                    <h1>
                                        <a :href="`/rooms/${r.id}`" class="text-lg">
                                            {{ r.name }}
                                        </a>
                                    </h1>
                                    <span class="text-md font-medium text-primary-blue">{{ r.users }} joined</span>
                                </div>
                                <span>{{ format(r.created) }}</span>
                                
                            </a>
                        </div>
                    </div>

                    
                
            </div>

    </div>


    //2
    <div class="flex shadow-2xl rounded-lg w-full">
            <!--- Left Panel  -->
            <div class="w-64 rounded-l-lg filter shadow-right">
                <!-- Top -->
                <div class="rounded-l-lg flex items-center justify-between px-4 py-3 ">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round" 
                        class="h-10 w-10 text-primary-blue">

                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>

                    <div class="hidden sm:flex sm:items-center sm:ml-6 ">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <BreezeDropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex bg-transparent">
                                        <button type="button" class="inline-flex shadow-none items-center py-2  text-sm leading-4 font-medium rounded-lg text-gray-500 bg-transparent hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <img 
                                                class="h-8 w-8 rounded-full border-2 border-primary-blue "
                                                :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&background=fff&color=3857fe`" >

                                            
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <Link 
                                        :href="route('dashboard')" 
                                        method="get" 
                                        as="button"
                                        class="px-3 py-2 rouned-t-lg block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Dashboard</span>
                                    </Link>
                                    <Link 
                                        :href="route('logout')" 
                                        method="get" 
                                        as="button"
                                        class="px-3 py-2 block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Profile</span>
                                    </Link>
                                    <Link 
                                        :href="route('logout')" 
                                        method="post" 
                                        as="button"
                                        class="px-3 py-2 rouned-b-lg block w-full border-r-2 border-transparent hover:border-primary-blue flex justify-end items-center">
                                        
                                        <span class="text-primary-blue font-medium text-lg">Log Out</span>
                                    </Link>
                                    
                                </template>
                            </BreezeDropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>

                <div>
                    <!-- Search -->
                    <div class="flex items-center relative mt-4 mx-4">
                        <svg 
                            @click="reset()"
                            class="feather h-6 w-6 cursor-pointer absolute right-0 left-0 mt-0 ml-1 text-primary-blue hover:opacity-50"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <BreezeInput 
                            id="keyword" type="keyword" 
                            class="bg-primary-light rounded-tl-md rounded-bl-md text-primary-blue block w-full pl-8 py-2 focus:border-transparent focus:border-none focus:ring-0  focus:outline-none opacity-1" 
                            v-model="keyword"  autofocus autocomplete="keyword" 
                            placeholder="Search rooms.."/>
                        <label class="w-40">
                            <select
                            v-model="type" 
                            class="form-select 
                                px-3 py-2
                                rounded-r-md
                                border-primary-blue
                                form-select block focus:border-transparent focus:border-primary-blue  focus:outline-none">
                                <option value="joined">Joined</option>
                                <option value="available">Available</option>
                            </select>
                        </label>  
                        
                    </div>

                    <div class="flex flex-col text-center items-center mt-4">
                        
                        <div class="mb-4">
                                
                            <div class="flex justify-between items-center">
                                <h1 class="text-lg font-semibold text-primary-blue">
                                    <span class="mr-1">{{ rooms.total }}</span>
                                    {{ (type === 'joined') ? 'Joined' : 'Available' }} Rooms
                                </h1>
                            </div>

                        </div>
                        
                        <div class="flex flex-col w-full">
                            <div 
                                v-for="r in rooms.data" 
                                class=" px-3 py-5  hover:shadow-lg">
                                <a :href="`/rooms/${r.id}`">
                                    <div class="flex justify-between">
                                        <div class="flex flex-col justify-between items-start">
                                            <h1 class="text-lg text-primary-blue">
                                                {{ limit(r.name) }}
                                            </h1>
                                            <span class="text-xs text-primary-blue -mt-1">{{ format(r.created) }}</span>
                                        </div>
                                        <div class="flex flex-col justify-between items-end">
                                            
                                            <span class="text-md font-medium text-primary-blue">{{ r.users }} joined</span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </div>
                        </div>

                        <div class="mt-6 mb-4  flex flex-wrap mx-4">
                            <template v-for="(link, key) in rooms.links">
                            
                                <div 
                                    v-if="link.url === null"  >
                                    <span
                                        :key="key" 
                                        class="px-6 py-1 text-primary-blue text-lg opacity-50 border border-primary-blue mr-2 rounded" >
                                        {{ link.label }}
                                    </span>
                                </div>

                                <Link 
                                    v-else
                                    :href="link.url" 
                                    :class="classes"
                                    class="mb-4">

                                    <span
                                        :key="key" 
                                        class="cursor-pointer mr-1 mb-1 px-6 py-1 text-lg border text-primary-blue rounded hover:bg-primary-blue hover:text-primary-blue focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-primary-blue text-primary-blue': link.active, 'ml-auto': link.label === 'Next' }" >
                                        {{ link.label }}
                                    </span>
                                </Link>


                            </template>
                          
                            
                        </div>

                    </div>

                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 w-2/3 px-6 py-4 rouned-r-lg h-full ">
                <div class="flex flex-col ">
                        <div 
                            v-for="r in rooms.data" 
                            class="bg-white shadow-lg rounded-lg mb-8 px-3 py-5 ">
                            <a :href="`/rooms/${r.id}`">
                                <div class="flex justify-between items-center mb-2">
                                    <h1>
                                        <a :href="`/rooms/${r.id}`" class="text-lg">
                                            {{ r.name }}
                                        </a>
                                    </h1>
                                    <span class="text-md font-medium text-primary-blue">{{ r.users }} joined</span>
                                </div>
                                <span>{{ format(r.created) }}</span>
                                
                            </a>
                        </div>
                    </div>

                    
                
            </div>

    </div>