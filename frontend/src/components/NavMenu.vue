<template>
  <div>
    <!-- desktop -->
    <v-app-bar app elevate-on-scroll color="green" class="d-none d-md-flex">
      <v-toolbar-title class="white--text">Speedmeal</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        <v-btn
          v-for="item in filteredRoutes"
          :key="item.icon"
          :to="item.path"
          text
          class="white--text"
        >{{ item.display }}</v-btn>
        <v-btn v-if="!LoggedIn" :to="{ name: 'login'}" text class="white--text">Aanmelden</v-btn>
        <a
          v-if="LoggedIn"
          @click="logOutUser"
          class="white--text v-btn v-btn--flat v-btn--router v-btn--text theme--light v-size--default"
        >Afmelden</a>
      </v-toolbar-items>
    </v-app-bar>

    <!-- Mobile -->
    <v-app-bar app color="green" class="d-flex d-md-none">
      <v-app-bar-nav-icon color="white" @click="dialog = true"></v-app-bar-nav-icon>
      <v-toolbar-title class="white--text">SpeedMeal</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
        <v-card>
          <v-toolbar text color="green">
            <v-toolbar-title class="white--text">SpeedMeal</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon @click.native="dialog = false">
              <v-icon class="white--text">mdi-close</v-icon>
            </v-btn>
          </v-toolbar>

          <v-list nav>
            <v-list-item-group color="green lighten-1">
              <v-list-item
                v-for="(item, index) in filteredRoutes"
                :key="index"
                :to="item.path"
                @click="dialog = false"
              >
                <v-list-item-icon>
                  <v-icon v-if="item.icon">{{item.icon}}</v-icon>
                </v-list-item-icon>
                <v-list-item-title>{{ item.display }}</v-list-item-title>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-dialog>
    </v-app-bar>
  </div>
</template>

<script>
import { routes } from "../router/routes";
import { mapGetters, mapMutations } from "vuex";

export default {
  computed: {
    filteredRoutes() {
      return routes.filter(r => {
        if (r.display !== "hide") {
          return true;
        }
      });
    },
    LoggedIn() {
      //Kan veeeeel beter, maar geen tijd voor serverside controle of de user echt ingelogd is.
      if (
        this.userLogged ||
        this.token 
      )
        return true;
      else return false;
    },
    ...mapGetters(["token"])
  },
  data() {
    return {
      dialog: false,
      routes,
      userLogged: null
    };
  },
  methods: {
    logOutUser() {
      this.logOut();
      this.userLogged = false;
    },
    ...mapMutations(["logOut"])
  }
};
</script>

<style>
body {
  color: #fff;
}
.v-toolbar__content {
  width: 100%;
}
</style>