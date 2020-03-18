export default {
    add(state, item) {
        const index = state.list.findIndex(data => parseInt(data.id) === parseInt(item.id));
        if (index === -1) {
            state.list.push(item);
        }
    },
    setAdminUser(state, authUser) {
        state.adminUser.token = authUser.token;
        state.adminUser.authenticated = authUser.authenticated;
    },
    setMemberUser(state, authUser) {
        state.memberUser.token = authUser.token;
        state.memberUser.authenticated = authUser.authenticated;
    },
    setAffiliateUser(state, authUser) {
        state.affiliateUser.token = authUser.token;
        state.affiliateUser.authenticated = authUser.authenticated;
    }
}
