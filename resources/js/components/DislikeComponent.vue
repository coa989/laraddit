<template>
    <form @submit.prevent="submit">
        <button class="btn" type="submit"><i class="far fa-thumbs-down"></i> {{ dislikes }} </button>
        <div class="alert alert-success" v-show="success && messages.success">{{ messages.success }}</div>
        <div class="alert alert-danger" v-if="errors && errors.type">{{ errors.type[0] }}</div>
        <div class="alert alert-danger" v-if="errors && errors.user_id">{{ errors.user_id[0] }}</div>
    </form>
</template>

<script>
    export default {
        props:['model','user', 'type', 'dislikesCount'],
        data() {
            return {
                dislikes: null,
                success: false,
                errors: {},
                messages: {}
            }
        },
        mounted() {
            this.dislikes = this.dislikesCount
        },
        methods: {
            submit() {
                axios.post('/api/dislikes/store', {
                    'id': this.model,
                    'user_id': this.user,
                    'type': this.type
                }).then(response => {
                    this.dislikes = response.data.dislikes
                    this.messages.success = response.data.success
                    this.success = true
                    this.errors = {}
                }).catch(error => {
                    this.messages = {}
                    if (error.response.status = 422) {
                        this.errors = error.response.data.errors
                    }
                    console.log('Error',error.response.data)
                })
            }
        }
    }
</script>
