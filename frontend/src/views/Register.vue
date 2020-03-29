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
                v-model="user.firstName"
                label="Voornaam"
                name="firstName"
                prepend-icon="mdi-card-account-details "
                type="text"
              ></v-text-field>
              <v-text-field
                v-model="user.lastName"
                label="Achternaam"
                name="lastName"
                prepend-icon="mdi-card-account-details "
                type="text"
              ></v-text-field>
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
              <v-radio-group v-model="user.isMerchant" :mandatory="true">
                <v-radio label="Ik ben consument" :value="false"></v-radio>
                <v-radio label="Ik ben een producent" :value="true"></v-radio>
              </v-radio-group>
               <v-text-field v-if="user.isMerchant"
                v-model="user.merchantName"
                label="Bedrijfsnaam"
                name="company"
                prepend-icon="mdi-store"
                type="text"
              ></v-text-field>
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
        email: null,
        password: null,
        confirmPassword: null,
        isMerchant: false
      }
    };
  },
  methods: {
    Postregister() {
      if (this.user.password === this.user.confirmPassword)
        this.register(this.user);
    },
    ...mapActions(["register"])
  }
};
</script>
<style>
</style>