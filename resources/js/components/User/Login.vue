<script>

import axios from "axios";
export default {
    name: "Login",

    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            error: null
        }
    },

    methods: {
        login() {
            axios
                .post('/api/auth/login', this.form)
                .then(res => localStorage.setItem('access_token', res.data["access_token"]))
                .then(() => this.$router.push({name: 'user.personal'}))
                .catch(e => this.error = e.response.data.error)
        }
    }
}

</script>

<template>
    <div class="border rounded-3 p-3 w-25 position-absolute top-50 start-50 translate-middle">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input v-model="form.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input v-model="form.password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div v-if="error" class="alert alert-danger" role="alert">{{this.error}}</div>
        <button @click.prevent="login()" type="button" class="btn btn-primary">Submit</button>
    </div>
</template>

<style scoped>

</style>
