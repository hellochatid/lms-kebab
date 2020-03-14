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
    }
}

export default quiz;
