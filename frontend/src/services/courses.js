import auth from '~/services/auth'

const courses = {
	accessToken: function () {
		const authAdmin = auth.admin();
		return authAdmin.token
	},
	get: async function (nuxt) {
		const self = this;
		const axios = nuxt.$axios;

		return new Promise(function (resolve, reject) {
			var courses = nuxt.$store.getters["courses/list"];
			if (courses.length > 0) return resolve(courses);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.get('/admin/courses', axios.defaults.headers.common)
				.then(async function (response) {
					courses = response.data.data;

					await courses.forEach(async (data) => {
						var course = {
							id: data.id,
							title: data.title,
							subtitle: data.subtitle,
							category: {
								id: data.category.id,
								name: data.category.name
							},
							description: data.description,
							image: {
								name: data.image.name,
								url: data.image.url
							},
							tag: data.tag
						};
						nuxt.$store.commit("courses/add", course);
					});
					resolve(courses);
				})
				.catch(function (error) {
					reject(error);
				})
		})

	},
	getById: async function (nuxt, id) {
		const self = this;
		const axios = nuxt.$axios;
		const courses = nuxt.$store.getters["courses/list"];
		const course = courses.find(c => c.id === parseInt(id));

		return new Promise(function (resolve, reject) {
			if (typeof course !== "undefined") return resolve(course);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken();
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
	add: function (nuxt, input) {
		const self = this;
		const axios = nuxt.$axios;
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.post('/admin/courses', input, axios.defaults.headers.common)
				.then(function (response) {
					const data = response.data.data;
					const course = {
						id: data.id,
						title: data.title,
						subtitle: data.subtitle,
						category: {
							id: data.category.id,
							name: data.category.name
						},
						description: data.description,
						image: {
							name: data.image.name,
							url: data.image.url
						},
						tag: data.tag
					};
					var courses = nuxt.$store.getters["courses/list"];
					if (courses.length > 0) nuxt.$store.commit("courses/add", course);
					resolve(course);
				})
				.catch(function (error) {
					console.log('error', error)
					reject(error);
				})
		})
	},
	edit: function (nuxt, id) {
		const self = this;
		const axios = nuxt.$axios;

		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.patch('/admin/courses/' + id, nuxt.input, axios.defaults.headers.common)
				.then(function (response) {
					// update store
					const data = response.data.data;
					const course = {
						id: id,
						title: data.title,
						subtitle: data.subtitle,
						description: data.description,
						image: { name: data.image.name, url: data.image.url },
						tag: data.tag
					}
					nuxt.$store.commit("courses/edit", course);
					resolve(response.data);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	},
	delete: function (nuxt, id) {
		const self = this;
		const axios = nuxt.$axios;
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.delete('/admin/courses/' + id, axios.defaults.headers.common)
				.then(function (response) {
					nuxt.$store.commit("courses/remove", { id });
					resolve(response.data);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	}
}

export default courses;
