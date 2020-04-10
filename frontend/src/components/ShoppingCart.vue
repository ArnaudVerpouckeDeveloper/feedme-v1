<template>
  <v-navigation-drawer
    class="nav-drawer"
    width="370px"
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
    <div class="cart-items">
      <v-card v-for="product in cartItemPerMerchant" elevation="0" class="row">
        <v-card-title class="col-8 item-name">x{{product.count}} {{product.name}}</v-card-title>
        <v-card-title class="col-4 item-price">€{{totalItem(product)}}</v-card-title>
      </v-card>
    </div>
    <v-divider></v-divider>
    <v-card elevation="0">
      <v-row>
        <v-card-text class="col-6">Subtotaal</v-card-text>
        <v-card-text class="col-6 price">€ {{formatPrice(totalCart)}}</v-card-text>
        <v-card-text class="col-6">Bezorgkosten</v-card-text>
        <v-card-text class="col-6 delivery-price">Gratis</v-card-text>
        <v-card-text class="col-6 total-text">Totaal</v-card-text>
        <v-card-text class="col-6 total-price">€ {{formatPrice(totalPrice)}}</v-card-text>
      </v-row>
    </v-card>
    <div class="btn-wrapper" v-if="showOrderBtn">
      <v-btn
        color="green"
        large
        @click="orderItems"
        :disabled="disableButton"
        class="shoppingCartButton"
      >Bestellen</v-btn>
    </div>
  </v-navigation-drawer>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: {
    merchant_id: Number,
    showOrderBtn: {
      default: true,
      type: Boolean
    }
  },
  computed: {
    cartItemPerMerchant() {
      return this.cartItems[this.merchant_id];
    },
    totalCart() {
      this.totalPrice = 0;
      if (this.cartItems[this.merchant_id] != null)
        this.cartItems[this.merchant_id].forEach(item => {
          this.totalPrice += item.price * item.count;
        });
      return this.totalPrice;
    },
    disableButton() {
      if (this.cartItems[this.merchant_id] != null)
        if (this.cartItems[this.merchant_id].length != 0) return false;
        else return true;
      else return false;
    },
    disableColor() {
      if (this.disableButton) return "color: #a4a4a4";
      else return "color: #ffffff";
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
    totalItem(product) {
      return (product.price * product.count).toFixed(2);
    },
    orderItems() {
      if (this.cartItems.length != 0) {
        this.$router.push({ name: "order" });
      }
    }
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
.cart-items {
  max-height: 408px;
  overflow-y: scroll;
}
.item-name {
  font-size: 1em;
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
}
.nav-drawer {
  position: sticky !important;
}
@media only screen and (min-width: 999px) {
  .nav-drawer {
    position: absolute !important;
  }
}
</style>