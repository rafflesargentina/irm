import * as types from "../../mutation-types"
import { initialState } from "./countries"

export default {
    [types.COUNTRIES_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    },

    [types.COUNTRIES_FETCH_ALL] (state, payload) {
        state.all = payload
    },
}
