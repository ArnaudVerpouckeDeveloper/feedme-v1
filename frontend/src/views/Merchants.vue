<template>
  <v-container fluid class="list-merchant-container">
    <v-skeleton-loader
      v-if="merchants.length == 0"
      class="mx-auto"
      max-width="700"
      type="list-item-avatar-three-line"
    >
    </v-skeleton-loader>
    <v-spacer></v-spacer>
    <v-skeleton-loader
      v-if="merchants.length == 0"
      class="mx-auto"
      max-width="700"
      type="list-item-avatar-three-line"
    ></v-skeleton-loader>
    <v-hover v-slot:default="{ hover }" v-for="merchant in merchants">
      <v-card
        class="mx-auto merchant-list"
        :elevation="hover ? 16 : 2"
        :to="{name:'MerchantDetail', params:{id: merchant.id}}"
      >
        <v-row>
          <v-col cols="12" sm="5">
            <v-img class="white--text align-end" height="200px" :src="cardImage(merchant)" />
          </v-col>
          <v-col cols="12" sm="7">
            <v-card-title>{{merchant.name}}</v-card-title>
            <v-card-text class="text--primary">
              <div>
                <v-icon class="merchants-icon">mdi-map-marker</v-icon>
                <label>{{merchant.address_zip}} {{merchant.address_city}}</label>
              </div>
              <div v-if="deliveryPossible(merchant.possibleTimes.delivery)">
                <v-icon class="merchants-icon">mdi-moped</v-icon>
                <label>Levering aan huis mogelijk.</label>
              </div>
              <div v-if="takeawayPossible(merchant.possibleTimes.takeaway)">
                <v-icon class="merchants-icon">mdi-store</v-icon>
                <label>Afhaling mogelijk.</label>
              </div>
              <div
                v-if="!deliveryPossible(merchant.possibleTimes.delivery) && !takeawayPossible(merchant.possibleTimes.takeaway)"
              >
                <v-icon class="merchants-icon">mdi-door-closed-lock</v-icon>
                <label>Deze zaak is momenteel gesloten.</label>
              </div>
              <div
                v-if="deliveryPossible(merchant.possibleTimes.delivery) || takeawayPossible(merchant.possibleTimes.takeaway)"
              >
                <v-icon class="merchants-icon">mdi-door-open</v-icon>
                <label>Open</label>
              </div>
            </v-card-text>
          </v-col>
        </v-row>
      </v-card>
    </v-hover>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters(["merchants"])
  },
  created() {
    this.$store.dispatch("fetchMerchants");
  },
  methods: {
    deliveryPossible(delivery) {
      if (delivery.length != 0) return true;
      else return false;
    },
    takeawayPossible(takeaway) {
      if (takeaway.length != 0) return true;
      else return false;
    },
    cardImage(merchant) {
      if (merchant.bannerFileName != null)
        return `https://www.speedmeal.be/public/uploads/${merchant.bannerFileName}`;
      else return "/assets/images/placeholder/mechants_card.png";
    }
  }
};
</script>

<style>
.list-merchant-container {
  padding-top: 2em;
}
.merchant-list {
  margin-bottom: 2em;
  max-width: 52em;
  overflow: hidden;
}
.merchant-list > .row > div {
  padding: 0;
}

.merchants-icon {
  padding-right: 5px;
  color: rgb(76, 175, 80) !important;
}

@media only screen and (max-width: 960px) {
  .merchant-list {
    padding-left: 12px;
    padding-right: 12px;
  }
}
</style>