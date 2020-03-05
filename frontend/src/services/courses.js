import auth from '~/services/auth'

const courses = {
	accessToken: function () {
		const authAdmin = auth.admin();
		return authAdmin.token
	},
	get: async function (axios) {
		const self = this
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.get('/admin/courses', axios.defaults.headers.common)
				.then(function (response) {
					resolve(response.data);
				})
				.catch(function (error) {
					reject(error);
				})
		})

	},
	getById: async function (axios, id) {
		const self = this
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.get('/admin/courses?id=' + id, axios.defaults.headers.common)
				.then(function (response) {
					var course = response.data.data.length > 0 ? response.data.data[0] : null;
					resolve(course);
				})
				.catch(function (error) {
					reject(error);
				})
		})

	},
	add: function (axios, input) {
		const self = this
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.post('/admin/courses', input, axios.defaults.headers.common)
				.then(function (response) {
					resolve(response.data);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	},
	edit: function (axios, input, id) {
		const self = this
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.patch('/admin/courses/' + id, input, axios.defaults.headers.common)
				.then(function (response) {
					resolve(response.data);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	},
	delete: function (axios, id) {
		const self = this
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.delete('/admin/courses/' + id, axios.defaults.headers.common)
				.then(function (response) {
					resolve(response.data);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	},
	uploadFile: function (axios, file) {
		const self = this
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.post('/upload', file, axios.defaults.headers.common)
				.then(function (response) {
					resolve(response.data);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	}
}

export default courses;
