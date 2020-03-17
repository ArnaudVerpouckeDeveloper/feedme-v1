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

export default {
  name: "App",
  components: {
    NavMenu,
  },
  data: () => ({
    //
  })
};
</script>
