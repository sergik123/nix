<template>
   <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 10px;"><a v-bind:href="'?sort=id&page='+page" >id</a></th>
            <th scope="col"><a v-bind:href="'?sort=name&page='+page">name</a></th>
            <th scope="col"><a  v-bind:href="'?sort=author&page='+page">author</a></th>
            <th scope="col">description</th>
            <th scope="col">cover</th>
            <th scope="col">category</th>
        </tr>
        </thead>
        <tbody>

        <tr v-for="book in books">
            <th><a v-bind:href="'?sort=id&page='+page+'&id='+book.id">{{book.id}}</a></th>
            <td>{{book.name}}</td>
            <td>{{ book.author }}</td>
            <td>{{book.description}}</td>
            <td><img :src="'/photos/'+book.cover+'.jpg'" style="width: 50px; height: 70px;"/></td>
            <td>{{book.category}}</td>
        </tr>


        </tbody>
       <nav>
           <ul class="pagination">
               <li v-for="book in link_ar" @click.prevent="loadBooks(book.label)"><a class="page-link" v-bind:href="book.url">{{book.label}}</a></li>
           </ul>
       </nav>
    </table>
</template>

<script>
    import axios from 'axios';

    var page = 1;
    var sort='id';
    export default {
        name: "BookViewComponent",
        data() {
            return{
                books:null,
                link_ar:null,
                page:null,
                sort:null
            }
        },
        mounted(){
            this.loadBooks()
        },
        methods:{
            loadBooks(page){
                if(this.$route.query.sort){
                   sort=this.$route.query.sort;
                }

                axios.get('api/examples?sort='+sort+'&page='+page)
                .then(res => {
                    this.books=res.data.data;
                    this.link_ar = res.data.links;
                    this.page=page;
                    this.sort=sort;
                })
            },

        }
    }
</script>

<style scoped>

</style>
