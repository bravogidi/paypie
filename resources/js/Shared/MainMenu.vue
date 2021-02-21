<template>
    <div>
        <div class="mb-4">
            <inertia-link class="flex items-center group py-3" :href="route('dashboard')">
                <icon name="dashboard" class="w-4 h-4 mr-2" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
                <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
            </inertia-link>
        </div>
        <div class="mb-4">
            <inertia-link class="flex items-center group py-3" :href="route('customers')">
                <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('customers') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
                <div :class="isUrl('customers') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Customers</div>
            </inertia-link>
        </div>
        <div class="mb-4">
            <inertia-link class="flex items-center group py-3" :href="route('transactions')">
                <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('transactions') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
                <div :class="isUrl('transactions') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Transactions</div>
            </inertia-link>
        </div>
        <div class="mb-4">
            <inertia-link class="flex items-center group py-3" :href="route('users')">
                <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('users') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
                <div :class="isUrl('users') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Users</div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
    components: {
        Icon,
    },
    props: {
        url: String,
    },
    methods: {
        isUrl(...urls) {
            if (urls[0] === '') {
                return this.url === ''
            }

            return urls.filter(url => this.url.startsWith(url)).length
        },
    },
}
</script>
