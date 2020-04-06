import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from './router/router'


Vue.use(Vuex)

const apiUrl = 'http://127.0.0.1:8000/api';

const state = {
    user: {},
    merchants: [],
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
        return state.token;
    },
    merchants: (state) => {
        return state.merchants;
    },
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
    async fetchMerchants(context) {
        await axios.get(`${apiUrl}/merchant/all`)
            .then(res => {
                context.commit('updateMerchants', res.data);
            })
            .catch(error => {
                console.error(error)
            })
    },

    async fetchProducts(context, id) {
        return await new Promise((resolve, reject) => {
            axios.get(`${apiUrl}/merchant/${id}`)
                .then(res => {
                    context.commit('updateProducts', res.data.products);
                    console.log(res.data)
                    resolve();
                })
                .catch(error => {
                    console.error(error)
                    reject();
                })
        })
    },

    async addProduct(context, data) {
        console.log(data)
        return await new Promise((resolve, reject) => {
            axios.post(`${apiUrl}/merchant/addProduct`, data, { headers: { 'Content-Type': 'application/json' } })
                .then(res => {
                    console.log("product:", res);
                    // context.commit('createProducts', res.data);
                    resolve();
                })
                .catch(error => {
                    console.error(error)
                    reject();
                })
        })
    },

    async deleteProduct(context, data) {
        await axios.delete(`${apiUrl}/product/${data.id}`, { headers: { 'Authorization': "bearer " + state.token } })
            .then(res => {
                context.commit('deleteProduct', res.data);
            })
            .catch(error => {
                console.error(error)
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

    async addOrder(context, data) {
        console.log(data)
        return await new Promise((resolve, reject) => {
            axios.post(`${apiUrl}/placeOrder`, data, { headers: { 'Authorization': "bearer " + state.token } })
                .then(res => {
                    console.log("order:", res);
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
                console.log(res);
                if (res.data.role == "merchant") {

                }
                console.log(res.data.redirect);
                if (res.data.redirect) {
                    window.location = res.data.redirect;
                } else {
                    context.commit('authUser', res.data)
                    router.replace({ name: "home" });
                }
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
    updateMerchants(state, data) {
        state.merchants = data
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
    updateOrdersDetail(state, data) {
        state.OrdersDetail = data
    },

    updateCart(state, data) {
        if (state.cartItems.length == 0) {
            data.count = 1;
            state.cartItems.push(data);
        } else {
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
                state.cartItems.splice(index, 1);

            }
        }

        state.cartItems = state.cartItems.map(item => {
            if (item.id == data.id) {
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

const store = new Vuex.Store({
    state,
    getters,
    actions,
    mutations,
});

export default store;