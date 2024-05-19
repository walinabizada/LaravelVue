<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { Link, Head } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextareaInput from '@/Components/TextareaInput.vue';

// Destructure props from the Inertia page object
const { props } = usePage() 

// Form setup
const form = useForm({
    service_name: '',
    implementation_side: '',
    time_frame: '',
    needed_document: '',
    fees: '',
    legal_document: '',
    implementation_procedures: '',
    course_of_action: '',

})

const store = () => {
    form.post(route('dashboard.kbm.store'), {
        preserveScroll: true,
        onSuccess: () => {
            setTimeout(function (){ props.flash = {} }, 5000)
        },
    })
}
</script>

<template>

    <Head title="Create New Kbm" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Kbm</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" :style="'direction: rtl'">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="store">
                        <div class="grid grid-cols-4 gap-4">

                            <div class="mt-4">
                                <InputLabel for="service_name" value="Service Name" />

                                <TextInput id="service_name" type="text" class="mt-1 block w-full"
                                    v-model="form.service_name" required autofocus autocomplete="service_name" />

                                <InputError class="mt-2" :message="form.errors.service_name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="implementation_side" value="Implementation Side" />
                                <TextInput id="implementation_side" type="text" class="mt-1 block w-full"
                                    v-model="form.implementation_side" required 
                                    autocomplete="implementation_side" />

                                <InputError class="mt-2" :message="form.errors.implementation_side" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="time_frame" value="Time Frame" />
                                <TextInput id="time_frame" type="text" class="mt-1 block w-full"
                                    v-model="form.time_frame" required  autocomplete="time_frame" />

                                <InputError class="mt-2" :message="form.errors.time_frame" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="fees" value="Fees" />
                                <TextInput id="fees" type="text" class="mt-1 block w-full" v-model="form.fees" required
                                     autocomplete="fees" />

                                <InputError class="mt-2" :message="form.errors.fees" />
                            </div>
                            
                            <div class="mt-4">
                                <TextareaInput v-model="form.needed_document" :error="form.errors.needed_document" class="block w-full" :label="'Needed Document'" :rows="'10'" />
                                
                            </div>
                            
                            <div class="mt-4">
                                <TextareaInput v-model="form.legal_document" :error="form.errors.legal_document" class="block w-full" :label="'Legal Document'" :rows="'10'" />
                                
                            </div>
                            
                            <div class="mt-4">
                                <TextareaInput v-model="form.implementation_procedures" :error="form.errors.implementation_procedures" class="block w-full" :label="'Implementation Procedures'" :rows="'10'" />
                                
                            </div>

                            <div class="mt-4">
                                <InputLabel for="course_of_action" value="Course of Action" />
                                <TextInput id="course_of_action" type="text" class="mt-1 block w-full"
                                    v-model="form.course_of_action" required 
                                    autocomplete="course_of_action" />

                                <InputError class="mt-2" :message="form.errors.course_of_action" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between my-5">
                            <Link class="flex items-center" :href="route('dashboard.kbm.index')" tabindex="-1">
                            <PrimaryButton>
                                Back
                            </PrimaryButton>
                            </Link>
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Create Knowledge Base
                            </PrimaryButton>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
