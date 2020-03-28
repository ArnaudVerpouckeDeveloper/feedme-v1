<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field v-model="user.email"
               label="Email" 
               name="Email" 
               prepend-icon="mdi-account" 
               type="email">
               </v-text-field>
              <v-text-field 
                v-model="user.password"
                id="password"
                label="Wachtwoord"
                name="password"
                prepend-icon="mdi-lock"
                type="password"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="Postlogin">Login</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      user: {
        email: null,
        password: null
      }
    };
  },
  methods: {
    Postlogin() {
      console.log(this.user)
      this.login(this.user);
    },
    ...mapActions(["login"])
  }
};
</script>

<style>
</style>