<template>
    <div>
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('transactions')">Transactions</inertia-link>
            <span class="text-indigo-400 font-medium">/</span> Create
        </h1>
        <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <select-input v-model="form.SenderId" :error="errors.SenderId" class="pr-6 pb-8 w-full lg:w-1/2" label="Sender">
                        <option :value="null"></option>
                        <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{customer.name}}</option>
                    </select-input>

                    <select-input v-model="form.BeneficiaryId" :error="errors.beneficiaryId" class="pr-6 pb-8 w-full lg:w-1/2" label="Beneficiary">
                        <option :value="null"></option>
                        <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{customer.name}}</option>
                    </select-input>

                    <text-input v-model="form.amount" :error="errors.amount" class="pr-6 pb-8 w-full lg:w-1/2" label="Amount" />

                    <select-input v-model="form.TransactionType" :error="errors.TransactionType" class="pr-6 pb-8 w-full lg:w-1/2" label="Transaction Type">
                        <option :value="null"></option>
                        <option v-for="transaction_type in transaction_types" :key="transaction_type" :value="transaction_type">{{ transaction_type }}</option>
                    </select-input>

                    <select-input v-model="form.PaymentMethod" :error="errors.PaymentMethod" class="pr-6 pb-8 w-full lg:w-1/2" label="Payment Method">
                        <option :value="null"></option>
                        <option v-for="payment_method in payment_methods" :key="payment_method" :value="payment_method">{{ payment_method }}</option>
                    </select-input>

                    <select-input v-model="form.currency" :error="errors.currency" class="pr-6 pb-8 w-full lg:w-1/2" label="Currency">
                        <option v-for="currency in currencies" :key="currency" :value="currency">{{ currency }}</option>
                    </select-input>

                    <select-input v-model="form.status" :error="errors.status" class="pr-6 pb-8 w-full lg:w-1/2" label="Status">
                        <option :value="null"></option>
                        <option v-for="item in  transaction_status" :key="item" :value="item">{{ item }}</option>
                    </select-input>
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <loading-button :loading="sending" class="btn-indigo" type="submit">Create Transaction</loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'

export default {
    metaInfo: { title: 'Create Transaction' },
    layout: Layout,
    components: {
        LoadingButton,
        SelectInput,
        TextInput,
    },
    props: {
        errors: Object,
        customers: Array,
        transaction_types: Array,
        payment_methods: Array,
        currencies: Array,
        transaction_status: Array
    },
    remember: 'form',
    data() {
        return {
            sending: false,
            form: {
                SenderId: null,
                BeneficiaryId: null,
                amount: null,
                PaymentMethod: null,
                TransactionType: null,
                currency: null,
                status: null,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post(this.route('transactions.store'), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },
    },
}
</script>
