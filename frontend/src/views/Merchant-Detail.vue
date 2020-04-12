<template>
  <v-container fluid>
    <v-img
      src="/assets/images/placeholder/merchant_heading.jpg"
      alt="pizza hawai with chicken"
      class="img-header"
    />
    <v-row class="merchant-info" :style="infoStyle">
      <h1 class="col-8 col-md-10 col-lg-11">{{merchantDetail.name}}</h1>
      <v-col cols="col-2 col-sm-1" style="text-align: end;">
        <v-btn icon @click.stop="showDialog = true">
          <v-icon color="grey darken-1" size="42">mdi-information-outline</v-icon>
        </v-btn>
      </v-col>
    </v-row>
    <v-row :style="cardStyle" class="merchant-products">
      <v-col cols="12" md="6" v-for="product in products">
        <v-card elevation="1">
          <v-row>
            <v-col cols="8">
              <v-card-title>{{product.name}}</v-card-title>
              <v-card-subtitle v-if="product.description">€{{product.description}}</v-card-subtitle>
              <v-card-subtitle>€{{formatPrice(product.price)}}</v-card-subtitle>
            </v-col>
            <v-col cols="4" style="align-self: center;">
              <v-card-actions style="justify-content: flex-end;">
                <v-btn text @click="removeProduct(product)">
                  <v-icon>mdi-minus</v-icon>
                </v-btn>
                <v-btn text @click="addProduct(product)">
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
              </v-card-actions>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
    <ShoppingCart :merchant_id="merchantDetail.id" id="shoppingCart" :merchantIsClosed="isClosed"></ShoppingCart>
    <CartButton></CartButton>
    <v-dialog v-model="showDialog" max-width="440">
      <v-card>
        <v-card-title class="headline">{{merchantDetail.name}}</v-card-title>
        <v-row class="dialog-content">
          <v-col
            cols="12"
            class="dialog-content-address"
          >{{merchantDetail.address_street}} {{merchantDetail.address_number}}</v-col>
          <v-col
            cols="12"
            class="dialog-content-address"
          >{{merchantDetail.address_zip}} {{merchantDetail.address_city}}</v-col>
          <v-col cols="12" class="dialog-content-phone">{{merchantDetail.merchantPhone}}</v-col>
        </v-row>
        <v-divider inset style="margin: 0 auto;"></v-divider>

        <div class="opening-hours">
          <v-row
            class="dialog-content"
            v-for="(hour, dag) in merchantDetail.opening_hours.takeaway"
          >
            <v-col cols="4">{{numberToday(dag)}}:</v-col>
            <v-col
              cols="8"
            >{{hour.from_1}} tot {{hour.till_1}} en {{hour.from_2}} tot {{hour.till_2}}</v-col>
          </v-row>
        </div>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import ShoppingCart from "../components/ShoppingCart";
import CartButton from "../components/CartButton";
import MerchantDialog from "../components/MerchantDialog";
import { mapGetters, mapActions } from "vuex";

export default {
  beforeRouteEnter(to, from, next) {
    const store = require("../store");
    store.default.dispatch("fetchMerchantAndProduct", to.params.id).then(() => {
      next();
    });
  },
  components: {
    ShoppingCart,
    CartButton,
    MerchantDialog
  },
  computed: {
    isClosed() {
      if (
        this.merchantDetail.possibleTimes.delivery.length == 0 ||
        this.merchantDetail.possibleTimes.takeaway.length == 0
      )
        true;
      else false;
    },
    bannerImage() {
      if (merchantDetail.bannerFileName != null) return bannerFileName;
      else return "/assets/images/placeholder/merchant_heading.jpg";
    },
    cardStyle() {
      if (!this.isMobile) return "margin-right: 370px;";
      else return "margin-right: -12px;";
    },
    infoStyle() {
      if (!this.isMobile) return "margin-right: 382px;";
      else return "margin-right: 0px";
    },
    ...mapGetters(["products", "merchantDetail", "isMobile", "showCartButton"])
  },
  mounted() {},
  data: () => ({
    showDialog: false
  }),
  methods: {
    onChangeDrawer(bool) {
      this.$store.dispatch("onChangeDrawer", bool);
    },
    addProduct(product) {
      let merchantId = this.merchantDetail.id;
      let cartItem = { product, ...merchantId };
      this.addItemToCart(cartItem);
    },
    removeProduct(product) {
      this.removeItemFromCart(product);
    },
    numberToday(number) {
      let days = {
        0: "Maandag",
        1: "Dinsdag",
        2: "Woensdag",
        3: "Donderdag",
        4: "Vrijdag",
        5: "Zaterdag",
        6: "Zondag"
      };
      return days[number];
    },
    formatPrice(price) {
      return price.toFixed(2);
    },
    ...mapActions(["addItemToCart", "removeItemFromCart"])
  }
};
</script>

<style>
.img-header {
  max-height: 12vw;
  margin-top: -12px;
  margin-left: -12px;
}
.snack-cart-button .v-snack__wrapper {
  width: 100% !important;
  min-width: unset !important;
  max-width: unset !important;
  box-shadow: none !important;
}

.cartBtn {
  width: 100% !important;
  margin-left: 0px !important;
  margin-right: 0px !important;
  color: #fff !important;
}
.merchant-info {
  margin-top: 10px;
  margin-bottom: 10px;
  justify-content: space-between;
}
.merchant-info button {
  align-self: center;
}
.dialog-content {
  margin: 0 12px;
}
.dialog-content-address,
.dialog-content-phone {
  padding-top: 0;
}
.opening-hours {
  padding-bottom: 12px;
}

@media only screen and (max-width: 999px) {
  .img-header {
    margin-right: -12px;
    max-width: unset;
  }
}
</style>