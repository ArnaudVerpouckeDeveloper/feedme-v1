<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md6>
        <v-card class="elevation-12">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Contact</v-toolbar-title>
          </v-toolbar>
          <v-form ref="form" v-model="valid" lazy-validation>
            <v-card-text>
              <v-form>
                <v-text-field v-model="contactForm.name" :rules="nameRules" label="Onderwerp" required></v-text-field>
                <v-text-field
                  v-model="contactForm.email"
                  :rules="emailRules"
                  label="E-mail"
                  required
                ></v-text-field>
                <v-textarea
                  v-model="contactForm.message"
                  :rules="nameRules"
                  label="Bericht"
                  required
                ></v-textarea>
              </v-form>
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
export default {
  data: () => ({
    contactForm: {
      name: "",
      email: ""
    },
    valid: true,
    nameRules: [v => !!v || "Deze veld is verplicht"],
    emailRules: [
      v => !!v || "E-mail is verplicht",
      v =>
        /.+@.+\..+/.test(v) ||
        "Deze veld moet een geldige email adres bevatten."
    ]
  }),
  methods: {
    sendContact() {
      this.$refs.form.validate();
    }
  }
};
</script>

<style>
</style>