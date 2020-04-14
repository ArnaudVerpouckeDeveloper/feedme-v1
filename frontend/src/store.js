import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from './router/router'


Vue.use(Vuex)

const apiUrl = 'http://127.0.0.1:8000/api';

const state = {
    user: {},
    merchants: [],
    merchantDetail: {},
    token: "",
    products: [],
    ProductDetail: {},
    orders: [],
    orderDetail: {},
    isMobile: false,
    cartIsOpen: false,
    cartItems: [],
}

const getters = {
    token: (state) => {
        return state.token || localStorage.getItem("user");
    },
    merchants: (state) => {
        return state.merchants;
    },
    merchantDetail: (state) => {
        return state.merchantDetail;
    },
    products: (state) => {
        return state.products;
    },
    cartItems: (state) => {
        if (state.cartItems.length == 0 && localStorage.getItem("cartItems") != null) {
            state.cartItems = JSON.parse(localStorage.getItem("cartItems"));
        }
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
    async fetchMerchants(context) {
        await axios.get(`${apiUrl}/merchant/all`)
            .then(res => {
                context.commit('updateMerchants', res.data);
            })
            .catch(error => {
                console.error(error)
            })
    },

    async fetchMerchantAndProduct(context, id) {
        return await new Promise((resolve, reject) => {
            axios.get(`${apiUrl}/merchant/${id}`)
                .then(res => {
                    context.commit('updateMerchantDetail', res.data);
                    context.commit('updateProducts', res.data.products);
                    resolve();
                })
                .catch(error => {
                    console.error(error)
                    reject();
                })
        })
    },

    async fetchOrders(context) {
        await axios.get(`${apiUrl}/orders`)
            .then(res => {
                context.commit('updateOrders', res.data);

            })
            .catch(error => {
                console.error(error)
            })
    },

    async fetchOrdersDetail(context, id) {
        return await new Promise((resolve, reject) => {
            axios.get(`${apiUrl}/order/${id}`)
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

    async addOrder({ commit, getters }, data) {
        return await new Promise((resolve, reject) => {
            axios.post(`${apiUrl}/placeOrder`, data,
                { headers: { 'Authorization': "bearer " + getters.token } })
                .then(res => {
                    commit('updateOrderDetail', res.data);
                    resolve();
                })
                .catch(error => {
                    console.error(error)
                    reject();
                })
        })
    },

    async addItemToCart({ commit, getters }, data) {
        commit('updateCart', data.product)
    },
    async removeItemFromCart({ commit, getters }, data) {
        commit('removeItemCart', data)
    },

    async sendContactForm(context, data) {
        return await new Promise((resolve, reject) => {
            axios.post(`https://speedmeal.be/sendContactForm`, data)
                .then(res => {
                    resolve();
                    router.replace({ name: "home" });
                })
                .catch(error => {
                    console.error(error)
                    reject();
                })
        })
    },

    async login(context, data) {
        return await new Promise((resolve, reject) => {
            axios.post(`${apiUrl}/auth/login`, data)
                .then(res => {
                    resolve();
                    context.commit('updateUser', res.data)
                    router.replace({ name: "Merchants" });
                })
                .catch(error => {
                    reject();
                    console.error(error)
                })
        })
    },
    async register(context, data) {
        return await new Promise((resolve, reject) => {
            axios.post(`${apiUrl}/auth/registerCustomer`, data)
                .then(res => {
                    resolve(res.data);
                })
                .catch(error => {
                    reject(error.response.data.errors)
                    console.error(error)
                })
        })
    },
    async reSendVerification(context, id) {
        return await new Promise((resolve, reject) => {
            axios.get(`${apiUrl}/resendConfirmEmail/${id}`)
                .then(res => {
                    resolve(res.data);
                })
                .catch(error => {
                    reject(error.response.data.errors)
                    console.error(error)
                })
        })
    },
    async authUser({ getters }) {
        return await new Promise((resolve, reject) => {
            axios.post(`${apiUrl}/auth/me`, null, { headers: { 'Authorization': "bearer " + getters.token } })
                .then(res => {
                    if (res.status === 200)
                        resolve();
                    else reject();
                })
                .catch(error => {
                    console.error(error)
                    reject();
                })
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
    updateMerchants(state, data) {
        state.merchants = data
    },
    updateMerchantDetail(state, data) {
        state.merchantDetail = data
    },
    updateProducts(state, data) {
        state.products = data
    },
    createProducts(state, data) {
        state.products.push(data);
    },
    deleteEventItem(state, data) {
        state.products = state.products.filter((product) => {
            return product.id != data.id
        })
    },
    updateOrders(state, data) {
        state.orders = data
    },
    updateOrderDetail(state, data) {
        localStorage.removeItem("cartItems");
        state.cartItems = [];
    },
    updateCart(state, data) {
        if (state.cartItems[data.merchant_id] === undefined) {
            data.count = 1;
            Vue.set(state.cartItems, data.merchant_id, [data])
            localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
        } else {
            //update existing item.
            let updatedItem = state.cartItems[data.merchant_id].map(item => {
                if (item.id == data.id) {
                    item.count++;
                }
                return item;
            })
            Vue.set(state.cartItems, data.merchant_id, updatedItem)
            localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
            //add new item.
            let index = state.cartItems[data.merchant_id].findIndex(x => x.id == data.id)
            if (index === -1) {
                data.count = 1;
                state.cartItems[data.merchant_id].push(data);
                localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
            }
        }
    },
    removeItemCart(state, data) {
        let index = state.cartItems[data.merchant_id].findIndex(x => x.id == data.id)
        if (index != -1) {
            let cartItem = state.cartItems[data.merchant_id][index];
            if (cartItem.count == 1) {
                state.cartItems[data.merchant_id].splice(index, 1);
            }
        }

        let updatedItem = state.cartItems[data.merchant_id].map(item => {
            if (item.id == data.id) {
                if (item.count > 1) {
                    item.count--;
                }
            }
            return item;
        })
        Vue.set(state.cartItems, data.merchant_id, updatedItem)
        localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
    },

    updateUser(state, data) {
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

const store = new Vuex.Store({
    state,
    getters,
    actions,
    mutations,
});

export default store;