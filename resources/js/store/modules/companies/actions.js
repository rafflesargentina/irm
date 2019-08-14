import * as types from "../../mutation-types"

export default {
    deleteOneCompany ({ commit }, id) {
        return window.axios.delete("/api/companies/" + id)
            .then(response => {
                const r = response.data.data
                commit(types.COMPANIES_DELETE_ONE, r)
                return r
            })
            .catch(error => {
                console.error(error)
                commit(types.COMPANIES_ERROR, error)
                return error
            })
    },

    fetchAllCompanies ({ commit }) {
        commit(types.COMPANIES_FETCH_ALL_PENDING, true)
        return window.axios.get("/api/companies")
            .then(response => {
                const all = response.data.data
                commit(types.COMPANIES_FETCH_ALL, all)
                commit(types.COMPANIES_FETCH_ALL_PENDING, false)
                return all
            })
            .catch(error => {
                console.error(error)
                commit(types.COMPANIES_ERROR, error)
                commit(types.COMPANIES_FETCH_ALL_PENDING, false)
                return error
            })
    },

    fetchOneCompany ({ commit }, id) {
        commit(types.COMPANIES_FETCH_ONE_PENDING, true)
        return window.axios.get("/api/companies/" + id)
            .then(response => {
                const one = response.data
                commit(types.COMPANIES_FETCH_ONE, one)
                commit(types.COMPANIES_FETCH_ONE_PENDING, false)
                return one
            })
            .catch(error => {
                commit(types.COMPANIES_ERROR, error)
                commit(types.COMPANIES_FETCH_ONE_PENDING, false)
                return error
            })
    },

    reset ({ commit }) {
        commit(types.COMPANIES_RESET)
        return null
    }
}
