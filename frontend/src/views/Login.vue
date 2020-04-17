<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form v-model="valid" ref="form">
              <v-text-field
                v-model="user.email"
                label="Email"
                name="Email"
                prepend-icon="mdi-account"
                type="email"
                :rules="val.emailRules"
              ></v-text-field>
              <v-text-field
                v-model="user.password"
                id="password"
                label="Wachtwoord"
                name="password"
                prepend-icon="mdi-lock"
                type="password"
                :rules="val.veldRules"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <p class="register">
            Nog geen account?
            <router-link :to="{name:'register'}">Registreer u hier.</router-link>
          </p>
          <p class="register">
            <router-link :to="{name:'merchantLogin'}">Inloggen als zaak.</router-link>
          </p>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="Postlogin">Login</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <v-snackbar color="#ff5252" v-model="snackbar" vertical>
      Er is iets misgegaan gelieve te controleren of uw email adres en wachtwoord correct is.
      <v-btn text @click="snackbar = false">Ok</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      valid: false,
      snackbar: false,
      user: {
        email: null,
        password: null
      },
      val: {
        emailRules: [
          v => !!v || "E-mail is verplicht",
          v => /.+@.+/.test(v) || "Gelieve een geldig email in te geven."
        ],
        veldRules: [v => !!v || "Wachtwoord is verplicht"]
      }
    };
  },
  methods: {
    Postlogin() {
      this.$refs.form.validate();
      if (this.valid) {
        this.login(this.user)
          .then()
          .catch(message => {
            this.snackbar = true;
          });
      }
    },
    ...mapActions(["login"])
  }
};
</script>

<style>
.register {
  text-align: center;
}
.register a {
  text-decoration: none;
  border-bottom: 2px solid #4caf50;
}
</style>