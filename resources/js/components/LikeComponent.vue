<template>

    <form @submit.prevent="submit">
        <button class="btn" type="submit"><i class="far fa-thumbs-up"></i> {{ likes }} </button>
        <div class="alert alert-success" v-show="success">Your reaction has been recorded!</div>
        <div class="alert alert-danger" v-show="errors && errors.error">{{ errors.error }}</div>
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
            }
        },
        mounted() {
            axios.get('/api/posts/'+this.posts).then(response => {
                this.likes = response.data.likes_count
            })
        },
        methods: {
            submit() {
                console.log(this.model)
                axios.post('/api/likes/store', {
                    'id': this.posts,
                    'user_id': this.user,
                    'type': this.type
                }).then(response => {
                    this.likes = response.data.likes_count
                    this.success = true
                }).catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data
                    }
                    console.log('Error',error.response.data)
                })
            }
        }
    }
</script>

