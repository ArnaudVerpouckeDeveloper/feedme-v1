<template>
  <v-snackbar v-model="showCartButton" :timeout="0" color="transparent">
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
</style>