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
                <v-col cols="5" sm="3" lg="2">
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
                <v-col cols="7" sm="4" xl="3" style="align-self: center;">
                  <v-select
                    :items="merchantDetail.possibleTimes[orderForm.deliveryMethod]"
                    name="deliveryTime"
                    :label="deliveryTimeLabel"
                    v-model="orderForm.requestedTime"
                    no-data-text="Deze horeca zaak is momenteel gesloten."
                    :rules="val.deliveryTimeRules"
                  ></v-select>
                </v-col>
                <v-col cols="12" sm="5" lg="5" xl="4" style="align-self: center;">
                  <v-text-field
                    v-model="orderForm.mobilePhone"
                    value="5"
                    label="Telefoon"
                    hint="Bij vragen of problemen zal u op deze nummer gecontacteerd worden."
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>

                <v-col cols="9" v-if="isDelivery">
                  <v-text-field
                    v-model="orderForm.addressStreet"
                    label="Straat"
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>
                <v-col cols="3" v-if="isDelivery">
                  <v-text-field
                    v-model="orderForm.addressNumber"
                    label="Nummer"
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>
                <v-col cols="4" v-if="isDelivery">
                  <v-text-field
                    v-model="orderForm.addressZipCode"
                    label="Postcode"
                    type="number"
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>
                <v-col cols="8" v-if="isDelivery">
                  <v-text-field
                    v-model="orderForm.addressCity"
                    label="Stad"
                    required
                    :rules="val.requiredRule"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    v-model="orderForm.message"
                    label="Opmerkingen voor het restaurant?"
                    rows="3"
                  ></v-textarea>
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              @click="placeOrder()"
              :loading="loading"
              :disabled="loading"
            >Bevestig Bestelling</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <v-dialog v-model="dialog" persistent max-width="420">
      <v-card>
        <v-card-title class="headline">
          <v-icon size="35" :class="dialogToShow">{{dialogContent[dialogToShow].icon}}</v-icon>
          {{dialogContent[dialogToShow].title}}
        </v-card-title>
        <v-card-text>{{dialogContent[dialogToShow].text}}</v-card-text>
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
        .then(user => {
          next(vm => vm.orderForm.mobilePhone = user.mobilePhone);
          store.default.dispatch("toggleCart", false);
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
    isDelivery() {
      if (this.orderForm.deliveryMethod === "delivery") return true;
      else return false;
    },
    deliveryTimeLabel() {
      if (this.orderForm.deliveryMethod === "delivery")
        return "Gewenste bezorgtijd";
      else return "Gewenste afhaaltijd";
    },
    cardStyle() {
      if (!this.isMobile) return "margin-right: 350px;";
      else return "";
    },
    ...mapGetters(["isMobile", "cartItems", "merchantDetail"])
  },
  data: () => ({
    loading: false,
    dialog: false,
    orderForm: {
      mobilePhone: ""
    },
    valid: false,
    val: {
      requiredRule: [v => !!v || "Deze veld is verplicht"],
      deliveryTimeRules: [v => !!v || `Gelieve een tijdstip te kiezen.`],
      emailRules: [
        v => !!v || "E-mail is verplicht",
        v => /.+@.+/.test(v) || "Gelieve een geldig email in te geven."
      ]
    },
    dialogToShow: "orderSend",
    dialogContent: {
      orderSend: {
        icon: "mdi-check",
        title: "Bedankt voor uw bestelling!",
        text:
          "Een bevestiging van uw bestelling werd naar uw e-mailadres gestuurd."
      },
      orderNotSend: {
        icon: "mdi-alert-circle-outline",
        title: "Er iets fout gegaan.",
        text:
          "Gelieve na te kijken of u all uw gegevens correct hebt ingevuld en of de restaurant nog open is."
      }
    }
  }),
  methods: {
    placeOrder() {
      this.$refs.form.validate();
      if (this.valid) {
        this.loading = true;
        let merchantId = this.merchantDetail.id;
        let merchant = { merchantId };
        let orders = {
          products: this.cartItems[merchantId].map(p => ({
            id: p.id,
            count: p.count
          }))
        };
        this.addOrder({
          ...merchant,
          ...this.orderForm,
          ...orders
        })
          .then(() => {
            this.dialogToShow = "orderSend";
            this.dialog = true;
            this.loading = false;
          })
          .catch(() => {
            this.dialogToShow = "orderNotSend";
            this.dialog = true;
            this.loading = false;
          });
      }
    },
    orderDialog() {
      if (this.dialogToShow === "orderSend") {
        this.orderForm = {};
        this.$refs.form.reset();
        this.dialog = false;
        this.$router.push("/");
      } else this.dialog = false;
    },
    ...mapActions(["addOrder"])
  }
};
</script>

<style scoped>
.orderSend,
.orderNotSend {
  padding-right: 10px;
}
.orderSend {
  color: #4caf50;
}
.orderNotSend {
  color: #f44336;
}
</style>