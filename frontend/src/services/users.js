import auth from '~/services/auth';

const users = {
	accessToken: function () {
		const authAdmin = auth.user('admin');
		return authAdmin.token
	},
	isExist(nuxt) {
		const axios = nuxt.$axios;

		return new Promise(function (resolve, reject) {
			const email = nuxt.input.email;
			axios.get('/iam/is_user_exists?email=' + email)
				.then(function (response) {
					const resData = response.data;
					resolve(resData);
				})
				.catch(function (error) {
					reject(error);
				});
		})
	},
	registerExistingUser(nuxt, role) {
		const axios = nuxt.$axios;
		const input = nuxt.input;

		return new Promise(function (resolve, reject) {
			const credentials = {
				email: input.email,
				password: input.password,
				role: role,
			}
			axios.post('/iam/register_existing_user', credentials)
				.then(function (response) {
					const resData = response.data;
					resolve(resData);
				})
				.catch(function (error) {
					reject(error);
				});
		})
	},
	registerNewUser(nuxt, role) {
		const axios = nuxt.$axios;
		const input = nuxt.input;

		return new Promise(function (resolve, reject) {
			const credentials = {
				name: input.name,
				email: input.email,
				password: input.set_password,
				confirm_password: input.set_confirm_password,
				confirmation_url: process.env.APP_BASE_URL + '/verify-user',
				role: role,
			}
			axios.post('/iam/register', credentials)
				.then(function (response) {
					const resData = response.data;
					resolve(resData);
				})
				.catch(function (error) {
					reject(error);
				});
		})
	},
	verifyUser(nuxt, code) {
		const axios = nuxt.$axios;
		const self = this;

		console.log('code', code);
		console.log('rot13', self.rot13(code));

		return new Promise(function (resolve, reject) {
			const credentials = {
				verification_code: code,
			}
			axios.post('/iam/verify_user', credentials)
				.then(function (response) {
					const resData = response.data;
					resolve(resData);
				})
				.catch(function (error) {
					reject(error);
				});
		})
	},
	rot13(str) {
		var input     = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		var output    = 'NOPQRSTUVWXYZABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm';
		var index     = x => input.indexOf(x);
		var translate = x => index(x) > -1 ? output[index(x)] : x;
		return str.split('').map(translate).join('');
	  }
}

export default users;
