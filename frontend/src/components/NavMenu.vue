<template>
  <div>
    <!-- desktop -->
    <v-app-bar color="green" class="d-none d-sm-flex">
      <v-toolbar-title class="white--text">Speedmeal</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        <v-btn
          v-for="item in nav"
          :key="item.icon"
          :to="item.link"
          text
          class="white--text"
        >{{ item.text }}</v-btn>
      </v-toolbar-items>
    </v-app-bar>

    <!-- Mobile -->
    <v-app-bar color="green" class="d-flex d-sm-none">
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
              <v-list-item-group >
            <v-list-item v-for="(item, index) in nav" :key="index" to="#">
              <v-list-item-icon>
                <v-icon v-if="item.icon">{{item.icon}}</v-icon>
              </v-list-item-icon>
              <v-list-item-title :title="item.title">{{ item.text }}</v-list-item-title>
            </v-list-item>
              </v-list-item-group>
          </v-list>
        </v-card>
      </v-dialog>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      nav: [
        {
          icon: "mdi-home",
          text: "Home",
          title: "Back to Home page",
          active: true
        },
        {
          icon: "mdi-account-multiple ",
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
.v-toolbar__content{
    width:100%
}
</style>