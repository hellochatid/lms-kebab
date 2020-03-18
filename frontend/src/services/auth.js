const Cookie = process.client ? require("js-cookie") : undefined;
const jwt = require('jsonwebtoken');

const auth = {
	user: function (role) {
		const userCookie = Cookie.get(this.store(role).cookie);
		const authUser = JSON.parse(userCookie);
		const userId = jwt.decode(authUser.token).id;
		const auth = Object.assign({ id: userId }, authUser);
		return auth;
	},
	store(role) {
		var userState, userCookie;
		switch (role) {
			case 'admin':
				userState = 'users/setAdminUser';
				userCookie = 'authAdmin';
				break;
			case 'member':
				userState = 'users/setMemberUser';
				userCookie = 'authMember';
				break;
			case 'affiliate':
				userState = 'users/setAffiliateUser';
				userCookie = 'authAffiliate';
				break;
		}
		const store = {
			state: userState,
			cookie: userCookie,
		}
		return store;
	},
	login(nuxt, role) {
		const self = this;
		const axios = nuxt.$axios;

		return new Promise(function (resolve, reject) {
			const credentials = {
				password: nuxt.input.password,
				email: nuxt.input.email
			}
			axios.post("/iam/login/" + role, credentials)
				.then(async res => {
					if (typeof res.data.success !== "undefined" && !res.data.success) {
						const loginStatus = {
							'success': false,
							'data': {
								'message': res.data.message
							}
						}
						resolve(loginStatus);
					} else {
						// Get user detail
						const user = await self.getAuthUser(axios, res.data.access_token);

						// Save user to store
						const userStore = self.store(role);
						const userState = userStore.state;
						const userCookie = userStore.cookie;

						const authUser = {
							token: res.data.access_token,
							authenticated: true
						};

						nuxt.$store.commit('users/add', user);
						nuxt.$store.commit(userState, authUser);
						Cookie.set(userCookie, authUser);

						resolve(authUser);
					}
				})
				.catch(function (error) {
					reject(error);
				})
		});
	},
	logout(nuxt, role) {
		const self = this;
		return new Promise(function (resolve, reject) {
			try {
				const auth = { authenticated: false };
				Cookie.remove(self.store(role).cookie);
				nuxt.$store.commit(self.store(role).state, auth);
				resolve({ success: true });
			}
			catch (err) {
				reject(err);
			}
		});
	},
	getAuthUser(axios, token) {
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
			axios.get('/iam/me', axios.defaults.headers.common)
				.then(function (response) {
					const resData = response.data.data;
					resolve(resData);
				})
				.catch(function (error) {
					reject(error);
				});
		})
	},
	me(nuxt, role) {
		const self = this;
		return new Promise(async function (resolve, reject) {
			const authUser = self.user(role);
			const userList = nuxt.$store.getters['users/list'];
			const index = userList.findIndex(data => parseInt(data.id) === parseInt(authUser.id));

			var user = {}
			if (index !== -1) {
				user = userList[index];
				resolve(user);
			}

			user = await self.getAuthUser(nuxt.$axios, authUser.token);
			nuxt.$store.commit('users/add', user);

			resolve(user);
		})
	}
}

export default auth;
