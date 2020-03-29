<template>
  <div>
    <!-- desktop -->
    <v-app-bar app elevate-on-scroll color="green" class="d-none d-md-flex">
      <v-toolbar-title>
        <router-link :to="{name:'home'}">
          <img class="nav-logo" src="/assets/images/logo.png" alt="SpeedMeal logo" />
        </router-link>
      </v-toolbar-title>
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
      <v-toolbar-title>
        <img class="nav-logo" src="/assets/images/logo.png" alt="SpeedMeal logo" />
      </v-toolbar-title>
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

              <v-list-item
                v-if="!LoggedIn"
                :to="{ name: 'login'}"
                @click="dialog = false"
                key="login"
              >
                <v-list-item-icon>
                  <v-icon>mdi-login-variant</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Aanmelden</v-list-item-title>
              </v-list-item>

              <a
                v-if="LoggedIn"
                @click="logOutUser"
                class="v-list-item v-list-item--link theme--light"
                tabindex="0"
                role="listitem"
                aria-selected="false"
                key="logout"
              >
                <div class="v-list-item__icon">
                  <i
                    aria-hidden="true"
                    class="v-icon notranslate mdi mdi-logout-variant theme--light"
                  ></i>
                </div>
                <div class="v-list-item__title">Afmelden</div>
              </a>
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
      if (!this.token) {
        if (localStorage.getItem("user")) return true;
        else return false;
      }
      return true;
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
      this.dialog = false;
      this.logOut();
    },
    ...mapMutations(["logOut"])
  }
};
</script>

<style>
body {
  color: #fff;
}
.nav-logo {
  width: 10em;
  display: flex;
}

.v-toolbar__content {
  width: 100%;
}
</style>