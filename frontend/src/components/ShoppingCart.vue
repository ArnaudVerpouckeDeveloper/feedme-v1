<template>
  <v-navigation-drawer
    width="350px"
    absolute
    right
    bottom
    :permanent="!isMobile"
    @input="onChangeDrawer"
    v-model="cartIsOpen"
    v-if="cartIsOpen"
  >
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="title">Winkelmandje</v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-card elevation="0" v-for="product in cartItems" class="row">
      <v-card-title class="col-7">x{{product.count}} {{product.name}}</v-card-title>
      <v-card-title class="col-5 item-price">€{{totalItem(product)}}</v-card-title>
    </v-card>

    <v-divider></v-divider>
    <v-card elevation="0">
      <v-row>
        <v-card-text class="col-6">Subtotaal</v-card-text>
        <v-card-text class="col-6 price">€ {{totalCart}}</v-card-text>
        <v-card-text class="col-6">Bezorgkosten</v-card-text>
        <v-card-text class="col-6 delivery-price">Gratis</v-card-text>
        <v-card-text class="col-6 total-text">Totaal</v-card-text>
        <v-card-text class="col-6 total-price">€ {{formatPrice(totalPrice)}}</v-card-text>
      </v-row>
    </v-card>
    <div class="btn-wrapper">
      <v-btn color="green" large>Bestellen</v-btn>
    </div>
  </v-navigation-drawer>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    totalCart() {
      this.totalPrice = 0;
      this.cartItems.forEach(item => {
        this.totalPrice += item.price * item.count;
      });

      return this.totalPrice;
    },

    ...mapGetters(["isMobile", "cartIsOpen", "cartItems"])
  },
  mounted() {
    this.$store.dispatch("windowsResize");
    if (!this.isMobile) this.onChangeDrawer(true);
  },
  data: () => ({
    totalPrice: 0
  }),
  methods: {
    onChangeDrawer(bool) {
      this.$store.dispatch("onChangeDrawer", bool);
    },

    formatPrice(price) {
      return price.toFixed(2);
    },
    totalItem(product){
     return product.price * product.count;
    },
  }
};
</script>

<style scoped>
.title {
  text-align: center;
}
.row {
  margin-left: 0px;
  margin-right: 0px;
}
.item-price {
  justify-content: flex-end;
  color: rgba(0, 0, 0, 0.6);
  font-size: 1rem;
}
.price,
.total-price,
.delivery-price {
  text-align: end;
}
.total-price,
.total-text {
  font-weight: 600;
}
.btn-wrapper {
  text-align: center;
  padding: 10px;
}
.btn-wrapper > button {
  width: 100%;
  color: #fff !important;
}
</style>