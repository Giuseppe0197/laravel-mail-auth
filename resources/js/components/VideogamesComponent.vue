<template>
    <div>
        <h1>Videogames</h1>

        <div class="container">

            <div class="videogames" v-for="videogame, i in videogames" :key="i">
                <p>Titolo: {{videogame.title}}</p>
                <p>Sottotitolo: {{videogame.subtitle}}</p>
                <p>Voto: {{videogame.rating}}</p>
                <p v-if="user">

                    <button @click="deleteVideogame(videogame.id)" class="btn btn-danger">Cancella</button>
                </p>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                videogames: []
            }
        },

        props: {

            user: String

        },

        methods: {
            deleteVideogame(id) {

                const self = this;
                axios.get(`/api/videogames/delete/${id}`)
                      .then (r => {
                          const ind = self.getIndex(id);
                          self.videogames.splice(ind, 1);
                      })
                      .catch(e => console.error(e));
            },

            getIndex(id) {
                for (let i = 0; i < this.videogames.length; i++){
                    const videogame = this.videogames[i];

                    if (videogame.id == id){
                        return i;
                    }

                    return -1;

                }
            }
        },
        mounted() {
            axios.get('/api/videogames/list')
                 .then(r => this.videogames = r.data)
                 .catch(e => console.error(e));
        }
    }
</script>