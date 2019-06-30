<template>
    <div class="container mx-auto">
        <task-component :statuses="statuses"
                        :creationMode=true
                        @create="create"
        ></task-component>
        <task-component :statuses="statuses"
                        v-for="task in tasks"
                        v-bind="task"
                        :creationMode=false
                        :key="task.id"
                        @update="update"
                        @delete="del"
        ></task-component>
    </div>
</template>

<script>
    function Task({ id, name, description, status_id, created_at, updated_at}) {
        this.id = id;
        this.name = name;
        this.status_id = status_id;
        this.description = description;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
    function Status({ id, name}) {
        this.id = id;
        this.name = name;
    }
    import TaskComponent from './Task.vue';
    export default {
        name: 'Secured',
        data() {
            return {
                tasks: [],
                statuses: [],
                working: false
            }
        },
        methods: {
            create(name, description, status_id) {
                console.log(name + description + status_id);
                window.axios.post('/api/task', {name, description, status_id}).then(({ data }) => {
                    this.tasks.unshift(new Task(data));
                });
            },
            read() {
                window.axios.get('/api/task').then(({ data }) => {
                    data.forEach(task => {
                        this.tasks.push(new Task(task));
                    });
                });
                window.axios.get('/api/status').then(({ data }) => {
                    data.forEach(status => {
                        this.statuses.push(new Status(status));
                    });
                });
            },
            update(id, status) {
                window.axios.put(`/api/task/${id}`, { status }).then(() => {
                    this.tasks.find(task => task.id === id).status = status;
                });
            },
            del(id) {
                window.axios.delete(`/api/task/${id}`).then(() => {
                    let index = this.tasks.findIndex(task => task.id === id);
                    this.tasks.splice(index, 1);
                });
            }
        },
        components: {
            TaskComponent
        },
        created() {
            this.read();
        }
    }
</script>

<style scoped>
</style>