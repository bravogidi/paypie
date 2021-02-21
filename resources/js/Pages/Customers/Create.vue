<template>
    <div>
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('customers')">Customers</inertia-link>
            <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <text-input v-model="form.name" :error="errors.first_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Names" />
                    <text-input v-model="form.email" :error="errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
                    <text-input v-model="form.phone" :error="errors.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Phone" />
                    <select-input v-model="form.defaultCurrency" :error="errors.defaultCurrency" class="pr-6 pb-8 w-full lg:w-1/2" label="Default Currency">
                        <option :value="null" />
                        <option value="KES">KES</option>
                        <option value="USD">USD</option>
                    </select-input>
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <loading-button :loading="sending" class="btn-indigo" type="submit">Create Customer</loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from '@/Shared/Layout';
import LoadingButton from '../../Shared/LoadingButton';
import SelectInput from '../../Shared/SelectInput';
import TextInput from '../../Shared/TextInput';

export default {
    name: 'CreateCustomer',
    metaInfo: { title: 'Create Customer' },
    layout: Layout,
    components:{
        LoadingButton,
        SelectInput,
        TextInput
    },
    props: {
        errors: Object
    },
    remember: 'form',
    data() {
        return {
            sending: false,
            form: {
                name: null,
                email: null,
                phone: null,
                defaultCurrency: null,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post(this.route('customers.store'), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },
    },
}
</script>
