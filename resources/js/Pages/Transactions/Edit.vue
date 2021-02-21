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
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                    <button v-if="!transaction.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Transaction</button>
                    <loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">Update Transaction</loading-button>
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
        transaction: Object,
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
                SenderId: this.transaction.SenderId,
                BeneficiaryId: this.transaction.BeneficiaryId,
                amount: this.transaction.Amount,
                PaymentMethod: this.transaction.PaymentMethod,
                TransactionType: this.transaction.TransactionType,
                currency: this.transaction.Currency,
                status: this.transaction.Status,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post(this.route('transactions.update'), this.form, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },
        destroy() {
            if (confirm('Are you sure you want to delete this customer?')) {
                this.$inertia.delete(this.route('transactions.destroy', this.transaction.id))
            }
        },
        restore() {
            if (confirm('Are you sure you want to restore this customer?')) {
                this.$inertia.put(this.route('transactions.restore', this.transaction.id))
            }
        },
    },
}
</script>
