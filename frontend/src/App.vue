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
    // this.$store.dispatch("fetchMerchantAndProduct", 1);
  },
  data: () => ({
    //
  })
};
</script>
<style>
/* shoppingCart button */
.shoppingCartButton {
  color: #fff !important;
}
</style>