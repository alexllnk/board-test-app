<template>
    <modal name="new-project-modal" classes="p-4"
           :height="500"
           :resizable="true"
           :scrollable="true" height="auto"
    >
        <h1 class="text-center">Create New Project</h1>
        <div class="container">
            <div class="d-flex flex-column">
                <div>
                    <label for="title" class="block">Title</label>
                    <input type="text"
                           name="title"
                           id="title"
                           class="border border-blue-500 block w-full rounded"
                           :class="form.errors.title ? 'border-danger' : 'border-primary'"
                           v-model="form.title">
                    <span v-if="form.errors.title" v-text="form.errors.title[0]" class="t-red"></span>
                </div>
                <div>
                    <label for="description" class="block">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        class="border border-blue-500 block w-full rounded"
                        :class="form.errors.description ? 'border-danger' : 'border-primary'"
                        v-model="form.description"
                    >
                    </textarea>
                    <span v-if="form.errors.description" v-text="form.errors.description[0]" class="t-red"></span>
                </div>
            </div>

        </div>
        <footer class="flex justify-end mt-3">
            <button class="btn btn-outline-danger" @click="$modal.hide('new-project-modal')">Cancel</button>
            <button class="btn btn-outline-primary" @click="submit">Create Project</button>
        </footer>
    </modal>
</template>

<script>
    import LboardForm from './LboardForm';

    export default {
        mounted() {
            //console.log('Component mounted.')
        },
        data() {
            return {
                form: new LboardForm({
                    title: '',
                    description: ''
                })
            }
        },
        methods: {

            submit() {

                this.form.submit('/projects')
                    .then(response => location = response.data.message);
            }
        }
    }
</script>
