<template>
    <Link class="block flex justify-between items-center w-full px-4 py-2 text-left text-sm leading-5 text-blue-700 border-r border-transparent hover:border-primary-blue focus:outline-none transition duration-150 ease-in-out">
        <slot />
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    }
}
</script>
