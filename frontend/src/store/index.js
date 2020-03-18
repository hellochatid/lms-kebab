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
                // set auth admin
                authAdmin = JSON.parse(parsed.authAdmin);
                commit("users/setAdminUser", authAdmin);

                // set auth member
                authMember = JSON.parse(parsed.authMember);
                commit("users/setMemberUser", authMember);

                // set auth affiliate
                authAffiliate = JSON.parse(parsed.authAffiliate);
                commit("users/setAffiliateUser", authAffiliate);
            } catch (err) {
                // No valid cookie found
            }
        }
    }
}
