<script setup>
    import { Link, useForm } from '@inertiajs/vue3'
    import Layout from '../Layout.vue';
    import { ZiggyVue } from 'ziggy-js'

    const form = useForm({
        jsonfile: null,
    })

    function submit() {
        form.post(route('upload.store'))
    }

    defineProps({})
</script>

<template>
    <Layout>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Upload new JSON</h4>
                    <p class="card-description">
                        Upload a JSON file to covert it into an excel file.
                    </p>
                    <form class="forms-sample" @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fileupload">* File</label>
                            <input type="file" @input="form.jsonfile = $event.target.files[0]" class="form-control h-100" id="fileupload" accept="application/json" required>
                        </div>
                        <button type="submit" class="btn btn-primary me-2 text-white" :disabled="form.processing">Submit</button>
                        <Link class="btn btn-light" :href="route('dashboard')">Cancel</Link>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>