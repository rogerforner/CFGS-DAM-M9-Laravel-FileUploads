<template>
    <div id="create-users-form">
        <form @submit.prevent="submit" accept-charset="UTF-8" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name: </label>
                <input id="name" type="text" name="name" placeholder="Place your name here" value="" v-model="name">
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input id="email" type="text" name="email" placeholder="Place your email here" value="" v-model="email">
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input id="password" type="password" name="password" placeholder="Place your password here" value="" v-model="password">
            </div>
            <div class="form-group">
                <label for="file">File: </label>
                <input id="file" type="file" name="file" value="">
            </div>
            <button type="submit" id="create-user-button" class="btn btn-primary">Create</button>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component CreateUsersForm mounted.')
        },
        data() {
            return {
                name: '',
                email: '',
                password: ''
            }
        },
        methods: {
            submit() {
                var data = new FormData();
                data.append('name', this.name);
                data.append('email', this.email);
                data.append('password', this.password);
                data.append('file', document.getElementById('file').files[0]);
                window.axios.post('/api/v1/user', data).then(function (response){
                    console.log(response)
                }).catch(function (error) {
                    console.log(error)
                });
            }
        }
    }
</script>