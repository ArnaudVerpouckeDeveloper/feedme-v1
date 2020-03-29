<template>
  <v-app>
    <nav-menu/>
    <v-content>
      <router-view />
    </v-content>
     <Footer/>
  </v-app>
</template>

<script>
import Vue from "vue";
import NavMenu from "./components/NavMenu";
import Footer from "./components/Footer";
import store from "./store";


export default {
  name: "App",
  components: {
    NavMenu,
    Footer
  },
  created() {
    // this.$store.dispatch("fetchProducts", 1);
  },
  data: () => ({
    //
  })
};
</script>
<style>
/* shoppingCart button */
.btn-wrapper > .theme--light.v-btn > span {
  color: #fff !important;
}
</style>