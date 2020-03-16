import auth from '~/services/auth';

const quiz = {
    accessToken: function () {
        const authAdmin = auth.admin();
        return authAdmin.token
    },
    get: function (nuxt, lessonId = null) {
        const self = this;
        const axios = nuxt.$axios;
        const apiUrl = lessonId !== null ? '/admin/quiz?lesson=' + lessonId : '/admin/quiz';

        return new Promise(async function (resolve, reject) {
            const quiz = lessonId !== null ? nuxt.$store.getters["quiz/listByLesson"](lessonId) : nuxt.$store.getters["quiz/list"];
            if (quiz.length > 0) return resolve(quiz);

            axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
            axios.get(apiUrl, axios.defaults.headers.common)
                .then(async function (response) {
                    const resData = response.data.data;
                    var items = [];
                    await resData.forEach(async (data) => {
                        var item = {
                            id: data.question.id,
                            lesson_id: data.lesson_id,
                            question: data.question.value,
                            order: data.question.order,
                            answers: data.answers
                        }
                        items.push(item);
                        nuxt.$store.commit("quiz/add", item);
                    });
                    resolve(items);
                }
                )
                .catch(function (error) {
                    reject(error);
                })
        });
    },
    getById: async function (nuxt, id) {
        const self = this;
        const axios = nuxt.$axios;
        const questions = nuxt.$store.getters["quiz/list"];
        const question = questions.find(c => c.id === parseInt(id));

        return new Promise(function (resolve, reject) {
            if (typeof question !== "undefined") return resolve(question);

            axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken();
            axios.get('/admin/quiz?id=' + id, axios.defaults.headers.common)
                .then(function (response) {
                    var dtQuestion = response.data.data.length > 0 ? response.data.data[0] : null;
                    var item = {
                        answers: [],
                        id: '',
                        lesson_id: '',
                        order: '',
                        question: '',
                    }
                    if (dtQuestion !== null) {
                        item = {
                            answers: dtQuestion.answers,
                            id: dtQuestion.question.id,
                            lesson_id: dtQuestion.lesson_id,
                            order: dtQuestion.question.order,
                            question: dtQuestion.question.value,
                        }
                    }
                    resolve(item);
                })
                .catch(function (error) {
                    reject(error);
                })
        })
    },
    add(nuxt, input) {
        const self = this;
        const axios = nuxt.$axios;
        return new Promise(function (resolve, reject) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
            axios.post('/admin/quiz', input, axios.defaults.headers.common)
                .then(function (response) {
                    const data = response.data.data;
                    const item = {
                        id: data.question.id,
                        lesson_id: data.lesson_id,
                        question: data.question.value,
                        order: data.question.order,
                        answers: data.answers
                    }
                    nuxt.$store.commit("quiz/add", item);
                    resolve(item);
                })
                .catch(function (error) {
                    console.log(error)

                })
        })
    },
    edit: function (nuxt, id) {
        const self = this;
        const axios = nuxt.$axios;
        return new Promise(function (resolve, reject) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + self.accessToken()
            axios.patch('/admin/quiz/' + id, nuxt.input, axios.defaults.headers.common)
                .then(function (response) {
                    // update store
                    const data = response.data.data;
                    const item = {
                        id: data.question.id,
                        lesson_id: data.lesson_id,
                        question: data.question.value,
                        order: data.question.order,
                        answers: data.answers
                    }
                    nuxt.$store.commit("quiz/edit", item);
                    resolve(item);
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
            axios.delete('/admin/questions/' + id, axios.defaults.headers.common)
                .then(function () {
                    nuxt.$store.commit("quiz/remove", { id });
                    resolve(id);
                })
                .catch(function (error) {
                    reject(error);
                })
        })
    }
}

export default quiz;
