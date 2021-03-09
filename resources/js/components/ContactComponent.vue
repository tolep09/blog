<template>
  <div class="col-lg-8 offset-2">
    <div class="card">
        <div class="card-header">
            <img class="logo-200 mx-auto d-block" src="/posts-images/laravel.png" alt="">
        </div>
        <div class="card-body my-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nombre</span>
                </div>
                <input type="text" class="form-control" v-model="name" required />
            </div>

            <div class="input-group my-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Apellido</span>
                </div>
                <input type="text" class="form-control" v-model="lastname" required />
            </div>

            <div class="input-group my-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">email</span>
                </div>
                <input type="email" class="form-control" v-model="email" required />
            </div>

            <div class="input-group my-2">
                <textarea class="form-control" placeholder="Comentarios" v-model="coments"></textarea>
            </div>

            <button v-on:click="saveContact" class="btn btn-primary float-right">Enviar</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {},
  methods: {
    saveContact: function () {},
  },
  data() {
      return {
          name: '',
          lastname: '',
          email: '',
          coments: ''
      }
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
