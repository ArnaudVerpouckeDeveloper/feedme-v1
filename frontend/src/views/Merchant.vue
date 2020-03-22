<template>
  <v-container fluid>
    <ShoppingCart></ShoppingCart>
    <v-img
      src="/assets/images/placeholder/merchant_heading.jpg"
      alt="pizza hawai with chicken"
      class="img-header"
      style="margin-top:-12px"
    />
    <v-row :style="cardStyle">
      <v-col cols="12" sm="6" v-for="product in products">
        <v-card elevation="1">
          <v-row>
            <v-col cols="8">
              <v-card-title>{{product.name}}</v-card-title>
              <v-card-subtitle>€{{product.price}}</v-card-subtitle>
            </v-col>
            <v-col cols="4" style="align-self: center;">
              <v-card-actions style="justify-content: flex-end;">
                <v-btn text @click="removeProduct(product)">-</v-btn>
                <v-btn text @click="addProduct(product)">+</v-btn>
              </v-card-actions>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
    <v-snackbar v-model="showCartButton" :timeout="0" color="transparent">
      <v-btn x-large class="cartBtn" color="green" @click="onChangeDrawer">Winkelmandje</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
import ShoppingCart from "../components/ShoppingCart";
import { mapGetters, mapActions } from "vuex";

export default {
  components: {
    ShoppingCart
  },
  computed: {
    cardStyle(){
      if(!this.isMobile)
        return "margin-right: 350px;"
      else
        return "margin-right: -12px"
    },
    ...mapGetters(["products", "isMobile", "showCartButton"])
  },
  mounted() {},
  data: () => ({}),
  methods: {
    onChangeDrawer(bool) {
      this.$store.dispatch("onChangeDrawer", bool);
    },
    addProduct(product) {
      this.addItemToCart(product)
    },
    removeProduct(product) {
      this.removeItemFromCart(product)
    },
    
    ...mapActions(["addItemToCart","removeItemFromCart"])
  }
};
</script>

<style>
.img-header {
  max-height: 12vw;
}
.v-snack__wrapper {
  width: 100% !important;
  min-width: unset !important;
  max-width: unset !important;
  box-shadow: none !important;
}
.v-snack__content {
  justify-content: center !important;
  padding: 0 !important;
}
.cartBtn {
  width: 100% !important;
  margin-left: 0px !important;
  margin-right: 0px !important;
  color: #fff !important;
}
</style>