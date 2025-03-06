<template>

    <div class="bg-orange-800 text-white w-96 rounded-md flex flex-col items-center p-4 m-4 shadow-xl">
        <div>
            <h1 class="font-normal text-2xl"> Informe o CEP</h1>
        </div>
        <input type="text"
            class="w-1/2 p-2 mt-2 border border-gray-300 rounded-md transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 white-gray-700 placeholder-stone-300 bg-stone-900"
            placeholder="Digite o CEP" v-model="cep" @keyup="buscarCep" v-mask="'#####-###'">

        <transition name="fade">
            <div v-if="error" class="mt-2 text-white bg-red-600 p-2 rounded-md text-sm">
                {{ error }}
            </div>
        </transition>
        <transition name="fade">
            <div v-if="endereco" class="mt-2 text-[14px] text-slate-300">
                <p>CEP: {{ endereco.cep }}</p>
                <p>Logradouro: {{ endereco.logradouro }}</p>
                <p>Bairro: {{ endereco.bairro }}</p>
                <p>Cidade: {{ endereco.localidade }}</p>
                <p>Estado: {{ endereco.uf }}</p>
            </div>

        </transition>
    </div>


</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            cep: '',
            endereco: null,
            error: null
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        buscarCep() {
            if (this.cep.length === 9) {
                axios.get(`/api/cep/${this.cep}`)
                    .then(response => {
                        this.endereco = response.data;
                        this.error = null;
                    })
                    .catch(error => {
                        this.error = error.response.data.message;
                        this.endereco = null;
                    });
            } else {
                this.endereco = null;
                this.error = null;
            }
        }
    }
}

</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>