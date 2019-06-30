<template>
    <div class="w-1/2 rounded overflow-hidden shadow-lg mb-4 mx-auto">
        <div class="px-6 py-4">
            <select @change="update" v-if="creationMode === false" v-model="input.status_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option
                        v-for="status in statuses"
                        :value="status.id"
                        :key="status.name"
                        :selected="status.id === status_id ? 'selected' : ''"
                >{{ status.name }}</option>
            </select>
            <h2 v-else>New task</h2>
        </div>
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2" v-if="creationMode === false">{{ name }}</div>
            <input type="text" v-else class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" v-model="input.name"/>
            <p class="text-gray-700 text-base" v-if="creationMode === false">
                {{ description }}
            </p>
            <textarea v-else class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" v-model="input.description"></textarea>
        </div>
        <div class="px-6 py-4" v-if="creationMode === false">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ created_at | formatDate }}</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ updated_at | formatDate }}</span>
        </div>
        <div class="px-6 py-4">
            <button v-if="creationMode" @click="create" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Create</button>
            <button v-else @click="del" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Delete</button>
        </div>
    </div>
</template>
<script>
    export default {
        computed: {
        },
        data() {
            return {
                input: {
                    status_id: 1,
                    name: '',
                    description: ''
                }
            }
        },
        methods: {
            update(val) {
                this.$emit('update', this.id, val.target.selectedOptions[0].value);
            },
            del() {
                this.$emit('delete', this.id);
            },
            create() {
                this.$emit('create', this.input.name, this.input.description, this.input.status_id);
                this.input = {
                    status_id: 1,
                    name: '',
                    description: ''
                };
            }
        },
        props: {
            id: Number,
            status_id: Number,
            name: String,
            description: String,
            statuses: Array,
            creationMode: Boolean,
            created_at: String,
            updated_at: String
        },
        created() {
        },
        filters: {
            formatDate(string) {
                return string.substring(8,10) + '/' + string.substring(5,7) + '/' + string.substring(0, 4) + ' ' + string.substring(11, 19);
            }
        }
    }
</script>
<style>
</style>