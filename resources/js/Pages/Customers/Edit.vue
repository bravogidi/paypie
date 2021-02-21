<template>
    <div>
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('customers')">Customers</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            {{ form.name }}
        </h1>
        <trashed-message v-if="customer.deleted_at" class="mb-6" @restore="restore">
            This customer has been deleted.
        </trashed-message>
        <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <text-input v-model="form.name" :error="errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
                    <text-input v-model="form.email" :error="errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
                    <text-input v-model="form.phone" :error="errors.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Phone" />
<!--                    <select-input v-model="form.defaultCurrency" :error="errors.defaultCurrency" class="pr-6 pb-8 w-full lg:w-1/2" label="Default Currency">-->
<!--                        <option :value="null" />-->
<!--                        <option v-for="currency in currencies" :key="currency" :value="currency">{{ currency }}</option>-->
<!--                    </select-input>-->
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <button v-if="!customer.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Customer</button>
                    <loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">Update Customer</loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from '@/Shared/Layout';
import LoadingButton from '../../Shared/LoadingButton';
// import SelectInput from '../../Shared/SelectInput';
import TextInput from '../../Shared/TextInput';
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
    name: 'EditCustomer',
    metaInfo() {
        return {
            title: `${this.form.name}`,
        }
    },
    layout: Layout,
    components:{
        LoadingButton,
        //SelectInput,
        TextInput,
        TrashedMessage
    },
    props: {
        errors: Object,
        customer: Object,
        currencies: Array
    },
    remember: 'form',
    data() {
        return {
            sending: false,
            form: {
                name: this.customer.name,
                email: this.customer.email,
                phone: this.customer.phone,
                defaultCurrency: this.customer.defaultCurrency,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.put(this.route('customers.update', this.customer.id), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },
        destroy() {
            if (confirm('Are you sure you want to delete this customer?')) {
                this.$inertia.delete(this.route('customers.destroy', this.customer.id))
            }
        },
        restore() {
            if (confirm('Are you sure you want to restore this customer?')) {
                this.$inertia.put(this.route('customers.restore', this.customer.id))
            }
        },
    },
}
</script>
