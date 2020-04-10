<template>
  <v-container fluid>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 lg6>
        <v-card class="elevation-3">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Contact</v-toolbar-title>
          </v-toolbar>
          <v-form v-model="valid">
            <v-card-text>
              <v-text-field
                v-model="contactForm.fullName"
                :rules="onderwerpRules"
                label="Volledige naam"
                required
              ></v-text-field>
              <v-text-field v-model="contactForm.email" :rules="emailRules" label="E-mail" required></v-text-field>
              <v-textarea
                v-model="contactForm.message"
                :rules="messageRules"
                label="Bericht"
                required
              ></v-textarea>
            </v-card-text>
          </v-form>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="sendContact">Verzenden</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data: () => ({
    contactForm: {
      fullName: "",
      email: "",
      message: ""
    },
    valid: false,
    onderwerpRules: [v => !!v || "Uw naam is verplicht"],
    messageRules: [v => !!v || "Gelieve uw bericht in te vullen."],
    emailRules: [
      v =>
        !!v ||
        "E-mail adres is verplicht, op deze manier kunnen wij u terug contacteren.",
      v =>
        /.+@.+\..+/.test(v) ||
        "Deze veld moet een geldige email adres bevatten."
    ]
  }),
  methods: {
    sendContact() {
      if (this.valid) this.sendContactForm(this.contactForm);
    },
    ...mapActions(["sendContactForm"])
  }
};
</script>

<style>
</style>