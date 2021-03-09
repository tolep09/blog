<template>
    <div>
        <h2>Posts sobre {{ category.title }}</h2>
        <post-list-generic
            :key="currentPage"
            @pageChange="getCurrentPage" 
            v-if="total > 0" 
            :posts="posts" 
            :pCurrentPage="currentPage"
            :total="total">
        </post-list-generic>
    </div>
</template>
<script>
export default {
    created() {
        this.getPosts(this.$route.params.category_id);
    },
    methods: {
        getPosts: function(id) {
            fetch(`/api/posts/${id}/category?page=${this.currentPage}`)
            .then(response => response.json())
            .then(response => {
                this.posts = response.response.posts.data;
                this.category = response.response.category;
                this.total = response.response.posts.last_page;
            })
            .catch(reason => console.log(reason));
        },
        getCurrentPage: function(page) {
            this.currentPage = page;
            this.getPosts(this.$route.params.category_id);
        }
    },
    data: function() {
        return {
            posts: [],
            category: '',
            total: 0, //total de paginas
            currentPage: 1 //pagina actual
        }
    }
}
</script>