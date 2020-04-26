<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form v-model="valid" ref="form" @submit.prevent="Postlogin">
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
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" style="padding: 0 25px;" type="submit">Login</v-btn>
              </v-card-actions>
            </v-form>
          </v-card-text>
          <v-divider inset class="login-divider"></v-divider>
          <p class="register">
            Nog geen account?
            <router-link :to="{name:'register'}">Registreer u hier.</router-link>
          </p>
          <div style="text-align:center; padding-bottom: 17px;">
            <v-btn :to="{name:'merchantLogin'}">Inloggen als zaak</v-btn>
          </div>
        </v-card>
      </v-flex>
    </v-layout>
    <v-snackbar color="#ff5252" v-model="snackbar" vertical>
      SpeedMeal kon u niet aanmelden als klant, controleer of het ingevulde emailadres en wachtwoord correct is.
      <v-btn text @click="snackbar = false">Ok</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {
  beforeRouteEnter(to, from, next) {
    if (from.name === "MerchantDetail") {
      next(vm => (vm.loginFrom.route = from.fullPath));
    } else next(vm => (vm.loginFrom.route = "/"));
  },
  data() {
    return {
      loginFrom: { route: "/" },
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
        this.login({ ...this.user, ...this.loginFrom })
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
.login-divider {
    margin: 0px auto 19px auto !important;
}
</style>