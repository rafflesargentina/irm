import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState()
{
    return {
        all: [],
        allPending: true,
        one: {
            address: {},
            addresses: [],
            company: {},
            company_id: "",
            email: "",
            first_name: "",
            fax: "",
            featured_address: {},
            featured_photo: [],
            last_name: "",
            map: {},
            mobile: "",
            phone: "",
            photos: [],
            position: "",
            unfeatured_address: {},
            unfeatured_photos: [],
            slug: "",
            subscription_lists: [],
            user_id: "",
            website: "",
        },
        onePending: true,
    }
}

const state = {
    initialState: initialState(),
    ...initialState()
}

export default {
    actions,
    getters,
    mutations,
    state
}
