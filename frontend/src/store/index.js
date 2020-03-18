const cookieparser = process.server ? require('cookieparser') : undefined

export const actions = {
    nuxtServerInit({ commit }, { req }) {
        const initUser = { authenticated: false };
        let authAdmin = Object.assign({}, initUser);
        let authMember = Object.assign({}, initUser);
        let authAffiliate = Object.assign({}, initUser);
        if (req.headers.cookie) {
            const parsed = cookieparser.parse(req.headers.cookie)
            try {
                authAdmin = JSON.parse(parsed.authAdmin);
                authMember = JSON.parse(parsed.authMember);
                authAffiliate = JSON.parse(parsed.authAffiliate);
            } catch (err) {
                // No valid cookie found
            }
        }
        commit("users/setAdminUser", authAdmin);
        commit("users/setMemberUser", authMember);
        commit("users/setAffiliateUser", authAffiliate);
    }
}
