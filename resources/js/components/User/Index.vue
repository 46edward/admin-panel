<template>
    <div class="p-5">
        <h3>List of users</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Email</th>
                <th scope="col">Registration date</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <template v-for="user in users">
                <tr v-if="user.id !== editedUserId" class="align-text-bottom">
                    <th scope="row">{{user.id}}</th>
                    <td>{{user.firstname}}</td>
                    <td>{{user.lastname}}</td>
                    <td>{{user.email}}</td>
                    <td>{{new Date(user.created_at).toLocaleString('en-GB', {hour12: false})}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button @click.prevent="editUser(user.id, user.firstname, user.lastname, user.email)" type="button" class="btn btn-primary">Edit</button>
                            <button @click.prevent="destroyUser(user.id)" type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr v-if="user.id === editedUserId" class="align-text-bottom">
                    <th scope="row">{{user.id}}</th>
                    <td>
                        <input v-model="form.firstname" type="text" class="form-control" placeholder="First name">
                    </td>
                    <td>
                        <input v-model="form.lastname" type="text" class="form-control" placeholder="Last name">
                    </td>
                    <td>
                        <input v-model="form.email" type="email" class="form-control" placeholder="Email">
                    </td>
                    <td>{{new Date(user.created_at).toLocaleString('en-GB', {hour12: false})}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button @click.prevent="updateUser(user.id)" type="button" class="btn btn-primary">Update</button>
                            <button @click.prevent="cancelUpdateUser" type="button" class="btn btn-secondary">Cancel</button>
                        </div>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>

import API from "../../api.js";
export default {
    name: "Index",
    data() {
        return {
            users: null,
            editedUserId: null,
            form: {
                firstname: '',
                lastname: '',
                email: ''
            }
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            API.get('/api/auth/users')
                .then(users => this.users = users.data.data)
                .catch(e => console.log(e))
        },

        editUser(id, firstname, lastname, email){
            this.editedUserId = id
            this.form.firstname = firstname
            this.form.lastname = lastname
            this.form.email = email
        },
        updateUser(id){
            API.patch(`/api/auth/users/${id}`, this.form)
                .then(() => this.resetEditedUser())
                .then(() => this.getUsers())
                .catch(e => console.log(e))
            this.editedUserId = null
        },
        cancelUpdateUser(){
            this.editedUserId = null
            this.resetEditedUser()
        },
        resetEditedUser(){
            for(let i in this.form){
                this.form[i] = ''
            }
        },

        destroyUser(id){
            API.delete(`/api/auth/users/${id}`)
                .then(() => this.getUsers())
                .catch(e => console.log(e))
        }

    }
}

</script>

<style>

</style>
