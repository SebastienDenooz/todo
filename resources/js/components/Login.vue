<template>
    <div class="container mx-auto">
        <div class="w-1/2 mx-auto mt-4">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input v-model="input.username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input v-model="input.password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                </div>
                <div class="flex items-center justify-between">
                    <button v-on:click="login()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Login',
        data() {
            return {
                input: {
                    username: '',
                    password: ''
                }
            }
        },
        methods: {
            login() {
                if(this.input.username !== '' && this.input.password !== '') {
                    var data = new FormData();
                    data.set('email', this.input.username);
                    data.set('password', this.input.password);
                    var authOptions = {
                        method: 'POST',
                        url: '/login',
                        data: data,
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Accept': 'application/json'
                        },
                        json: true
                    };
                    window.axios(authOptions).then(({ data }) => {
                        this.$emit('authenticated', true);
                        this.$router.replace({ name: 'secure' });
                    });
                } else {
                    console.log('A username and password must be present');
                }
            }
        }
    }
</script>

<style scoped>
</style>