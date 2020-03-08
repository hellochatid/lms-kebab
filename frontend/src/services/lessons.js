import auth from '~/services/auth';

const lessons = {
	accessToken: function () {
		const authAdmin = auth.admin();
		return authAdmin.token
	},
	get: function (nuxt) {
		const self = this;
		const axios = nuxt.$axios;

		return new Promise(function (resolve, reject) {
			var lessons = nuxt.$store.getters["lessons/list"];
			if (lessons.length > 0) return resolve(lessons);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.get('/admin/lessons', axios.defaults.headers.common)
				.then(async function (response) {
					lessons = response.data.data;
					await lessons.forEach(async (data) => {
						var lesson = {
							id: data.id,
							course_id: data.course.id,
							title: data.title,
							subtitle: data.subtitle,
							description: data.description,
							image: {
								name: data.image.name,
								url: data.image.url
							},
							tag: data.tag,
							order: data.order
						};
						nuxt.$store.commit("lessons/add", lesson);
					});
					resolve(lessons);
				})
				.catch(function (error) {
					reject(error);
				})
		});
	},
	add: function (nuxt, input) {
		const self = this;
		const axios = nuxt.$axios;
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.post('/admin/lessons', input, axios.defaults.headers.common)
				.then(function (response) {
					const data = response.data.data;
					const lesson = {
						id: data.id,
						course_id: data.course_id,
						title: data.title,
						subtitle: data.subtitle,
						description: data.description,
						image: {
							name: data.image.name,
							url: data.image.url
						},
						tag: data.tag,
						order: data.order
					};
					var lessons = nuxt.$store.getters["lessons/list"];
					if (lessons.length > 0) nuxt.$store.commit("lessons/add", lesson);
					resolve(lesson);
				})
				.catch(function (error) {
					console.log('error', error)
					reject(error);
				})
		})
	},
	setOrder: function (nuxt, input) {
		const self = this;
		const axios = nuxt.$axios;
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.post('/admin/lessons/orders', input, axios.defaults.headers.common)
				.then(function (response) {
					const data = response.data.data;
					const lesson = {
						id: data.id,
						course_id: data.course_id,
						title: data.title,
						subtitle: data.subtitle,
						description: data.description,
						image: {
							name: data.image.name,
							url: data.image.url
						},
						tag: data.tag,
						order: data.order
					};
					resolve(lesson);
				})
				.catch(function (error) {
					console.log('error', error)
					reject(error);
				})
		})
	},
}

export default lessons;
