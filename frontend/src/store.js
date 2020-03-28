import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from './router/router'


Vue.use(Vuex)

const apiUrl = 'http://127.0.0.1:8000/api';



const state = {
  user: {},
  toke: {},
  products: [],
  ProductDetail: {},
  orders: [],
  orderDetail: {},
  isMobile: false,
  cartIsOpen: false,
  cartItems: [],
}

const getters = {
  products: (state) => {
    return state.products;
  },
  cartItems: (state) => {
    return state.cartItems;
  },
  isMobile: (state) => {
    return state.isMobile;
  },
  cartIsOpen: (state) => {
    return state.cartIsOpen;
  },
  showCartButton: (state) => {
    if (!state.cartIsOpen)
      return true;
    else
      return false;
  }
}

const actions = {
  async fetchProducts(context) {
    await axios.get(`${apiUrl}/merchant/1`)
      .then(res => {
        context.commit('updateProducts', res.data.products);
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

  async addItemToCart(context, data) {
    context.commit('updateCart', data)
  },
  async removeItemFromCart(context, data) {
    context.commit('removeItemCart', data)
  },

  async login(context, data) {
    await axios.post(`${apiUrl}/auth/login`, data)
      .then(res => {
        context.commit('authUser', res.data)
        router.replace({ name: "home" });
      })
      .catch(error => {
        console.error(error)
      })
  },
  async register(context, data) {
    console.log(data)
    await axios.post(`${apiUrl}/auth/registerCustomer`, data)
      .then(res => {
        console.log(res);
        router.replace({ name: "login" });
      })
      .catch(error => {
        console.error(error)
      })
  },

  async windowsResize(context) {
    context.commit('mobileWatcher', document.body.clientWidth)
    window.addEventListener("resize", () => {
      context.commit('mobileWatcher', document.body.clientWidth);
      if (!state.isMobile)
        context.commit('cartWatcher', true)
    });
  },
  async onChangeDrawer(context, data) {
    context.commit('cartWatcher', data)
  },
  async toggleCart(context, data) {
    context.commit('cartWatcher', data)
  }
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

  updateCart(state, data) {
    if (state.cartItems.length == 0) {
      data.count = 1;
      state.cartItems.push(data);
    }
    else {
      //update existing item.
      state.cartItems = state.cartItems.map(item => {
        if (item.id == data.id) {
          item.count++;
        }
        return item;
      })
      //add new item.
      let index = state.cartItems.findIndex(x => x.id == data.id)
      if (index === -1) {
        data.count = 1;
        state.cartItems.push(data);
      }
    }
  },
  removeItemCart(state, data) {
    let index = state.cartItems.findIndex(x => x.id == data.id)
    if (index != -1) {
      if (data.count == 1) {
        console.log("index")
        state.cartItems.splice(index, 1);

      }
    }

    state.cartItems = state.cartItems.map(item => {
      if (item.id == data.id) {
        console.log("hoho")
        if (item.count > 1) {
          item.count--;
        }
      }
      return item;
    })

  },

  authUser(state, data) {
    localStorage.setItem("user", data.access_token);
    state.token = localStorage.getItem("user");
  },
  logOut(state) {
    state.token = null;
    localStorage.removeItem("user");
  },
  mobileWatcher(state, size) {
    if (size < 1000) {
      state.isMobile = true;
    } else {
      state.isMobile = false;
    }
  },
  cartWatcher(state, data) {
    state.cartIsOpen = data;
  },
}



export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations,
});
