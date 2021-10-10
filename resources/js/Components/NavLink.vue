<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },

    props: ['href', 'active'],

    computed: {
        classes() {
            return this.active
                ? 'inline-flex items-center border-r-2 w-full px-4 py-2 border-gray-900 text-sm text-gray-900 font-medium group leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition  duration-150 ease-in-out'
                : 'inline-flex items-center border-r-2 w-full px-4 py-2 border-transparent text-sm text-gray-300 font-medium group leading-5 text-gray-500 hover:text-gray-900 hover:border-gray-900 focus:outline-none focus:text-gray-900 focus:border-gray-900 transition duration-150 ease-in-out mb-3'
            // return this.active
            //     ? ' py-2 px-4 group text-lg font-semibold flex justify-center items-center text-gray-900 border-r-2 border-transparent hover:border-gray-900 cursor-pointer w-full border-gray-900 text-gray-900 focus:outline-none focus:border-gray-900 text-gray-900 transition  duration-150 ease-in-out'
            //     : ' py-2 px-4 group text-lg font-semibold flex justify-center items-center text-gray-900 border-r-2 border-transparent hover:border-gray-900 cursor-pointer w-full transition duration-150 ease-in-out'
        }
    }
};
</script>
<!-- // return this.active
            //     ? 'inline-flex items-center px-1 pt-1 border-b-2 border-gray-900 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition  duration-150 ease-in-out'
            //     : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
 -->