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
          <p class="register signInAsRestaurant">
            <router-link :to="{name:'merchantLogin'}">Inloggen als zaak</router-link>
          </p>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="Postlogin">Login</v-btn>
          </v-card-actions>
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
      next(vm => vm.loginFrom.route = from.fullPath);
    } else next(vm => vm.loginFrom.route = "/");
  },
  data() {
    return {
      loginFrom:{ route: "/" },
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
        this.login({ ...this.user, ...this.loginFrom})
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

.register.signInAsRestaurant {
  margin-left: auto;
  margin-right: auto;
  margin-top: 2.5rem;
}
.register.signInAsRestaurant a:hover {
  background-color: #ebebeb;
}

.register.signInAsRestaurant a {
  transition: all 250ms;
  color: black;
  border: none;
  padding: 0.8rem 2rem;
  text-transform: uppercase;
  box-shadow: 0px 3px 1px -2px rgba(0, 0, 0, 0.2),
    0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
  font-family: "Roboto", sans-serif;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 0.0892857143em;
}
</style>