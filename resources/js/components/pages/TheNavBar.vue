<template>
<v-main>
    <v-app-bar dense app light color="#ffffff">
        <!-- System logo -->
        <v-toolbar-title class="font-weight-bold">
            <span>{{SystemName}}</span>
        </v-toolbar-title>
        <v-spacer />
        <!-- Navbar links -->
        <v-toolbar-items>
            <v-btn x-small light text v-for="item in routes" :key="item.name" :to="item.route">
                {{item.name}}
            </v-btn>
            <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn x-small icon color="error" class="px-6" v-bind="attrs" v-on="on" @click="logout()">
                <v-icon>mdi-exit-to-app</v-icon>
            </v-btn>
                </template>
                <span>Logout</span>
            </v-tooltip>
        </v-toolbar-items>
    </v-app-bar>
</v-main>
</template>

<script>
export default {
    data() {
        return {
            SystemName: 'Laravel Sanctum',
            routes: [{
                    name: 'Persons',
                    route: '/persons'
                },
                {
                    name: 'Users',
                    route: '/users'
                },
            ],
        }
    },
    created() {

    },
    methods: {
        logout() {
            axios.post('api/logout').then(res => {
                localStorage.removeItem('token')
                this.$router.push({name: 'login'}).catch(error => {console.log(error)})
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>
</style>
