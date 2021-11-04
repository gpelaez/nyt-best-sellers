<template>
    <div class="container">
        <div class="row">
            <a @click="$router.go(-1)">back</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{book.title}}</div>

                    <div class="card-body">
                        <ul>
                            <li v-for="(info, key) in book" :key="key">
                                <b>{{key}}:</b><br>
                                <span>{{info}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const baseUrl = '/api/1/nyt/best-sellers';

    export default {
        data() {
            return {
                book: null,
            }
        },
        methods: {
            loadBookData(isbn) {
                var _this = this;
                axios.get(baseUrl, {
                    params: {
                        isbn: [isbn],
                    }
                })
                .then(function (response) {
                    // handle success
                    console.log(response.data);
                    _this.book = response.data.results[0];
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            }
        },
        mounted() {
            this.loadBookData(this.$route.params.isbn);
        }
    }
</script>
