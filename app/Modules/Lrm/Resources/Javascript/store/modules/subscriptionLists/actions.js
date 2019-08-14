import * as types from "../../mutation-types"

export default {
    deleteOneSubscriptionList ({ commit }, id) {
        return window.axios.delete("/api/subscription-lists/" + id)
            .then(response => {
                const r = response.data.data
                commit(types.SUBSCRIPTION_LISTS_DELETE_ONE, r)
                return r
            })
            .catch(error => {
                console.log(error)
                commit(types.SUBSCRIPTION_LISTS_ERROR, error)
                return error
            })
    },

    fetchAllSubscriptionLists ({ commit }) {
        return window.axios.get("/api/subscription-lists")
            .then(response => {
                const all = response.data.data
                commit(types.SUBSCRIPTION_LISTS_FETCH_ALL, all)
                return all
            })
            .catch(error => {
                console.log(error)
                commit(types.SUBSCRIPTION_LISTS_ERROR, error)
                return error
            })
    },

    fetchOneSubscriptionList ({ commit }, id) {
        return window.axios.get("/api/subscription-lists/" + id)
            .then(response => {
                const one = response.data
                commit(types.SUBSCRIPTION_LISTS_FETCH_ONE, one)
                return one
            })
            .catch(error => {
                commit(types.SUBSCRIPTION_LISTS_ERROR, error)
                return error
            })
    },

    reset ({ commit }) {
        commit(types.SUBSCRIPTION_LISTS_RESET)
        return null
    }
}
