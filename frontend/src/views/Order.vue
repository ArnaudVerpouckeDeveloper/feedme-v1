<template>
  <v-container fluid>
    <v-layout align-center justify-center :style="cardStyle">
      <v-flex xs12 sm10>
        <v-card class="elevation-3">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Uw bestelling bij: {{merchantDetail.name}}</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form v-model="valid" ref="form">
              <v-row>
                <v-col cols="9">
                  <v-text-field
                    v-model="orderForm.addressStreet"
                    label="Straat"
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>
                <v-col cols="3">
                  <v-text-field
                    v-model="orderForm.addressNumber"
                    label="Nummer"
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>
                <v-col cols="4">
                  <v-text-field
                    v-model="orderForm.addressZipCode"
                    label="Postcode"
                    type="number"
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>
                <v-col cols="8">
                  <v-text-field
                    v-model="orderForm.addressCity"
                    label="Stad"
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>
                <v-col cols="3" lg="2">
                  <v-radio-group v-model="orderForm.deliveryMethod" :mandatory="true">
                    <v-radio
                      v-if="merchantDetail.deliveryMethod_delivery"
                      label="Leveren"
                      value="delivery"
                    ></v-radio>
                    <v-radio
                      v-if="merchantDetail.deliveryMethod_takeaway"
                      label="Afhalen"
                      value="takeaway"
                    ></v-radio>
                  </v-radio-group>
                </v-col>
                <v-col cols="6" md="4" xl="2" style="align-self: center;">
                  <v-select
                    :items="merchantDetail.possibleTimes[orderForm.deliveryMethod]"
                    name="deliveryTime"
                    :label="deliveryTimeLabel"
                    v-model="orderForm.requestedTime"
                    no-data-text="Deze horeca zaak is momenteel gesloten."
                    :rules="val.deliveryTimeRules"
                  ></v-select>
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="placeOrder()">Bevestig Bestelling</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <v-dialog v-model="dialog" persistent max-width="420">
      <v-card>
        <v-card-title class="headline">Bedankt voor uw bestelling!</v-card-title>
        <v-card-text>Uw bestelling werd doorgegeven. We sturen u dadelijk nog een bevestiging van uw bestelling naar uw e-mailadres.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="orderDialog">Ok</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <ShoppingCart :showOrderBtn="false" :merchant_id="merchantDetail.id"></ShoppingCart>
    <CartButton></CartButton>
  </v-container>
</template>

<script>
import ShoppingCart from "../components/ShoppingCart";
import CartButton from "../components/CartButton";
import { mapGetters, mapActions } from "vuex";

export default {
  beforeRouteEnter(to, from, next) {
    if (from.name === "MerchantDetail") {
      const store = require("../store");
      store.default
        .dispatch("authUser")
        .then(() => {
          next();
        })
        .catch(() => {
          next("/aanmelden");
        });
    } else next("/restaurants");
  },
  components: {
    ShoppingCart,
    CartButton
  },
  computed: {
    deliveryTimeLabel() {
      if (this.orderForm.deliveryMethod === "delivery")
        return "Gewenste bezorgtijd";
      else return "Gewenste afhaaltijd";
    },
    cardStyle() {
      if (!this.isMobile) return "margin-right: 350px;";
      else return "margin-right: -12px";
    },
    ...mapGetters(["isMobile", "cartItems", "merchantDetail"])
  },
  data: () => ({
    dialog: false,
    orderForm: {},
    valid: false,
    val: {
      requiredRule: [v => !!v || "Deze veld is verplicht"],
      deliveryTimeRules: [v => !!v || `Gelieve een tijdstip te kiezen.`],
      emailRules: [
        v => !!v || "E-mail is verplicht",
        v => /.+@.+/.test(v) || "Gelieve een geldig email in te geven."
      ]
    }
  }),
  methods: {
    placeOrder() {
      let merchantId = this.merchantDetail.id;
      let merchant = { merchantId };
      let orders = {
        productIds: this.cartItems[merchantId].map(({ id }) => id)
      };
      this.addOrder({
        ...merchant,
        ...this.orderForm,
        ...orders
      }).then(() => {
        this.dialog = true;
      });
    },
    orderDialog() {
      this.orderForm = {};
      this.$refs.form.reset();
      this.dialog = false;
      this.$router.push("/");
    },
    ...mapActions(["addOrder"])
  }
};
</script>

<style scoped>
</style>