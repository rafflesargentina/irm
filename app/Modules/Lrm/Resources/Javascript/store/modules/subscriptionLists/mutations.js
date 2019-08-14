import * as types from "../../mutation-types"
import { initialState } from "./subscriptionLists"

export default {
    [types.SUBSCRIPTION_LISTS_DELETE_ONE] () {},

    [types.SUBSCRIPTION_LISTS_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    },

    [types.SUBSCRIPTION_LISTS_FETCH_ALL] (state, payload) {
        state.all = payload
    },

    [types.SUBSCRIPTION_LISTS_FETCH_ONE] (state, payload) {
        state.one = Object.freeze(payload)
    },

    [types.SUBSCRIPTION_LISTS_RESET] (state) {
        Object.assign(state, { initialState: initialState(), ...initialState() })
    }
}
