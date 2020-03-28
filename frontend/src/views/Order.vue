<template>
  <v-container fluid>
    <v-layout align-center justify-center :style="cardStyle">
      <v-flex xs12 sm10>
        <v-card class="elevation-3">
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Uw bestelling bij: {{}}</v-toolbar-title>
          </v-toolbar>
          <v-form ref="form" lazy-validation>
            <v-card-text>
              <v-form>
                <v-row>
                  <v-col cols="9">
                    <v-text-field v-model="orderForm.straat" label="Straat" required></v-text-field>
                  </v-col>
                  <v-col cols="3">
                    <v-text-field v-model="orderForm.nummer" label="Nummer" required></v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field v-model="orderForm.postcode" label="Postcode" required></v-text-field>
                  </v-col>
                  <v-col cols="8">
                    <v-text-field v-model="orderForm.stad" label="Stad" required></v-text-field>
                  </v-col>
                </v-row>
              </v-form>
            </v-card-text>
          </v-form>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="placeOrder()">Bevestig Bestelling</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>

    <ShoppingCart :showOrderBtn="false"></ShoppingCart>
    <CartButton></CartButton>
  </v-container>
</template>

<script>
import ShoppingCart from "../components/ShoppingCart";
import CartButton from "../components/CartButton";
import { mapGetters, mapActions } from "vuex";

export default {
  components: {
    ShoppingCart,
    CartButton
  },
  computed: {
    cardStyle() {
      if (!this.isMobile) 
        return "margin-right: 350px;";
      else 
        return "margin-right: -12px";
    },
    ...mapGetters(["isMobile","cartItems"])
  },
  data: () => ({
    orderForm: {}
  }),
  methods: {
    placeOrder() {
      this.addOrder({...this.orderForm, ...this.cartItems});
    },
    ...mapActions(["addOrder"])
  }
};
</script>

<style scoped>
</style>