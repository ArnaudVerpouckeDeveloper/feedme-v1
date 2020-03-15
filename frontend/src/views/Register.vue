<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Registeren</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field
                v-model="user.email"
                label="Email"
                name="Email"
                prepend-icon="mdi-account"
                type="email"
              ></v-text-field>
              <v-text-field
                v-model="user.password"
                id="password"
                label="Wachtwoord"
                name="password"
                prepend-icon="mdi-lock"
                type="password"
              ></v-text-field>
              <v-text-field
                v-model="user.confirmPassword"
                id="password"
                label="Wachtwoord herhalen"
                name="password"
                prepend-icon="mdi-lock-reset"
                type="password"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="Postregister">Verzenden</v-btn>
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
        name: null,
        email: null,
        password: null,
        confirmPassword: null
      }
    };
  },
  methods: {
    Postregister() {
      if (this.user.password === this.user.confirmPassword)
        console.log("No registrations allowed :)");
      //this.register(this.user);
    },
    ...mapActions(["register"])
  }
};
</script>
<style>
</style>