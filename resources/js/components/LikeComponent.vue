<template>
    <form @submit.prevent="submit">
        <button class="btn" type="submit"><i class="far fa-thumbs-up"></i> {{ likes }} </button>
    </form>
</template>

<script>
    export default {
        props:['posts','user', 'model'],
        data() {
            return {
                likes: null,
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
                    'model': this.model
                }).then(response => {
                    console.log(response.data.message)
                }).catch(error => {
                    console.log('Error',error.response.data)
                })
            }
        }
    }
</script>

