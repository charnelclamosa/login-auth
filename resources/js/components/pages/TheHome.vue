<template>
<v-main>
    <v-row dense align="center" justify="center">
        <v-card elevation="12">
            <v-card-title>Persons table</v-card-title>
            <v-card-text>
                <v-simple-table class="my-table">
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Birth date</th>
                                <th>Phone number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in Persons" :key="item.id">
                                <td>{{item.id}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.address}}</td>
                                <td>{{item.birth_date}}</td>
                                <td>{{item.phone_number}}</td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-card-text>
        </v-card>
    </v-row>
</v-main>
</template>

<script>
export default {
    data() {
        return {
            Persons: [],
        }
    },
    created() {
        this.initializeToken()
        this.getPersons()
    },
    methods: {
        initializeToken() {
            let token = localStorage.getItem('token')
            axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        },
        getPersons() {
            axios.get('api/persons').then(response => {
                this.Persons = response.data
            }).catch(error => {
                console.log(error)
            })
        },
    },
}
</script>
<style scoped>
.my-table tbody tr:nth-of-type(even) {
    background-color: #E0E0E0;
}
</style>
