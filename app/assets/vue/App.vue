<script>
    import axios from 'axios';
    
    export default {
        data() {
            return {
                hello: ''
            }
        },
        methods: {
            refreshHello() {
                axios
                    .get('/api/hello_worlds/', {"method": "GET"})
                    .then(response => (this.hello = response))
            }
        }
    }
</script>

<template>
    <button @click="refreshHello">Say hello !</button>
    <h1 v-show="!!hello">It's work</h1>
</template>