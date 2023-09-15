<template>
    <div class="p-5">
        <div class="d-flex justify-content-between">
            <h3>List of posts</h3>
            <button @click.prevent="$router.push({name: 'posts.create'})" type="button" class="btn btn-outline-secondary">Create new post</button>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Created at</th>
                <th scope="col">Tags</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <template v-for="post in posts">
                <tr v-if="editedPostId !== post.id" class="align-text-bottom">
                    <th scope="row">{{post.id}}</th>
                    <td>{{post.title}}</td>
                    <td>{{post.content}}</td>
                    <td>{{new Date(post.date).toLocaleString('en-GB', {hour12: false})}}</td>
                    <td>
                        <div v-for="tag in post.tags" class="d-inline">
                            <span class="badge rounded-pill text-bg-secondary me-1">{{tag.name}}</span>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button @click.prevent="editPost(post.id, post.title, post.content)" type="button" class="btn btn-primary">Edit</button>
                            <button @click.prevent="destroyPost(post.id)" type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr v-if="editedPostId === post.id" class="align-text-bottom">
                    <th scope="row">{{post.id}}</th>
                    <td>
                        <input v-model="form.title" type="text" class="form-control" placeholder="Post title">
                    </td>
                    <td>
                        <textarea v-model="form.content" class="form-control" rows="3"></textarea>
                    </td>
                    <td>{{new Date(post.date).toLocaleString('en-GB', {hour12: false})}}</td>
                    <td>
                        <div v-for="tag in post.tags" class="d-inline">
                            <span class="badge rounded-pill text-bg-secondary me-1">{{tag.name}}</span>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button @click.prevent="updatePost(post.id)" type="button" class="btn btn-primary">Update</button>
                            <button @click.prevent="cancelUpdatePost" type="button" class="btn btn-secondary">Cancel</button>
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
            posts: null,
            form: {
                title: '',
                content: ''
            },
            editedPostId: null
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts() {
            API.get('/api/auth/posts')
                .then(posts => this.posts = posts.data.data)
                .then(() => this.$router.push({name: 'posts.index'}))
                .catch(e => console.log(e))
        },
        editPost(id, title, content){
            this.editedPostId = id
            this.form.title = title
            this.form.content = content
        },
        updatePost(id){
            API.patch(`/api/auth/posts/${id}`, this.form)
                .then(() => this.resetEditedPost())
                .then(() => this.getPosts())
                .catch(e => console.log(e))
            this.editedPostId = null
        },
        cancelUpdatePost(){
            this.editedPostId = null
            this.resetEditedPost()
        },
        resetEditedPost(){
          for(let i in this.form){
              this.form[i] = ''
          }
        },
        destroyPost(id){
            API.delete(`/api/auth/posts/${id}`)
                .then(() => this.getPosts())
                .catch(e => console.log(e))
        }

    }
}
</script>

<style>

</style>
