<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Registeren</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form v-model="valid" ref="form">
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
              <v-checkbox v-model="user.acceptsTermsAndConditions" :rules="val.legalRules">
                <template v-slot:label>
                  <div>
                    Ik ga akkoord met de
                    <v-tooltip bottom>
                      <template v-slot:activator="{ on }">
                        <router-link v-on="on" :to="{name:'legal'}">algemene voorwaarden</router-link>
                      </template>
                      ""
                    </v-tooltip>
                  </div>
                </template>
              </v-checkbox>
              <v-card-actions class="register-button">
                <v-btn color="primary" @click="Postregister">Verzenden</v-btn>
              </v-card-actions>
              <v-divider inset class="register-divider"></v-divider>
              <p class="register">
                Hebt u al een account?
                <router-link :to="{name:'login'}">Login hier.</router-link>
              </p>
              <div style="text-align: center; margin-top: 20px; margin-bottom: 18px;">
                <v-btn :to="{name: 'merchantRegister'}">
                  <v-icon>mdi-store</v-icon>Ik wil mijn zaak registeren.
                </v-btn>
              </div>
            </v-form>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
    <v-dialog v-model="dialog" max-width="390">
      <v-card>
        <v-card-title class="headline">Uw registratie is bijna voltooid!</v-card-title>
        <v-card-text>Om verder te gaan dient u eerst uw e-mailadres te bevestigen. We hebben u een email gestuurd.</v-card-text>
        <v-card-text
          v-if="canSendVerificationAgain"
        >Als u na 1 minuut geen email van ons ontvangen hebt, kunt u deze opnieuw versturen.</v-card-text>
        <v-card-text v-if="!canSendVerificationAgain">Verificatie email is opnieuw verstuurd.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            v-if="canSendVerificationAgain"
            color="green darken-1"
            text
            @click="reSendRegisterVerification"
          >Email opnieuw versturen</v-btn>
          <v-btn color="green darken-1" text @click="registerDialog">Ok</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar color="#ff5252" v-model="snackbar" multi-line>
      {{ snackText }}
      <v-btn text @click="snackbar = false">Ok</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {
  computed: {},
  data() {
    return {
      canSendVerificationAgain: true,
      newUserId: 0,
      dialog: false,
      snackbar: false,
      snackText:
        "Om verder te gaan dient u eerst uw e-mailadres te bevestigen. We hebben u een e-mail gestuurd.",
      user: {
        firstname: null,
        lastname: null,
        email: null,
        password: null,
        password_confirmation: null
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
        ],
        legalRules: [
          v =>
            !!v ||
            "Om u zo goed mogelijke service aan te bieden hebben wij u akkoord nodig."
        ]
      }
    };
  },
  methods: {
    Postregister() {
      this.$refs.form.validate();
      if (this.valid) {
        this.register(this.user)
          .then(res => {
            this.newUserId = res.userId;
            this.user = {};
            this.$refs.form.reset();
            this.dialog = true;
          })
          .catch(message => {
            this.snackbar = true;
            this.snackText = Object.values(message)[0][0];
          });
      }
    },
    reSendRegisterVerification() {
      if (this.canSendVerificationAgain) {
        this.reSendVerification(this.newUserId).then(
          () => (this.canSendVerificationAgain = false)
        );
      }
    },
    registerDialog() {
      this.dialog = false;
      this.$router.push("/aanmelden");
    },
    ...mapActions(["register", "reSendVerification"])
  }
};
</script>
<style>
.register-button {
  flex-direction: column;
}
.register-button > button {
  width: 100%;
}
.register-divider {
  margin: 20px auto;
}
</style>