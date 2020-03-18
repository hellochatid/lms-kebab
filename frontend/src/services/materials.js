import auth from '~/services/auth';

const materials = {
	accessToken: function () {
		const authAdmin = auth.user('admin');
		return authAdmin.token
	},
	get: function (nuxt) {
		const self = this;
		const axios = nuxt.$axios;

		return new Promise(function (resolve, reject) {
			var materials = nuxt.$store.getters["materials/list"];
			if (materials.length > 0) return resolve(materials);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.get('/admin/materials', axios.defaults.headers.common)
				.then(async function (response) {
					materials = response.data.data;
					await materials.forEach(async (data) => {
						var material = {
							id: data.id,
							lesson_id: data.lesson_id,
							title: data.title,
							subtitle: data.subtitle,
							description: data.description,
							content: data.content,
							image: {
								name: data.image.name,
								url: data.image.url
							},
							pdf: {
								name: data.pdf.name,
								url: data.pdf.url
							},
							audio: {
								name: data.audio.name,
								url: data.audio.url
							},
							video: {
								name: data.video.name,
								url: data.video.url
							},
							order: data.order
						};
						nuxt.$store.commit("materials/add", material);
					});
					resolve(materials);
				})
				.catch(function (error) {
					reject(error);
				})
		});
	},
	getById: async function (nuxt, id) {
		const self = this;
		const axios = nuxt.$axios;
		const materials = nuxt.$store.getters["materials/list"];
		const material = materials.find(c => c.id === parseInt(id));

		return new Promise(function (resolve, reject) {
			if (typeof material !== "undefined") return resolve(material);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken();
			axios.get('/admin/materials?id=' + id, axios.defaults.headers.common)
				.then(function (response) {
					var material = response.data.data.length > 0 ? response.data.data[0] : null;
					resolve(material);
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
			axios.post('/admin/materials', input, axios.defaults.headers.common)
				.then(function (response) {
					const data = response.data.data;
					const material = {
						id: data.id,
						lesson_id: data.lesson_id,
						title: data.title,
						subtitle: data.subtitle,
						description: data.description,
						content: data.content,
						image: {
							name: data.image.name,
							url: data.image.url
						},
						pdf: {
							name: data.pdf.name,
							url: data.pdf.url
						},
						audio: {
							name: data.audio.name,
							url: data.audio.url
						},
						video: {
							name: data.video.name,
							url: data.video.url
						},
						order: data.order
					};
					var materials = nuxt.$store.getters["materials/list"];
					if (materials.length > 0) nuxt.$store.commit("materials/add", material);
					resolve(material);
				})
				.catch(function (error) {
					console.log(error)
					reject(error);
				})
		})
	},
	edit: function (nuxt, id) {
		const self = this;
		const axios = nuxt.$axios;
		return new Promise(function (resolve, reject) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
			axios.patch('/admin/materials/' + id, nuxt.input, axios.defaults.headers.common)
				.then(function (response) {
					// update store
					const data = response.data.data;
					var material = {
						id: data.id,
						lesson_id: data.lesson_id,
						title: data.title,
						subtitle: data.subtitle,
						description: data.description,
						content: data.content,
						image: {
							name: data.image.name,
							url: data.image.url
						},
						pdf: {
							name: data.pdf.name,
							url: data.pdf.url
						},
						audio: {
							name: data.audio.name,
							url: data.audio.url
						},
						video: {
							name: data.video.name,
							url: data.video.url
						},
						order: data.order
					};

					nuxt.$store.commit("materials/edit", material);
					resolve(material);
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
			axios.delete('/admin/materials/' + id, axios.defaults.headers.common)
				.then(function () {
					nuxt.$store.commit("materials/remove", { id });
					resolve(id);
				})
				.catch(function (error) {
					reject(error);
				})
		})
	}
}

export default materials;
