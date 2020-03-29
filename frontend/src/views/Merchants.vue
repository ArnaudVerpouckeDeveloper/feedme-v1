<template>
  <v-container fluid class="list-merchant-container">
    <v-card
      v-for="merchant in merchants"
      class="mx-auto merchant-list"
      :to="{name:'MerchantDetail', params:{id: merchant.id}}"
    >
      <v-row>
        <v-col cols="12" sm="5">
          <v-img
            class="col-4 white--text align-end"
            height="200px"
            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
          />
        </v-col>
        <v-col cols="12" sm="7">
          <v-card-title>{{merchant.name}}</v-card-title>
          <v-card-text class="text--primary">
            <div>{{merchant.message}}</div>
            <div>
               <v-icon class="merchants-icon">mdi-map-marker </v-icon>
              <label>8000 Brugge</label>
            </div>
            <div v-if="merchant.deliveryMethod_delivery">
              <v-icon class="merchants-icon">mdi-moped</v-icon>
              <label>Levering aan huis mogelijk.</label>
            </div>
            <div v-if="merchant.deliveryMethod_takeaway">
              <v-icon class="merchants-icon">mdi-store</v-icon>
              <label>Afhaling mogelijk.</label>
            </div>
          </v-card-text>
        </v-col>
      </v-row>
    </v-card>
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