<script setup>
    import { Link } from '@inertiajs/vue3'
    import Layout from '../Layout.vue'
    import { ZiggyVue } from 'ziggy-js'
    import Echo from 'laravel-echo';
    import { ref } from 'vue';

    const props = defineProps({ 
        files: Object,
    })

    const files = ref(props.files.map(file => ({
        ...file,
        status: file.has_converted_file ? 'Converted' : 'Pending'
    })));


    window.Echo.channel('job-haru')
        .listen('ConversionDone', (e) => {
            const fileIndex = files.value.findIndex(f => f.name === e.file);
            if (fileIndex !== -1) {
                files.value[fileIndex].status = 'Converted';
            }
        });

</script>

<template>
    <Layout>
        <div class="col-lg-12 mt-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Files</h4>
                    <Link :href="route('upload')" class="btn btn-sm btn-success">Add New</Link>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>File</th>
                                    <th>Size</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(file, i) in files" :key="file.name">
                                    <td>{{ i + 1 }}</td>
                                    <td>{{ file.name }}</td>
                                    <td>{{ file.size }}</td>
                                    <td>{{ file.date }}</td>
                                    <td>
                                        <label :class="{'badge badge-danger': file.status === 'Pending', 'badge badge-success': file.status === 'Converted'}">{{ file.status }}</label>
                                    </td>
                                    <td>
                                        <a 
                                            :href="route('download', file.name)" 
                                            v-if="file.status === 'Converted'"
                                        >
                                            <i class="mdi mdi-download h5"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>