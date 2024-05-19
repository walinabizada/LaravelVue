<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, Head } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'
import SearchInput from '@/Components/SearchInput.vue'
import { ref, watch } from 'vue'
import { usePage, router as inertia } from '@inertiajs/vue3'
import Icon from '@/Components/Icon.vue'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import moment from 'moment'
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

// Destructure props from the Inertia page object
const { props } = usePage()
const { filters , kbms } = props
const CharLen = 20

// Reactive form state
const form = ref({
    search: filters.search,
})

// Throttled search handler
const handleSearch = throttle(() => {
    inertia.get(route('dashboard.kbm.index'), pickBy(form.value), { preserveState: false })
}, 150)

// Watch form changes and trigger search
watch(form, handleSearch, { deep: true })

// Method to reset form fields
const reset = () => {
    form.value = mapValues(form.value, () => null)
}

const destroy = (id) => {
    if (confirm('Are you sure you want to delete this knowledge base?')) {
        inertia.delete(route('dashboard.kbm.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                handleSearch() // Changed from filters to filter
            },
        });
    }
}

</script>

<template>

    <Head title="Knowldege Base Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Knowldege Base Management</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" :style="'direction: rtl'">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="mb-6 flex justify-between items-center">
                        <search-input v-model="form.search" class="w-full max-w-md mr-4" @reset="reset"></search-input>
                        <Link class="btn-indigo" :href="route('dashboard.kbm.create')">
                        <span>
                            <PrimaryButton class="ms-4">
                                Create New
                            </PrimaryButton>
                            </span>
                        
                        </Link>
                    </div>
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">Service Name</th>
                                <th class="px-6 pt-6 pb-4">Implementation Side</th>
                                <th class="px-6 pt-6 pb-4">Time Frame</th>
                                <th class="px-6 pt-6 pb-4">Needed Document</th>
                                <th class="px-6 pt-6 pb-4">Fees</th>
                                <th class="px-6 pt-6 pb-4">Legal Document</th>
                                <th class="px-6 pt-6 pb-4">Implementation Procedures</th>
                                <th class="px-6 pt-6 pb-4">Course of Action</th>
                                <th class="px-6 pt-6 pb-4">Created</th>
                            </tr>
                            <tr v-for="kbm in kbms.data" :key="kbm.id"
                                class="hover:bg-gray-100 focus-within:bg-gray-100">
                                <td class="border-t">
                                    <Link class="px-6 py-4 flex items-center focus:text-indigo-500"
                                        :href="route('dashboard.kbm.edit', kbm.id)">
                                        {{ kbm.service_name.length > CharLen ? kbm.service_name.substring(0, CharLen) + '...' : kbm.service_name }}
                                    </Link>
                                </td>

                                <td class="border-t">
                                    <!-- {{ kbm.implementation_side }} -->
                                    {{ kbm.implementation_side.length > CharLen ? kbm.implementation_side.substring(0, CharLen) + '...' : kbm.implementation_side }}
                                </td>

                                <td class="border-t">
                                    <!-- {{ kbm.time_frame }} -->
                                    {{ kbm.time_frame.length > CharLen ? kbm.time_frame.substring(0, CharLen) + '...' : kbm.time_frame }}
                                </td>

                                <td class="border-t">
                                    <!-- {{ kbm.needed_document }} -->
                                    {{ kbm.needed_document.length > CharLen ? kbm.needed_document.substring(0, CharLen) + '...' : kbm.needed_document }}
                                </td>

                                <td class="border-t">
                                    <!-- {{ kbm.fees }} -->
                                    {{ kbm.fees.length > CharLen ? kbm.fees.substring(0, CharLen) + '...' : kbm.fees }}
                                </td>

                                <td class="border-t">
                                    <!-- {{ kbm.legal_document }} -->
                                    {{ kbm.legal_document.length > CharLen ? kbm.legal_document.substring(0, CharLen) + '...' : kbm.legal_document }}
                                </td>

                                <td class="border-t">
                                    <!-- {{ kbm.implementation_procedures }} -->
                                    {{ kbm.implementation_procedures.length > CharLen ? kbm.implementation_procedures.substring(0, CharLen) + '...' : kbm.implementation_procedures }}
                                </td>

                                <td class="border-t">
                                    <!-- {{ kbm.course_of_action }} -->
                                    {{ kbm.course_of_action.length > CharLen ? kbm.course_of_action.substring(0, CharLen) + '...' : kbm.course_of_action }}
                                </td>

                                <td class="border-t">
                                    {{ moment(kbm.updated_at).fromNow(true) }}
                                </td>
                                 
                                <td class="border-t w-px">
                                    <Link class="px-4 flex items-center" :href="'#'" @click="destroy(kbm.id)"
                                        tabindex="-1">
                                        <icon name="trash" class="block w-6 h-6 fill-gray-400" />
                                    </Link>
                                </td>
                            </tr>
                            <tr v-if="kbms.data.length === 0">
                                <td class="border-t px-6 py-4" colspan="4">No kbm found.</td>
                            </tr>
                        </table>
                    </div>
                    <pagination class="mt-6" :links="kbms.links" />
                </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
