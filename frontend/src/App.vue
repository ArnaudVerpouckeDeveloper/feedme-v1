<template>
  <v-app>
    <nav-menu></nav-menu>
    <v-content>
      <router-view />
    </v-content>
  </v-app>
</template>

<script>
import NavMenu from "./components/NavMenu";
import { store } from "./store";

export default {
  name: "App",
  components: {
    NavMenu
  },
  created() {
    this.$store.dispatch("fetchProducts");
  },
  data: () => ({
    //
  })
};
</script>
<style>
/* shoppingCart button */
.btn-wrapper > .theme--light.v-btn > span{
  color: #fff !important;
}
</style>