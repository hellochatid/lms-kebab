import auth from '~/services/auth';
import materials from '~/services/materials';
import quiz from '~/services/quiz';

const lessons = {
	accessToken: function () {
		const authAdmin = auth.user('admin');
		return authAdmin.token
	},
	get: function (nuxt, courseId) {
		const self = this;
		const axios = nuxt.$axios;
		const apiUrl = typeof (courseId) !== 'undefined' ? '/admin/lessons?course=' + courseId : '/admin/lessons';

		return new Promise(async function (resolve, reject) {
			// get materials
			await materials.get(nuxt)

			// get quiz
			await quiz.get(nuxt)

			// get lessons
			var lessons = typeof (courseId) !== 'undefined' ? nuxt.$store.getters["lessons/listByCourse"](courseId) : nuxt.$store.getters["lessons/list"];
			if (lessons.length > 0) return resolve(lessons);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.get(apiUrl, axios.defaults.headers.common)
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
	getById: async function (nuxt, id) {
		const self = this;
		const axios = nuxt.$axios;
		const lessons = nuxt.$store.getters["lessons/list"];
		const course = lessons.find(c => c.id === parseInt(id));

		return new Promise(function (resolve, reject) {
			if (typeof course !== "undefined") return resolve(course);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken();
			axios.get('/admin/lessons?id=' + id, axios.defaults.headers.common)
				.then(function (response) {
					var course = response.data.data.length > 0 ? response.data.data[0] : null;
					resolve(course);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	},
	getByCourse: function (nuxt, courseId) {
		const self = this;

		return new Promise(function (resolve) {
			var lessonsByCourse = nuxt.$store.getters["lessons/listByCourse"](courseId);
			if (lessonsByCourse.length > 0) {
				return resolve(lessonsByCourse);
			}

			self.get(nuxt, courseId)
				.then(function () {
					lessonsByCourse = nuxt.$store.getters["lessons/listByCourse"](courseId);
					resolve(lessonsByCourse)
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
					reject(error);
				})
		})
	},
	edit: function (nuxt, id) {
		const self = this;
		const axios = nuxt.$axios;

		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.patch('/admin/lessons/' + id, nuxt.input, axios.defaults.headers.common)
				.then(function (response) {
					// update store
					const data = response.data.data;
					var lesson = {
						id: id,
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
					nuxt.$store.commit("lessons/edit", lesson);
					resolve(lesson);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	},
	setOrders: function (nuxt, input) {
		const self = this;
		const axios = nuxt.$axios;
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.post('/admin/lessons/orders', { order: input }, axios.defaults.headers.common)
				.then(function (response) {
					const data = response.data.data;
					resolve(data);
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
			axios.delete('/admin/lessons/' + id, axios.defaults.headers.common)
				.then(function () {
					nuxt.$store.commit("lessons/remove", { id });
					resolve(id);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	}
}

export default lessons;
