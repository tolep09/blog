<template>
  <div class="col-lg-8 offset-2">
    <form @submit.prevent="saveContact">
      <!-- <base-input-component></base-input-component> -->
      <div class="card">
        <div class="card-header">
          <img
            class="logo-200 mx-auto d-block"
            src="/posts-images/laravel.png"
            alt=""
          />
        </div>
        <div class="card-body my-2">

          <BaseInputComponent label="Nombre" type="text" 
            :validator="$v.form.name"
            v-model="$v.form.name.$model">
          </BaseInputComponent>
          <BaseInputComponent label="Apellido" type="text" 
            :validator="$v.form.lastname"
            v-model="$v.form.lastname.$model">
          </BaseInputComponent>
          <BaseInputComponent label="email" type="email"
            :validator="$v.form.email"
             v-model="$v.form.email.$model">
          </BaseInputComponent>
        

          <div class="input-group my-2">
            <textarea
              class="form-control"
              placeholder="Comentarios"
              v-model="$v.form.comments.$model"
              :class="{'is-valid':!$v.form.comments.$error && $v.form.comments.$dirty,
                'is-invalid':$v.form.comments.$error}"
            ></textarea>
          </div>

          <button :disabled="formValid" type="submit" class="btn btn-primary float-right">
            Enviar
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import BaseInputComponent from './BaseInputComponent.vue';
import { required, minLength, email } from 'vuelidate/lib/validators';

export default {
  components: { BaseInputComponent },
  created() {},
  methods: {
    saveContact: function () {
      if (this.formValid) {
        console.log('Formulario no válido');
      } else {
        this.$awn.modal('<b>Guardando contacto...</b>')

        axios.post('/api/contact', {
          name: this.$v.form.name.$model,
          last_name: this.$v.form.lastname.$model,
          email: this.$v.form.email.$model,
          comments: this.$v.form.comments.$model,
        }).
        then(response => {
          console.log(response.data.message);
          this.$awn.success(response.data.message);
        }).
        catch(err => this.$awn.alert(err));
      }
    },
  },
  data() {
    return {
      form: {
        name: "",
        lastname: "",
        email: "",
        comments: "",
      },
    };
  },
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(2)
      },
      lastname: {
        required,
        minLength: minLength(2)
      },
      email: {
        required,
        email
      },
      comments: {
        required
      }
    }
  },
  computed: {
      formValid: function () {
        return this.$v.$invalid;
      }
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
<style lang="scss">
  @import '~vue-awesome-notifications/dist/styles/style.scss';
</style>
