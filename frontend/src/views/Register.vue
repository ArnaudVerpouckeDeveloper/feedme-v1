<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Registeren</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form v-model="valid">
              <v-text-field
                v-model="user.firstName"
                label="Voornaam"
                name="firstName"
                prepend-icon="mdi-card-account-details "
                type="text"
                required
                :rules="val.surNameRules"
              ></v-text-field>
              <v-text-field
                v-model="user.lastName"
                label="Naam"
                name="lastName"
                prepend-icon="mdi-card-account-details "
                type="text"
                required
                :rules="val.nameRules"
              ></v-text-field>
              <v-text-field
                v-model="user.email"
                label="Email"
                name="Email"
                prepend-icon="mdi-account"
                type="email"
                required
                :rules="val.emailRules"
              ></v-text-field>
              <v-text-field
                v-model="user.mobilePhone"
                label="Telefoon"
                name="Telefoon"
                prepend-icon="mdi-phone"
                type="number"
                required
                :rules="val.telephoneRules"
              ></v-text-field>
              <v-text-field
                v-model="user.password"
                id="password"
                label="Wachtwoord"
                name="password"
                prepend-icon="mdi-lock"
                type="password"
                required
                :rules="val.passwordRules"
              ></v-text-field>
              <v-text-field
                v-model="user.password_confirmation"
                id="password"
                label="Wachtwoord herhalen"
                name="password"
                prepend-icon="mdi-lock-reset"
                type="password"
                required
                :rules="val.passwordConfirmRules"
              ></v-text-field>

              <div style="text-align: center;">
                <v-btn :to="{name: 'merchantRegister'}">
                  <v-icon>mdi-store</v-icon>Ik wil mijn zaak registeren.
                </v-btn>
              </div>
            </v-form>
          </v-card-text>
          <p class="register">
            Hebt u al een account?
            <router-link :to="{name:'login'}">Login hier.</router-link>
          </p>
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
  computed: {
    isMerchant() {
      if (this.user.isMerchant) return "ik ben een producent";
      else return "ik ben een consument";
    }
  },
  data() {
    return {
      user: {
        firstname: null,
        lastname: null,
        email: null,
        password: null,
        password_confirmation: null,
        isMerchant: false
      },
      valid: false,
      val: {
        surNameRules: [
          v => !!v || "Voornaam is verplicht",
          v =>
            (v && v.length >= 1) ||
            "Voornaam moet minstens 1 character lang zijn."
        ],
        nameRules: [
          v => !!v || "Naam is verplicht",
          v =>
            (v && v.length >= 1) || "Naam moet minstens 1 character lang zijn."
        ],
        telephoneRules: [v => !!v || "Telefoon nummer is verplicht"],
        emailRules: [
          v => !!v || "E-mail is verplicht",
          v => /.+@.+/.test(v) || "Gelieve een geldig email in te geven."
        ],
        passwordRules: [
          v => !!v || "Wachtwoord is verplicht",
          v =>
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_!$#%]).+$/.test(v) ||
            "Wachtwoord moet minstens een hoofdletter, speciale teken en een cijfer hebben.",
          v =>
            (v && v.length >= 8) ||
            "Wachtwoord moet minstens 8 characters lang zijn."
        ],
        passwordConfirmRules: [
          v =>
            (!!v && v) === this.user.password ||
            "De wachtworden moeten overeen komen."
        ]
      }
    };
  },
  methods: {
    Postregister() {
      if (this.valid) this.register(this.user);
    },
    ...mapActions(["register"])
  }
};
</script>
<style>
</style>