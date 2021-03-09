<template>
    <div>
        <div class="card my-3" v-for="post in posts" v-bind:key="post.id">
            <img v-bind:src="'/posts-images/' + post.name" class="card-img-top" 
                style="width:30%; height:30%" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.content }}</p>
                <button type="button" class="btn btn-primary" v-on:click="openModal(post)">Ver resumen</button>
                <router-link class="btn btn-dark" :to="{name: 'post-detail', params: {id:post.id}}">
                    Ver
                </router-link>
            </div>
        </div>

        <modal-post @closeModalPost="closeModalPost" :post="postSelected"></modal-post>

        <v-pagination class="my-4" 
            v-model="currentPage" 
            :page-count="total"
            :classes="bootstrapPaginationClasses"
            :labels="paginationAnchorTexts">
        </v-pagination>

        
    </div>
</template>
<script>
import vPagination from 'vue-plain-pagination';

export default {
    props: ['posts', 'total', 'pCurrentPage'],
    components: { vPagination },
    
    created() {
        this.currentPage = this.pCurrentPage;
    },
    watch: {
        currentPage: function(newVal, oldVal) {
            this.$emit('pageChange', newVal);
        }
    },
    methods: {
        openModal: function(post) {
            this.postSelected = post;
        },

        closeModalPost: function() {
            this.postSelected = '';
        },
    },
    data: function() {
        return {
            postSelected: '',
            currentPage: 1,
            bootstrapPaginationClasses: {
                ul: 'pagination',
                li: 'page-item',
                liActive: 'active',
                liDisable: 'disabled',
                button: 'page-link'  
            },
            paginationAnchorTexts: {
                first: 'First',
                prev: '&laquo;',
                next: '&raquo;',
                last: 'Last'
            }
        }
    }
}
</script>