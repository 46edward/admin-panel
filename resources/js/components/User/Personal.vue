<script>
import API from "../../api.js";
  export default {
    name: "Personal",

      data() {
        return {
            me: null
        }
      },

      methods: {
        getData() {
            API.post('/api/auth/me', {})
                .then(res => this.me = res.data)
        }
      },

      mounted() {
        this.getData()
      }

  }
</script>

<template>
    <div v-if="me" class="card w-25 position-absolute top-50 start-50 translate-middle">
        <div class="card-body">
            <h5 class="card-title">{{me.firstname}} {{me.lastname}}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">{{me.email}}</h6>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Registration date</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{me.id}}</th>
                    <td>{{new Date(me.created_at).toLocaleString('en-GB', {hour12: false})}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>
