import * as types from "../../mutation-types"

export default {
    fetchAllCountries ({ commit }) {
        return window.axios.get("/api/countries")
            .then(response => {
                const all = response.data.data
                commit(types.COUNTRIES_FETCH_ALL, all)
                return all
            })
            .catch(error => {
                console.log(error)
                commit(types.COUNTRIES_ERROR, error)
                return error
            })
    }
}
