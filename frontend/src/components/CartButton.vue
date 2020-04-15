<template>
  <v-snackbar v-model="showCartButton" class="snack-cart-button" :timeout="0" color="transparent">
    <v-btn x-large class="cartBtn" color="green" @click="onChangeDrawer">Winkelmandje</v-btn>
  </v-snackbar>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["showCartButton"])
  },
  methods: {
    onChangeDrawer(bool) {
      this.$store.dispatch("onChangeDrawer", bool);
    }
  }
};
</script>

<style>
.snack-cart-button {
  background: white;
  margin-right: -8px;
  margin-left: -8px;
  margin-bottom: -8px;
  padding-bottom: 8px;
}
.snack-cart-button .v-snack__wrapper {
  width: 100% !important;
  min-width: unset !important;
  max-width: unset !important;
  box-shadow: none !important;
}
.snack-cart-button .v-snack__wrapper .v-snack__content {
  padding: 8px;
}
</style>