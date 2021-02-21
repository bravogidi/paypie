<template>
    <div>
        <h1 class="mb-8 font-bold text-3xl">Transactions</h1>
        <div class="mb-6 flex justify-between items-center">
            <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
                <label class="block text-gray-700">Trashed:</label>
                <select v-model="form.trashed" class="mt-1 w-full form-select">
                    <option :value="null" />
                    <option value="with">With Trashed</option>
                    <option value="only">Only Trashed</option>
                </select>
            </search-filter>
            <inertia-link class="btn-indigo" :href="route('transactions.create')">
                <span>Create</span>
                <span class="hidden md:inline">Transaction</span>
            </inertia-link>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Date/Time</th>
                    <th class="px-6 pt-6 pb-4">Sender</th>
                    <th class="px-6 pt-6 pb-4">Beneficiary</th>
                    <th class="px-6 pt-6 pb-4" >Transaction Type</th>
                    <th class="px-6 pt-6 pb-4" >Payment Method</th>
                    <th class="px-6 pt-6 pb-4" >Currency</th>
                    <th class="px-6 pt-6 pb-4" >Amount</th>
                    <th class="px-6 pt-6 pb-4" >Ref.</th>
                    <th class="px-6 pt-6 pb-4" >Order Ref.</th>
                    <th class="px-6 pt-6 pb-4" >Status</th>
                    <th class="px-6 pt-6 pb-4"></th>
                </tr>
                <tr v-for="transaction in transactions.data" :key="transaction.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('transactions.edit', transaction.id)">
                            {{transaction.created_at}}
                            <icon v-if="transaction.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center" :href="route('transactions.edit', transaction.id)" tabindex="-1">
                            <div v-if="transaction.SenderId">
                                {{ transaction.sender.name }}
                            </div>
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center" :href="route('transactions.edit', transaction.id)" tabindex="-1">
                            {{ transaction.beneficiary.name }}
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center" :href="route('transactions.edit', transaction.id)" tabindex="-1">
                            {{ transaction.TransactionType }}
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center" :href="route('transactions.edit', transaction.id)" tabindex="-1">
                            {{ transaction.PaymentMethod }}
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center" :href="route('transactions.edit', transaction.id)" tabindex="-1">
                            {{ transaction.Currency }}
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center" :href="route('transactions.edit', transaction.id)" tabindex="-1">
                            {{ transaction.Amount }}
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        {{ transaction.RefNo }}
                    </td>
                    <td class="border-t">
                        {{ transaction.OrderRef }}
                    </td>
                    <td class="border-t">
                        {{ transaction.Status }}
                    </td>
                    <td class="border-t">
                        <inertia-link class="px-4 flex items-center" :href="route('transactions.edit', transaction.id)" tabindex="-1">
                            <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                        </inertia-link>
                    </td>
                </tr>
                <tr v-if="transactions.data.length === 0">
                    <td class="border-t px-6 py-4" colspan="4">No transactions found.</td>
                </tr>
            </table>
        </div>
        <pagination :links="transactions.links" />
    </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import pickBy from 'lodash/pickBy'
import SearchFilter from '@/Shared/SearchFilter'
import throttle from 'lodash/throttle'

export default {
    metaInfo: { title: 'Transactions' },
    layout: Layout,
    components: {
        Icon,
        Pagination,
        SearchFilter,
    },
    props: {
        transactions: Object,
        filters: Object,
    },
    data() {
        return {
            form: {
                search: this.filters.search,
                trashed: this.filters.trashed,
            },
        }
    },
    watch: {
        form: {
            handler: throttle(function() {
                let query = pickBy(this.form)
                this.$inertia.replace(this.route('transactions', Object.keys(query).length ? query : { remember: 'forget' }))
            }, 150),
            deep: true,
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },
}
</script>
