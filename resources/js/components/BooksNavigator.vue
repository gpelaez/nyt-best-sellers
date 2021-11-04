
<template>
    <div class="container">
        <div class="row">
            <form v-on:submit.prevent>
            <div class="form-group">
                <label for="inputAuthor">Author</label>
                <input v-model="author" type="text" class="form-control" id="inputAuthor" aria-describedby="Author Input" placeholder="Enter author">
            </div>
            <div class="form-group">
                <label for="titleInput">Title</label>
                <input v-model="title" type="text" class="form-control" id="titleInput" placeholder="Book Title">
            </div>
            <div class="form-group">
                <label for="isbnInput">Isbn</label>
                <input v-model="isbn" type="text" class="form-control" id="titleInput" placeholder="Book Isbn">
            </div>
            <button type="submit" class="btn btn-primary" v-on:click="loadBooksData()">Submit</button>
            </form>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3" v-for="(book, key) in books" :key="key">
                <div class="card" >
                    <div class="card-header">{{book.title}}</div>
                    <div class="card-body">
                        <ul>
                            <li>
                                Author: {{ book.author }}
                            </li>
                            <li>
                                {{ book.author }}
                            </li>
                            <li v-if="book.isbns[0]">
                                ISBN10: {{ book.isbns[0].isbn10 }} <br>
                                ISBN13: {{ book.isbns[0].isbn13 }} <br>
                            </li>
                            <li v-if="book.isbns[0]">
                                <router-link :to="{
                                    path: '/book/' + book.isbns[0].isbn10,
                                }">View details</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <nav aria-label="Books page navigation">
                <ul class="pagination">
                    <li v-if="page > 1" v-on:click="loadPage(page - 1)" class="page-item"><a class="page-link" v-on:click="loadPage(page - 1)">Previous</a></li>
                    <li v-for="index in pagesCount" :key="index" class="page-item" v-bind:class="{ active: index == page }">
                        <a class="page-link" v-on:click="loadPage(index)">{{ index }}</a>
                    </li>
                    <li  v-if="page < pagesCount" class="page-item"><a class="page-link" v-on:click="loadPage(page + 1)">Next</a></li>
                </ul>
            </nav>

        </div>
    </div>
</template>

<script>
    const baseUrl = '/api/1/nyt/best-sellers';

    export default {
        data() {
            return {
                author: '',
                isbn: '',
                title: '',
                page: localStorage.getItem('page') || 1,
                pagesCount: 0,
                books: []
            }
        },
        methods: {
            loadBooksData() {
                var offset = (parseInt(this.page) -1) * 20;
                var payload = {};
                if (this.isbn) {
                    payload.isbn = [this.isbn];
                }
                if (this.author) {
                    payload.author = this.author;
                }
                if (this.title) {
                    payload.title = this.title;
                }
                payload.offset = offset;

                var _this = this;
                axios.get(baseUrl, {
                    params: payload
                })
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    _this.pagesCount = Math.ceil(response.data.num_results / 20);
                    if (response.data.num_results == 0 && _this.page > 1) {
                        _this.loadPage(1);
                        return;
                    }
                    if (_this.pagesCount < _this.page) {
                        _this.page = _this.pagesCount;
                        localStorage.setItem('page', _this.page);
                    }
                    _this.books = response.data.results;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            loadPage(page) {
                if(page !== this.page) {
                    localStorage.setItem('page', page);
                    this.page = page;
                    this.loadBooksData();
                }
            },
        },
        mounted() {
            console.log('Component mounted.')
            this.loadBooksData();  
        },

    }
</script>
