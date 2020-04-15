<template>
  <v-container fluid>
    <v-img
      src="/assets/images/placeholder/merchant_heading.jpg"
      alt="pizza hawai with chicken"
      class="img-header"
    />
    <div class="merchant-logo-wrapper" :style="logoStyle">
      <v-img
        class="merchant-logo"
        src="/assets/images/placeholder/merchants_logo.png"
        alt="restaurant logo"
      />
    </div>
    <v-row class="merchant-info" :style="infoStyle">
      <v-col cols="12" sm="5" lg="5">
        <h1>{{merchantDetail.name}}</h1>
        <p
          class="dialog-content-address"
        >{{merchantDetail.address_street}} {{merchantDetail.address_number}}</p>
        <p
          class="dialog-content-address"
        >{{merchantDetail.address_zip}} {{merchantDetail.address_city}}</p>
        <p class="dialog-content-phone">{{merchantDetail.merchantPhone}}</p>
      </v-col>
      <v-col cols="12" sm="4" style="text-align: end; margin-top: 5px;">
        <v-tooltip left>
          <template v-slot:activator="{ on }">
            <v-btn icon @click.stop="showDialog = true" v-on="on">
              <v-icon color="grey darken-1" size="42">mdi-clock-outline</v-icon>
            </v-btn>
          </template>
          <span>Openingsuren</span>
        </v-tooltip>

        <p style="margin-top: 15px; margin-bottom:0;">Afhaling: {{takeawayPossible}}</p>
        <p>Levering: {{deliveryPossible}}</p>
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
        <v-tabs v-model="tab" background-color="primary" dark grow>
          <v-tab>Afhaling</v-tab>
          <v-tab>Levering</v-tab>
        </v-tabs>
        <v-tabs-items v-model="tab">
          <v-tab-item>
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
          </v-tab-item>
          <v-tab-item>
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
          </v-tab-item>
        </v-tabs-items>
      </v-card>
    </v-dialog>
    <v-snackbar color="#ff5252" multi-line v-model="snackbar" :v-bind="userLogout" right>
      Deze restaurant is momenteel gesloten u kunt daarom geen producten toevoegen aan uw winkelmandje.
      <v-btn text @click="snackbar = false">Ok</v-btn>
    </v-snackbar>
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
    deliveryPossible() {
      if (this.merchantDetail.opening_hours.delivery.length != 0)
        return "mogelijk";
      else return "niet mogelijk";
    },
    takeawayPossible() {
      if (this.merchantDetail.opening_hours.takeaway.length != 0)
        return "mogelijk";
      else return "niet mogelijk";
    },
    filteredProducts() {
      orderable;
      return this.merchantDetail.product.filter(product => {
        if (product.orderable) return true;
      });
    },
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
    logoStyle() {
      if (!this.isMobile) return "padding-right: 371px;";
      else return "padding-right: 12px;";
    },
    cardStyle() {
      if (!this.isMobile) return "margin-right: 359px;";
      else return "margin-right: -12px;";
    },
    infoStyle() {
      if (!this.isMobile) return "margin-right: 359px;";
      else return "margin-right: 0px";
    },
    ...mapGetters(["products", "merchantDetail", "isMobile", "showCartButton"])
  },
  mounted() {},
  data: () => ({
    showDialog: false,
    snackbar: false,
    tab: null
  }),
  methods: {
    onChangeDrawer(bool) {
      this.$store.dispatch("onChangeDrawer", bool);
    },
    addProduct(product) {
      if (!this.isClosed) {
        let merchantId = this.merchantDetail.id;
        let cartItem = { product, ...merchantId };
        this.addItemToCart(cartItem);
      } else {
        this.snackbar = true;
      }
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
.merchant-logo-wrapper {
  margin-top: -80px;
  height: 150px;
}
.merchant-logo {
  border-radius: 50%;
  width: 150px;
  height: 150px;
  border: 1px solid #d7d7d7;
  margin: 0 auto;
}
.img-header {
  max-height: 12vw;
  margin-top: -12px;
  margin-left: -12px;
}

.cartBtn {
  width: 100% !important;
  margin-left: 0px !important;
  margin-right: 0px !important;
  color: #fff !important;
}
.merchant-info {
  margin-top: -65px;
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
  margin-bottom: 0 !important;
}
.opening-hours {
  padding-top: 12px;
  padding-bottom: 12px;
}

@media only screen and (max-width: 599px) {
  .img-header {
    max-height: 125px !important;
  }
  .merchant-info {
    margin-top: 0;
  }
}

@media only screen and (max-width: 777px) {
  .img-header {
    max-height: 19vw;
  }
}
@media only screen and (max-width: 999px) {
  .img-header {
    margin-right: -12px;
    max-width: unset;
  }
}
</style>