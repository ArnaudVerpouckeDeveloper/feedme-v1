<template>
  <v-footer padless>
    <v-card flat tile width="100%" class="green text-center">
      <v-card-text class="footer-logos">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn class="mx-4" v-on="on" icon :to="{name:'speedmealInsta'}" target="_blank">
              <v-icon class="footer-icon" size="24px">mdi-instagram</v-icon>
            </v-btn>
          </template>
          <span>Instagram</span>
        </v-tooltip>

        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn class="mx-4" v-on="on" icon :to="{name:'speedmealFacebook'}" target="_blank">
              <v-icon class="footer-icon" size="24px">mdi-facebook</v-icon>
            </v-btn>
          </template>
          <span>Facebook</span>
        </v-tooltip>

        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn class="mx-4" v-on="on" icon href="mailto:info@speedmeal.be" target="_blank">
              <v-icon class="footer-icon" size="24px">mdi-email</v-icon>
            </v-btn>
          </template>
          <span>info@speedmeal.be</span>
        </v-tooltip>

        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <v-btn class="mx-4" icon :to="{name:'legal'}" v-on="on">
              <v-icon class="footer-icon" size="24px">mdi-book-open-page-variant</v-icon>
            </v-btn>
          </template>
          <span>Algemene voorwaarden</span>
        </v-tooltip>
      </v-card-text>
      <v-card-text class="footer-merchant">
        <v-btn to="handleiding-voor-horecazaken" outlined small>Informatie voor horecazaken</v-btn>
      </v-card-text>
      <v-card-text class="white--text">
        {{ new Date().getFullYear() }} —
        &copy;
        <strong>SpeedMeal</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>

<script>
export default {
  data: () => ({
    icons: ["mdi-instagram "]
  })
};
</script>

<style>
.footer-middle-divider {
  color: rgba(239, 255, 239, 0.18) !important;
}
.footer-icon {
  color: #f1fff1 !important;
}
.footer-logos {
  padding-bottom: 0;
}
.footer-merchant {
  padding-bottom: 0 !important;
}
.footer-merchant > a {
   color: #fff !important;
}
</style>