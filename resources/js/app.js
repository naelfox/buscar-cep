

import { createApp } from 'vue';
import VueTheMask from 'vue-the-mask';


const app = createApp({});

app.use(VueTheMask);


import CepCard from './components/CepCard.vue';
app.component('cep-card', CepCard);

app.mount('#app');
