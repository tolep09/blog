<template>
  <div>
    <div v-if="post">
      <div class="card my-3">
        <div class="card-header">
          <img v-if="post.image"
            v-bind:src="'/posts-images/' + post.image.name"
            class="card-img-top"
            style="width: 30%; height: 30%"
            alt="..."
          />
        </div>

        <div class="card-body">
          <h2 class="card-title">{{ post.title }}</h2>
          <router-link class="btn btn-success" :to="{name: 'posts-category', params: {category_id:post.category.id}}">
                {{ post.category.title }}
            </router-link>
          <p class="card-text mt-3">{{ post.content }}</p>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">404</h4>
        <p>El post no existe</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  created() {
      this.getPost(this.$route.params.id);
  },
  methods: {
    getPost: function (id) {
         fetch(`/api/posts/${id}`)
            .then(response => {
                if (response.status != '200') {
                    this.post = undefined;
                    throw new Error();
                } else {
                    return response.json();
                }
            }) 
            .then(response => {
                this.post = response.response;
            })
            .catch(reason => console.log('Error al consultar post'));
    },
  },
  data: function () {
    return {
      post: '',
    };
  },
};
</script>