<template>
  <v-footer padless>
    <v-card flat tile width="100%" class="green text-center">
      <v-card-text>
        <v-btn v-for="icon in icons" :key="icon" class="mx-4" icon>
          <v-icon class="footer-icon" size="24px">{{ icon }}</v-icon>
        </v-btn>

        <v-btn :to="{name:'legal'}" text class="white--text">Algemene Voorwaarden</v-btn>
      </v-card-text>

      <v-divider class="footer-middle-divider"></v-divider>

      <v-card-text class="white--text">
        {{ new Date().getFullYear() }} —
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
</style>