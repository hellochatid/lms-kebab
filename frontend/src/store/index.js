const cookieparser = process.server ? require('cookieparser') : undefined

export const actions = {
    nuxtServerInit({ commit }, { req }) {
        let authAdmin = {
            authenticated: false
        };
        if (req.headers.cookie) {
            const parsed = cookieparser.parse(req.headers.cookie)
            try {
                authAdmin = JSON.parse(parsed.authAdmin)
            } catch (err) {
                // No valid cookie found
            }
        }
        commit("users/setUserAdmin", authAdmin);
    }
}
