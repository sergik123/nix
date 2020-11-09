<template>
    <nav>
        <sliding-pagination
            :current="currentPage"
            :total="totalPages"
            @page-change="pageChangeHandler"
        ></sliding-pagination>
    </nav>

</template>

<script>
    import SlidingPagination from 'vue-sliding-pagination';
    export default {
        name: "exampleViewComponent",
        components: {
            SlidingPagination
        },
        data() {
           return {
               currentPage:1,
               totalPages: 10
           }
        },
        methods:{
            pageChangeHandler(page){
                this.currentPage = page
            }
        }
    }
</script>
