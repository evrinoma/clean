import * as SingleTon from "./abstract.entry";

new SingleTon.Vue({
    vuetify: SingleTon.Vuetify,
    render: h => h(SingleTon.App),
}).$mount('#app');


