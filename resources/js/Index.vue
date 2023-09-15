<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body z-3" data-bs-theme="dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link v-if="token" class="nav-link" aria-current="page" :to="{name: 'user.index'}">Users</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="token" class="nav-link" aria-current="page" :to="{name: 'posts.index'}">Posts</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="!token" class="nav-link" aria-current="page" :to="{name: 'user.login'}">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="!token" class="nav-link" aria-current="page" :to="{name: 'user.registration'}">Registration</router-link>
                    </li>
                    <li class="nav-item">
                      <router-link v-if="token" class="nav-link" aria-current="page" :to="{name: 'user.personal'}">My Account</router-link>
                    </li>
                    <li class="nav-item">
                      <a v-if="token" @click.prevent="logOut" class="nav-link" aria-current="page" href="#">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <router-view :key="$route.fullPath"></router-view>
</template>

<script>
import api from "../api.js";
    export default {
        name: "Index",
        data() {
          return {
            token: null
          }
        },
        methods: {
          getAccessToken(){
            this.token = localStorage.getItem('access_token')
          },
          logOut(){
            api.post('/api/auth/logout')
                .then(() => {
                  localStorage.removeItem('access_token')
                  this.$router.push({name: 'user.login'})
                })
          }
        },

        updated() {
          this.getAccessToken()
        },

        mounted() {
          this.getAccessToken()
        }
    }
</script>

<style>

</style>
