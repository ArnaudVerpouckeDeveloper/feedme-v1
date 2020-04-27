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
        <v-card-title class="col-5 item-name" :class="{'col-9': !canEdit}">x{{product.count}} {{product.name}}</v-card-title>
        <v-col cols="4" class="item-buttons" v-if="canEdit">
          <v-btn @click="removeProduct(product)" outlined x-small style="margin-right: 10px;">
            <v-icon size="12">mdi-minus</v-icon>
          </v-btn>
          <v-btn @click="addProduct(product)" outlined x-small>
            <v-icon size="12">mdi-plus</v-icon>
          </v-btn>
        </v-col>
        <v-card-title class="col-3 item-price">€{{totalItem(product)}}</v-card-title>
      </v-card>
    </div>
    <v-divider></v-divider>
    <v-card elevation="0">
      <v-row>
        <v-card-text class="col-6">Subtotaal</v-card-text>
        <v-card-text class="col-6 price">€ {{formatPrice(totalPrice)}}</v-card-text>
        <v-card-text class="col-6">Bezorgkosten</v-card-text>
        <v-card-text class="col-6 delivery-price">{{deliveryCostFormat}}</v-card-text>
        <v-card-text class="col-6 total-text">Totaal</v-card-text>
        <v-card-text class="col-6 total-price">€ {{formatPrice(totalCart)}}</v-card-text>
      </v-row>
    </v-card>
    <div class="btn-wrapper" v-if="canEdit">
      <v-btn
        color="green"
        large
        @click="orderItems"
        :disabled="disableButton || merchantIsClosed || !minOrderValueReached"
        class="shoppingCartButton"
      >Bestellen</v-btn>
      <v-card-subtitle>{{orderbtnMsg}}</v-card-subtitle>
    </div>
  </v-navigation-drawer>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  props: {
    merchantIsClosed: {
      default: false,
      type: Boolean
    },
    merchant_id: Number,
    canEdit: {
      default: true,
      type: Boolean
    },
    deliveryCost: Number,
    minimumOrderValue: Number,
    merchant_name: String,
  },
  computed: {
    orderbtnMsg() {
      if (this.merchantIsClosed) return "Deze zaak is momenteel gesloten.";
      else if (this.minimumOrderValue != 0 && !this.minOrderValueReached)
        return `U kunt helaas nog niet bestellen. ${this.merchant_name} 
      hanteert een minimum bestelbedrag van: €${this.minimumOrderValue} (excl. bezorgkosten)`;
      else return;
    },
    minOrderValueReached() {
      if (this.totalPrice >= this.minimumOrderValue) return true;
      else false;
    },
    deliveryCostFormat() {
      if (this.deliveryCost === 0) return "Gratis";
      else return `€ ${this.deliveryCost.toFixed(2)}`;
    },
    cartItemPerMerchant() {
      return this.cartItems[this.merchant_id];
    },
    totalCart() {
      this.totalPrice = 0;
      if (this.cartItems[this.merchant_id] != null)
        this.cartItems[this.merchant_id].forEach(item => {
          this.totalPrice += item.price * item.count;
        });
      return (this.totalPrice + this.deliveryCost);
    },
    disableButton() {
      if (this.cartItems[this.merchant_id] != null)
        if (this.cartItems[this.merchant_id].length != 0) return false;
        else return true;
      else return true;
    },
    disableColor() {
      if (this.disableButton) return "color: #a4a4a4";
      else return "color: #ffffff";
    },
    ...mapGetters([
      "products",
      "merchantDetail",
      "isMobile",
      "cartIsOpen",
      "cartItems"
    ])
  },
  mounted() {
    this.$store.dispatch("windowsResize");
    if (!this.isMobile) this.onChangeDrawer(true);
  },
  data: () => ({
    totalPrice: 0,
  }),
  methods: {
    addProduct(product) {
      if (!this.merchantIsClosed) {
        this.$emit('TotalCartPrice', this.totalPrice);
        let merchantId = this.merchantDetail.id;
        let cartItem = { product, ...merchantId };
        this.addItemToCart(cartItem);
      } else {
        //this.snackbar = true;
      }
    },
    removeProduct(product) {
      this.removeItemFromCart(product);
    },
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
      if (this.cartItems.length != 0 && this.totalPrice >= this.minimumOrderValue) {
        this.$router.push({ name: "order" });
      }
    },
    ...mapActions(["addItemToCart", "removeItemFromCart"])
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
  font-size: 0.9em;
  font-weight: 400;
}
.item-buttons {
  justify-content: flex-end;
  display: flex;
  align-items: center;
}
.item-buttons button {
  border: 1px solid #b4b4b4;
  width: 25px !important;
  height: 25px !important;
}
.item-price {
  justify-content: flex-end;
  color: rgba(0, 0, 0, 0.6);
  font-size: 0.9em;
}
.item-count {
  width: 21px;
  margin-left: 8px;
  align-items: center;
  display: flex;
  font-size: 0.9em;
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
@media only screen and (max-width: 328px) {
  .item-buttons {
    flex-direction: column;
  }
  .item-buttons button {
    margin-right: 0px !important;
    margin-bottom: 10px;
  }
}

@media only screen and (min-width: 999px) {
  .nav-drawer {
    position: absolute !important;
  }
}
</style>