<template>
  <v-app>
    <nav-menu />
    <v-content>
      <router-view />
    </v-content>
    <Footer />
    <v-snackbar color="#2196F3" v-model="snackbar" :v-bind="userLogout" right>
      Uw bent afgemeld.
      <v-btn text @click="snackbar = false">Ok</v-btn>
    </v-snackbar>
  </v-app>
</template>

<script>
import Vue from "vue";
import NavMenu from "./components/NavMenu";
import Footer from "./components/Footer";
import { mapGetters } from "vuex";
import store from "./store";

export default {
  name: "App",
  components: {
    NavMenu,
    Footer
  },
  computed:{
    userLogout(){
      if(this.token === null){
        this.snackbar = true;
        return true
      }else {
        this.snackbar = false;
        return false;
      }
    },
    ...mapGetters(["token"])
  },
  created() {
    
  },
  data: () => ({
    snackbar: true
  })
};
</script>
<style>
/* shoppingCart button */
.shoppingCartButton {
  color: #fff !important;
}
</style>