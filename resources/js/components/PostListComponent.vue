<template>
    <div>
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
        this.getPosts();
    },
    methods: {
        getPosts: function() {
            fetch(`/api/posts?page=${this.currentPage}`)
            .then(response => response.json())
            .then(response => {
                this.posts = response.response.data;
                this.total = response.response.last_page;
            }) 
            .catch(reason => console.log(reason));
        },

        getCurrentPage: function(page) {
            this.currentPage = page;
            this.getPosts();
        }
    },
    data: function() {
        return {
            posts: [],
            total: 0, //total de paginas
            currentPage: 1 //pagina actual
        }
    }
}
</script>