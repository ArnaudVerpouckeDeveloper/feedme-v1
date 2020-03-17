<template>
  <div>
    <!-- desktop -->
    <v-app-bar app elevate-on-scroll color="green" class="d-none d-sm-flex">
      <v-toolbar-title class="white--text">Speedmeal</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        <v-btn
          v-for="item in routes"
          :key="item.icon"
          :to="item.path"
          text
          class="white--text"
        >{{ item.display }}</v-btn>
      </v-toolbar-items>
    </v-app-bar>

    <!-- Mobile -->
    <v-app-bar app color="green" class="d-flex d-sm-none">
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
              <v-list-item v-for="(item, index) in routes" :key="index" :to="item.path"  @click="dialog = false">
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

export default {
  data() {
    return {
      dialog: false,
      routes,
      nav: [
        {
          icon: "mdi-home",
          text: "Home",
          title: "Back to Home page",
          active: true
        },
        {
          icon: "mdi-account-multiple",
          text: "Over ons",
          title: "g",
          active: false
        },
        {
          icon: "mdi-frequently-asked-questions",
          text: "FAQ",
          title: "g",
          active: false
        },
        {
          icon: "mdi-email",
          text: "Contact",
          title: "Our Contact info",
          active: false
        }
      ]
    };
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