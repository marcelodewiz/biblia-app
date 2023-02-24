<script>
    import axios from "axios";

    export default ({
        name: 'VersiculoDoDia',
        data() {
            return {
                versiculoDoDia: Array
            }
        },
        created() {
            this.getVersiculoDoDia();
        },
        methods: {
            async getVersiculoDoDia() {
                let url = 'http://127.0.0.1:8000/api/site';
                await axios.get(url).then(response => {
                    console.log(response);
                    this.versiculoDoDia = response.data;
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    })
</script>

<template>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Nova Versão</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ versiculoDoDia.livro.nome}}
                    {{ versiculoDoDia.capitulo + ' - ' + versiculoDoDia.versiculo}}</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">{{ versiculoDoDia.texto}}</p>
            </div>
        </div>
    </div>
</template>
