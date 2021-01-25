<template>
    <v-app>
        <v-container fill-height>
            <v-row justify="center">
                <v-card width="500" elevation="12">
                    <v-card-text>
                        <v-row dense>
                            <v-col class="mx-2 mt-4">
                                <v-text-field
                                    dense
                                    outlined
                                    label="Email"
                                    v-model="credentials.email"
                                    @keyup.enter="handleLogin()"
                                ></v-text-field>
                                <v-text-field
                                    dense
                                    outlined
                                    label="Password"
                                    type="password"
                                    v-model="credentials.password"
                                    @keyup.enter="handleLogin()"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions class="mt-n5">
                        <v-btn outlined color="secondary" @click="viewPeople()"
                            >People</v-btn
                        >
                        <v-spacer></v-spacer>
                        <v-btn outlined color="error" @click="logout()">Logout</v-btn>
                        <v-btn color="primary" @click="handleLogin()"
                            >Login</v-btn
                        >
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
            token: null
        };
    },
    methods: {
        handleLogin() {
            let email = this.credentials.email;
            let password = this.credentials.password;
            axios
                .post("api/login", {
                    email,
                    password
                })
                .then(res => {
                    localStorage.setItem('token', res.data)
                    this.token = res.data
                    axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
                })
                .catch(errors => {
                    console.log(error);
                });
        },
        logout() {
            axios.post('api/logout').then(res => {
                localStorage.removeItem('token')
            })
        },
        viewPeople() {
                // API
                axios
                    .get("api/persons")
                    .then(res => {
                        console.log(res);
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
        }
    }
};
</script>
