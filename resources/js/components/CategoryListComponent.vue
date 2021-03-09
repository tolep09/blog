<template>
    <div class="row">
        <div class="col-lg-3 col-md-3 bg-primary"  v-for="category in categories" v-bind:key="category.id">
            <div class="card my-3">
                <router-link
                :to="{name: 'posts-category', params: {category_id:category.id}}">

                <img src="/categories-images/asterisk.png" class="card-img-top" 
                    style="width:30%; height:30%" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ category.title }}</h5>
                </div>

                </router-link>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    created() {
        this.getCategories();
    },
    methods: {
        getCategories: function() {
            fetch(`/api/categories/all`)
            .then(response => {
                return response.json();
            }) 
            .then(response => {
                this.categories = response.response;
            })
            .catch(reason => console.log('Error al consultar las categorias'));
        }
    },
    data: function() {
        return {
            categories: ''
        }
    }
}
</script>