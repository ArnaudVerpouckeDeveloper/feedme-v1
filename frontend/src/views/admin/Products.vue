<template>
  <v-data-table :headers="headers" :items="products" sort-by="name" class="elevation-1">
    <template v-slot:item.available="{ item }">
      <v-simple-checkbox v-model="item.available" disabled></v-simple-checkbox>
    </template>
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Producten</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">Nieuw Product</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.name" label="Naam"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.price" label="Prijs"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-checkbox v-model="editedItem.available" label="Beschikbaar"></v-checkbox>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea v-model="editedItem.description" label="Beschrijving" rows="2"></v-textarea>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Annuleren</v-btn>
              <v-btn color="blue darken-1" text @click="save">Opslaan</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
      <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  beforeRouteEnter(to, from, next) {
    const store = require("../../store");
    store.default.dispatch("fetchMerchantAndProduct", to.params.id).then(() => {
      next();
    });
  },
  computed: {
    formTitle() {
      console.log(this.products);

      return this.editedIndex === -1 ? "Nieuw product" : "Product bewerken";
    },
    ...mapGetters(["products"])
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  data: () => ({
    dialog: false,
    headers: [
      {
        text: "Naam",
        align: "start",
        sortable: false,
        value: "name"
      },
      { text: "Beschrijving", value: "description", sortable: false },
      { text: "Prijs", value: "price" },
      { text: "Beschikbaar", value: "available" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      description: "",
      price: 0,
      available: true
    },
    defaultItem: {
      name: "",
      description: "",
      price: 0,
      available: true
    }
  }),

  methods: {
    initialize() {
      this.desserts = [
        {
          name: "Frozen Yogurt",
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0
        },
        {
          name: "Ice cream sandwich",
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3
        },
        {
          name: "Eclair",
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0
        },
        {
          name: "Cupcake",
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3
        },
        {
          name: "Gingerbread",
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9
        },
        {
          name: "Jelly bean",
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0
        },
        {
          name: "Lollipop",
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0
        },
        {
          name: "Honeycomb",
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5
        },
        {
          name: "Donut",
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9
        },
        {
          name: "KitKat",
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7
        }
      ];
    },

    editItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.desserts.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.desserts.splice(index, 1);
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      // if (this.editedIndex > -1) {
      //   Object.assign(this.desserts[this.editedIndex], this.editedItem);
      // } else {
      console.log("add", this.editedItem);
      this.addProduct(this.editedItem);
      // }
      this.close();
    },
    ...mapActions(["addProduct"])
  }
};
</script>

<style>
</style>