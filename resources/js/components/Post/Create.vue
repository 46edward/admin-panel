<template>
    <div class="p-5">
        <h3>Create new post</h3>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input v-model="form.title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Post title">
        </div>
        <div class=" form-label">Post tags</div>
        <div class="mb-3 d-flex flex-wrap gap-2">
            <template v-for="tag in tags">
                <input v-model="form.tags" :value="tag.name" type="checkbox" class="btn-check" :id="`tag-${tag.id}`" autocomplete="off">
                <label class="btn btn-outline-secondary" :for="`tag-${tag.id}`">{{tag.name}}</label>
            </template>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post content</label>
            <textarea v-model="form.content" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
        </div>
        <div v-if="error" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="mb-3">
            <button @click.prevent="createPost" type="button" class="btn btn-primary mb-3">Create post</button>
        </div>
    </div>
</template>

<script>

import API from "../../api.js";
export default {
    name: "Create",
    data() {
        return {
            form: {
                title: '',
                content: '',
                tags: []
            },
            tags: null,
            error: null
        }
    },
    mounted() {
        this.error = null
        this.getTags()
    },
    methods: {
        getTags() {
            API.get('/api/auth/posts/create')
                .then(tags => this.tags = tags.data.data)
                .catch(e => this.error = e.response.data.message)
        },
        createPost(){
            API.post('/api/auth/posts', this.form)
                .then(() => { this.$router.push({name: 'posts.index'}) })
                .catch(e => this.error = e.response.data.message)
        }
    }
}

</script>

<style>

</style>
