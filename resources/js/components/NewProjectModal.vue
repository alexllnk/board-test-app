<template>
    <modal name="new-project-modal" classes="p-4"
           :height="500"
            :resizable="true"
           :scrollable="true" height="auto"
    >
        <h1 class="text-center">Let's Start Something New</h1>
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
            <div class="d-flex flex-column">
                <div>
                    <label class="block">Add Tasks</label>
                    <input
                        type="text"
                        class="border border-blue-500 d-block w-full rounded"
                        v-model="task.body" v-for="task in form.tasks">
                </div>
                <div class="mt-3">
                    <button class="btn btn-outline-secondary btn-sm" @click="addTask">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                            <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/>
                        </svg>
                        <span class="ml-2">
                        Add New Task
                    </span>
                    </button>
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
            console.log('Component mounted.')
        },
        data() {
            return {
                form: new LboardForm({
                    title: '',
                    description: '',
                    tasks: [
                        {
                            body: ''
                        }
                    ]
                })
            }
        },
        methods: {
            addTask() {
                this.form.tasks.push({body: ''});
            },
            async submit() {
                if (! this.form.tasks[0].body) {
                    delete this.form.originalData.tasks;
                }
                this.form.submit('/projects')
                    .then(response => location = response.data.message);
            }
        }
    }
</script>
