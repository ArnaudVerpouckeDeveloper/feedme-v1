import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Merchants from '../views/Merchants.vue'
import MerchantDetail from '../views/Merchant-Detail.vue'
import Order from '../views/Order.vue'
import Legal from '../views/TermsAndConditions.vue'
import Contact from '../views/Contact.vue'
import About from '../views/About.vue'
import Faq from '../views/Faq.vue'
import PageNotFound from '../views/PageNotFound.vue'

export const routes = [
    { path: '/', name: 'home', component: Home, display: 'Home', icon: "mdi-home" },
    { path: '/restaurants', name: 'Merchants', component: Merchants, display: 'Restaurants', icon: "mdi-store" },
    { path: '/restaurant/:id', name: 'MerchantDetail', component: MerchantDetail, display: 'hide', icon: "" },
    { path: '/over', name: 'about', component: About, display: 'Over ons', icon: "mdi-account-multiple" },
    { path: '/faq', name: 'faq', component: Faq, display: 'Faq', icon: "mdi-frequently-asked-questions" },
    { path: '/contact', name: 'contact', component: Contact, display: 'Contact', icon: "mdi-email" },
    { path: '/aanmelden', name: 'login', component: Login, display: 'hide', icon: "mdi-login-variant" },
    { path: '/registreren', name: 'register', component: Register, display: 'hide', icon: "mdi-account-plus" },
    { path: '/bevestigbestelling', name: 'order', component: Order, display: 'hide', icon: "" },
    { path: '/voorwaarden', name: 'legal', component: Legal, display: 'hide', icon: "" },
    { path: '/admin/registreren', name: 'merchantRegister', display: 'hide', beforeEnter() { location.href = 'https://speedmeal.be/admin/registreren' }},
    { path: '/admin/login', name: 'merchantLogin', display: 'hide', beforeEnter() { location.href = 'https://speedmeal.be/admin/login' }},
    { path: 'https://www.instagram.com/speedmeal/', name: 'speedmealInsta', display: 'hide', beforeEnter() { location.href = 'https://www.instagram.com/speedmeal/' }},
    { path: 'https://www.facebook.com/speedmeal.be', name: 'speedmealFacebook', display: 'hide', beforeEnter() { location.href = 'https://www.facebook.com/speedmeal.be' }},
    { path: '*', name: '404', display: 'hide', component: PageNotFound},
]