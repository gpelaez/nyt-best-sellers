const baseUrl = '/api/1/nyt/best-sellers';
export default class RestApiClient {
    bestSellerBooks(filter = []) {
        return axios
            .get(baseUrl)
    }
}