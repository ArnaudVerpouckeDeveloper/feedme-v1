<template>
  <v-container fluid>
    <v-img :src="headerImage" class="img-header" :style="headerStyle" />
    <div class="merchant-logo-wrapper" :style="logoStyle">
      <v-img class="merchant-logo" :src="logoImage" alt="restaurant logo" />
      <v-col class="merchant-logo-message" cols="12" sm="3">
        <p>{{merchantDetail.message}}</p>
      </v-col>
    </div>

    <v-row
      class="merchant-info"
      :style="infoStyle"
      :class="{'margin-top' : !merchantDetail.message}"
    >
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
      <v-col cols="12" sm="4" md="3" class="merchant-info-hours">
        <v-tooltip left>
          <template v-slot:activator="{ on }">
            <v-btn icon @click.stop="showDialog = true" v-on="on">
              <v-icon color="grey darken-1" size="42">mdi-clock-outline</v-icon>
            </v-btn>
          </template>
          <span>Openingsuren</span>
        </v-tooltip>
        <p style="margin-top: 15px; margin-bottom:0;">Afhaling: {{takeawayPossible}}</p>
        <p style="margin-bottom:0;">Levering: {{deliveryPossible}}</p>
        <p>Contacteer de zaak i.v.m. allergieën.</p>
      </v-col>
    </v-row>

    <v-row :style="cardStyle" class="merchant-products" v-for="c in refactoredProductCategory">
      <v-col cols="12">
        <v-sheet class="product-category">{{c.name}}</v-sheet>
      </v-col>
      <v-col
        cols="12"
        md="12"
        lg="6"
        xl="6"
        v-for="product in products"
        class="d-flex flex-column"
        v-if="product.product_category_id == c.id"
      >
        <v-card elevation="1" class="merchant-product flex d-flex flex-column">
          <v-row>
            <v-col cols="12" sm="4" class="product-image">
              <v-img :src="productImage(product.imageFileName)"></v-img>
            </v-col>
            <v-col cols="8" sm="6" class="product-content">
              <v-card-title class="product-name">{{product.name}}</v-card-title>
              <v-card-subtitle v-if="product.description">{{product.description}}</v-card-subtitle>
              <v-card-subtitle class="product-price">€{{formatPrice(product.price)}}</v-card-subtitle>
            </v-col>
            <v-col cols="4" sm="2" style="align-self: center;">
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
    <ShoppingCart
      :merchant_id="merchantDetail.id"
      id="shoppingCart"
      :merchantIsClosed="isClosed"
      :deliveryCost="merchantDetail.deliveryCost"
      :minimumOrderValue="merchantDetail.minimumOrderValue"
      :merchant_name="merchantDetail.name"
      @TotalCartPrice="updateCartPrice"
    ></ShoppingCart>
    <CartButton></CartButton>
    <v-dialog v-model="showDialog" max-width="440">
      <v-card>
        <v-tabs v-model="tab" background-color="primary" dark grow>
          <v-tab>Levering</v-tab>
          <v-tab>Afhaling</v-tab>
        </v-tabs>
        <v-tabs-items v-model="tab">
          <v-tab-item>
            <div class="opening-hours">
              <v-row class="dialog-content" v-for="(hour, dag) in refactoredDelivery">
                <v-col cols="4">{{numberToday(dag)}}:</v-col>
                <v-col cols="8" v-if="!hour.isClosed">
                  <span v-if="refactorHours(hour.from_1)">{{hour.from_1}} tot </span>
                  <span v-if="refactorHours(hour.till_1)">{{hour.till_1}} en </span>
                  <span v-if="refactorHours(hour.from_2)">{{hour.from_2}} tot </span>
                  <span v-if="refactorHours(hour.till_2)">{{hour.till_2}}</span>
                </v-col>
                <v-col cols="8" v-if="hour.isClosed">niet mogelijk</v-col>
              </v-row>
            </div>
          </v-tab-item>
          <v-tab-item>
            <div class="opening-hours">
              <v-row class="dialog-content" v-for="(hour, dag) in refactoredTakeAway">
                <v-col cols="4">{{numberToday(dag)}}:</v-col>
                <v-col cols="8" v-if="!hour.isClosed">
                  <span v-if="refactorHours(hour.from_1)">{{hour.from_1}} tot </span>
                  <span v-if="refactorHours(hour.till_1)">{{hour.till_1}} en </span>
                  <span v-if="refactorHours(hour.from_2)">{{hour.from_2}} tot </span>
                  <span v-if="refactorHours(hour.till_2)">{{hour.till_2}}</span>
                </v-col>
                <v-col cols="8" v-if="hour.isClosed">niet mogelijk</v-col>
              </v-row>
            </div>
          </v-tab-item>
        </v-tabs-items>
      </v-card>
    </v-dialog>
    <v-snackbar color="#ff5252" multi-line v-model="snackbar" right>
      {{ merchantDetail.name }} is momenteel gesloten u kunt daarom geen producten toevoegen aan uw winkelmandje.
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
  beforeRouteLeave(to, from, next) {
    history.replaceState("null", "", `${this.merchantDetail.id}`);
    next();
  },
  components: {
    ShoppingCart,
    CartButton,
    MerchantDialog
  },
  computed: {
    refactoredProductCategory() {
      return this.merchantDetail.productCategories.filter(c => {
        return this.products.filter(p => p.product_category_id == c.id);
      });
    },
    refactoredDelivery() {
      const deliveryDays = this.merchantDetail.opening_hours.delivery;
      const delivery = deliveryDays.map(day => {
        const hour = Object.values(day);
        day.isClosed = hour.every((val, i, arr) => val === arr[0]);
        return day;
      });
      return delivery;
    },
    refactoredTakeAway() {
      const takeAwayDays = this.merchantDetail.opening_hours.takeaway;
      const takeaway = takeAwayDays.map(day => {
        const hour = Object.values(day);
        day.isClosed = hour.every((val, i, arr) => val === arr[0]);
        return day;
      });
      return takeaway;
    },

    headerImage() {
      if (this.merchantDetail.bannerFileName != null)
        return `https://www.speedmeal.be/public/uploads/${this.merchantDetail.bannerFileName}`;
      else return "/assets/images/placeholder/mechants_card.png";
    },
    logoImage() {
      if (this.merchantDetail.logoFileName != null)
        return `https://www.speedmeal.be/public/uploads/${this.merchantDetail.logoFileName}`;
      else return "/assets/images/placeholder/merchants_logo.png";
    },
    deliveryPossible() {
      if (this.merchantDetail.possibleTimes.delivery.length != 0)
        return "mogelijk";
      else return "niet mogelijk";
    },
    takeawayPossible() {
      if (this.merchantDetail.possibleTimes.takeaway.length != 0)
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
        return true;
      else return false;
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
    headerStyle() {
      if (!this.isMobile) return "margin-right: 358px;";
      else return "margin-right: -12px";
    },
    ...mapGetters(["products", "merchantDetail", "isMobile", "showCartButton"])
  },
  created() {
    history.replaceState("null", "", `${this.merchantDetail.apiName}`);
  },
  data: () => ({
    showDialog: false,
    snackbar: false,
    tab: null,
    totalPriceCart: 0
  }),
  methods: {
    refactorHours(hour) {
      if (hour === "not-possible") {
        return false;
      } else return true;
    },
    onChangeDrawer(bool) {
      this.$store.dispatch("onChangeDrawer", bool);
    },
    addProduct(product) {
      if (this.isClosed) {
        this.snackbar = true;
      } else if (this.totalPriceCart >= this.merchantDetail.minimumOrderValue) {
        let merchantId = this.merchantDetail.id;
        let cartItem = { product, ...merchantId };
        this.addItemToCart(cartItem);
      }
    },
    updateCartPrice(price) {
      this.totalPriceCart = price;
    },
    removeProduct(product) {
      this.removeItemFromCart(product);
    },
    productImage(imageFile) {
      if (imageFile != null)
        return `https://www.speedmeal.be/public/uploads/${imageFile}`;
      else return "/assets/images/placeholder/merchants_logo.png";
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
.margin-top {
  margin-top: -65px !important;
}
.merchant-logo-wrapper {
  margin-top: -80px;
  height: 150px;
}
.merchant-logo {
  border-radius: 50%;
  width: 150px;
  height: 150px;
  border: 4px solid #e6e6e6;
  margin: 0 auto;
}
.merchant-logo-message {
  margin: 0 auto;
  text-align: center;
  overflow-wrap: break-word;
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
.merchant-info-hours {
  text-align: end;
  margin-top: 5px;
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
.product-name {
  font-size: 1.2em;
}
.product-image {
  padding-top: 0;
  padding-bottom: 0;
  position: relative;
}
.product-image > .v-image {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  overflow: hidden;
}
.product-price {
  color: #4caf50 !important;
  font-weight: 500 !important;
}
.merchant-products {
  margin-bottom: 40px;
}

.merchant-product {
  overflow: hidden;
  padding-left: 12px;
}
.product-category {
  padding: 15px 20px;
  background: #4caf50 !important;
  color: white !important;
  font-size: 1.4em;
}
.product-content {
  align-self: center;
}
@media only screen and (max-width: 599px) {
  .img-header {
    max-height: 125px !important;
  }
  .merchant-info {
    margin-top: 0;
    text-align: center;
  }
  .merchant-info-hours {
    text-align: center;
    margin-top: 0;
    padding-top: 0;
  }
  .merchant-logo-wrapper {
    margin-bottom: 80px;
  }
  .product-image {
    height: 112px;
  }
  .merchant-products > div {
    padding-bottom: 0px;
  }
  .product-category {
    padding: 10px 15px;
  }
  .product-content {
    padding-left: 0;
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
  .product-name {
    font-size: 1em;
  }
}
</style>