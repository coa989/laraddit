<template>
    <form @submit.prevent="submit">
        <button class="btn" type="submit"><i class="far fa-thumbs-up"></i> {{ likes }} </button>
        <div class="alert alert-success" v-show="success">{{ messages.success }}</div>
        <div class="alert alert-danger" v-if="errors && errors.type">{{ errors.type[0] }}</div>
        <div class="alert alert-danger" v-if="errors && errors.user_id">{{ errors.user_id[0] }}</div>
    </form>
</template>

<script>
    export default {
        props:['posts','user', 'type'],
        data() {
            return {
                likes: null,
                success: false,
                errors: {},
                messages: {}
            }
        },
        mounted() {
            axios.get('/api/posts/'+this.posts).then(response => {
                this.likes = response.data.likes_count
            })
        },
        methods: {
            submit() {
                axios.post('/api/likes/store', {
                    'id': this.posts,
                    'user_id': this.user,
                    'type': this.type
                }).then(response => {
                    this.likes = response.data.likes
                    this.messages.success = response.data.success
                    this.success = true
                    this.errors = {}
                }).catch(error => {
                    if (error.response.status = 422) {
                        this.errors = error.response.data.errors
                    }
                    console.log('Error',error.response.data)
                })
            }
        }
    }
</script>

