<template>
<v-app>
    <v-container fill-height>
        <v-row justify="center">
            <v-card width="500" elevation="12">
                <v-card-title>Register</v-card-title>
                <v-card-text>
                    <v-row dense>
                        <v-col class="mx-2 mt-4">
                            <v-text-field dense outlined label="Name" v-model="credentials.name"></v-text-field>
                            <v-text-field dense outlined label="Email" v-model="credentials.email"></v-text-field>
                            <v-text-field dense outlined label="Password" type="password" v-model="credentials.password"></v-text-field>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions class="mt-n5 mx-3">
                    <v-btn text small class="my-auto" @click="goToLogin()">I already have an account</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" @click="register()">Register</v-btn>
                </v-card-actions>
            </v-card>
        </v-row>
    </v-container>
</v-app>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            credentials: {},
        };
    },
    methods: {
        register() {
            axios.post('api/users', {
                name: this.credentials.name,
                email: this.credentials.email,
                password: this.credentials.password,
            }).then(response => {
                this.credentials = {}
            }).catch(error => {
                console.log(error)
            })
        },
        goToLogin() {
            this.$router.push({name: 'login'}).catch(error => {
                console.log(error)
            })
        }
    }
};
</script>
