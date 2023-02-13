<script>
    import axios from 'axios';
    
    export default {
        data() {
            return {
                users: ''
            }
        },
        methods: {
            handleClick() {
                axios
                    .get('/api/users/', { 
                        headers: {
                            'Accept': 'application/json', 
                            'Authorization': `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzYyNDQ3NjgsImV4cCI6MTY3NjI0ODM2OCwicm9sZXMiOlsiUk9MRV9VU0VSIl0sImVtYWlsIjoiYWRtaW5AY2hhZGlrd2EuZnIifQ.b26REAxF0LPgwMcKsLdv6i22tgvvwJq_O70uQsO6z6Pr0Qc0v8EKIGubNnxGdGlSM0Cx52JgPW3u0cqk1VZMPsYYHdhZWjJcWB2NnjPzdQ72bzmWSL29O6ByJJNR8eAOrPoMMzD6Ub21UOyBJTRdMsbqNWye9rEnOKfeUfuDXOlX_ao75mi8f4Ll4AvJm6cB8EAXYRykkHkdXJfGOJMzS0Db9NYFEjvpVBlE45nRpMU7KEwaaGdsEYQQwptwPucquJE66lFtGBMMiI7AWzlWoCFBFg-DSS9AO2P6Ms4t7mqXg5CA3yQon30JRGe9RMerrOvTmZJcsQ6miVOnKAX1ug`
                        }
                    })
                    .then(response => (this.users = response.data))
                    .catch(error => console.error(error));
            }
        }
    }
</script>

<template>
    <button @click="handleClick">It's working ? Press the button to be sure.</button>
    <h1 v-for="user in users">
        {{ user.email }}
    </h1>
</template>