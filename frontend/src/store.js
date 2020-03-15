import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const apiUrl = 'http://localhost';



const state = {
  user: {},
  toke: {},
  products: [],
  ProductDetail: {},
  orders: [],
  orderDetail: {},
}

const getters = {

}

const actions = {
  async fetchProducts(context) {
    await axios.get(`${apiUrl}/api/products`)
      .then(res => {
        context.commit('updateProducts', res.data);

      })
      .catch(error => {
        console.error(error)
      })
  },

  async fetchProductDetail(context, id) {
    return await new Promise((resolve, reject) => {
      axios.get(`${apiUrl}/api/product/${id}`)
        .then(res => {
          context.commit('updateProductDetail', res.data);
          resolve();
        })
        .catch(error => {
          console.error(error)
          reject();
        })
    })
  },

  async deleteProduct(context, data) {
    await axios.delete(`${apiUrl}/api/product/${data.id}`,
     { headers: { 'Authorization': "bearer " + state.token } })
      .then(res => {
        context.commit('deleteProduct', res.data);
      })
      .catch(error => {
        console.error(error)
      })
  },

  async fetchOrders(context) {
    await axios.get(`${apiUrl}/api/orders`)
      .then(res => {
        context.commit('updateOrders', res.data);

      })
      .catch(error => {
        console.error(error)
      })
  },

  async fetchOrdersDetail(context, id) {
    return await new Promise((resolve, reject) => {
      axios.get(`${apiUrl}/api/order/${id}`)
        .then(res => {
          context.commit('updateOrderDetail', res.data);
          resolve();
        })
        .catch(error => {
          console.error(error)
          reject();
        })
    })
  },

  async login(context, data) {
    await axios.post(`${apiUrl}/api/user/signin`, data)
      .then(res => {
        context.commit('authUser', res.data)
        router.replace({ name: "home" });
      })
      .catch(error => {
        console.error(error)
      })
  },
  async register(data) {
    await axios.post(`${apiUrl}/api/user/signup`, data)
      .then(res => {
        router.replace({ name: "home" });
      })
      .catch(error => {
        console.error(error)
      })
  },
}

const mutations = {
  updateProducts(state, data) {
    state.products = data
  },
  updateProductDetail(state, data) {
    state.ProductDetail = data
  },
  deleteEventItem(state, data) {
    state.products = state.products.filter((product) => {
        return product.id != data.id
    })
},
  updateOrders(state, data) {
    state.orders = data
  },
  updateOrdersDetail(state, data) {
    state.OrdersDetail = data
  },
  authUser(state, data) {
    localStorage.setItem("user", data.access_token);
    state.token = localStorage.getItem("user");
  },
  logOut(state) {
    state.token = null;
    localStorage.removeItem("user");
  }
}



export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations,
});
