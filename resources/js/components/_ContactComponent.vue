<template>
  <div class="col-lg-8 offset-2">
    <form @submit.prevent="saveContact">
      <div class="card">
        <div class="card-header">
          <img
            class="logo-200 mx-auto d-block"
            src="/posts-images/laravel.png"
            alt=""
          />
        </div>
        <div class="card-body my-2">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Nombre</span>
            </div>
            <input
              type="text"
              class="form-control"
              v-model="form.name"
              required
            />
          </div>

          <div class="input-group my-2">
            <div class="input-group-prepend">
              <span class="input-group-text">Apellido</span>
            </div>
            <input
              type="text"
              class="form-control"
              v-model="form.lastname"
              required
            />
          </div>

          <div class="input-group my-2">
            <div class="input-group-prepend">
              <span class="input-group-text">email</span>
            </div>
            <input
              type="email"
              class="form-control"
              v-model="form.email"
              required
            />
          </div>

          <div class="input-group my-2">
            <textarea
              class="form-control"
              placeholder="Comentarios"
              v-model="form.coments"
            ></textarea>
          </div>

          <button v-on:click="saveContact" class="btn btn-primary float-right">
            Enviar
          </button>
        </div>
      </div>
    </form>
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
      form: {
        name: "",
        lastname: "",
        email: "",
        coments: "",
      },
    };
  },
  computed: {
      formValid: function () {
          return this.form.name.length > 0 &&
            this.form.lastname.length > 0 &&
            this.form.email.length > 0 &&
            this.form.comments.length > 0
      }
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
