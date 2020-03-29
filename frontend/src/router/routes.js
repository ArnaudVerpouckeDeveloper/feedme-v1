import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Products from '../views/admin/Products.vue'
import Merchants from '../views/Merchants.vue'
import MerchantDetail from '../views/Merchant-Detail.vue'
import Order from '../views/Order.vue'
import Legal from '../views/TermsAndConditions.vue'
import Contact from '../components/Contact.vue'
import About from '../components/About.vue'
import Faq from '../components/Faq.vue'




export const routes = [
    { path: '/', name: 'home', component: Home, display: 'Home', icon: "mdi-home" },
    { path: '/restaurant', name: 'Merchants', component: Merchants, display: 'Restaurants', icon: "mdi-store" },
    { path: '/restaurant/:id', name: 'MerchantDetail', component: MerchantDetail, display: 'hide', icon: ""},
    { path: '/about', name: 'about', component: About, display: 'Over ons', icon: "mdi-account-multiple" },
    { path: '/faq', name: 'faq', component: Faq, display: 'Faq', icon: "mdi-frequently-asked-questions" },
    { path: '/contact', name: 'contact', component: Contact, display: 'Contact', icon: "mdi-email" },
    { path: '/login', name: 'login', component: Login, display: 'hide', icon: "mdi-login-variant" },
    { path: '/register', name: 'register', component: Register, display: 'hide', icon: "mdi-account-plus" },
    { path: '/admin/products/:id', name: 'products', component: Products, display: 'hide', icon: "" },
    { path: '/confirmorder', name: 'order', component: Order, display: 'hide', icon: "" },
    { path: '/legal', name: 'legal', component: Legal, display: 'hide', icon: "" },
]