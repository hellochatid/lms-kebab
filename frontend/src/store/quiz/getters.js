export default {
    list(state) {
        return state.list
    },
    listById: (state) => (id) => {
        return state.list.filter(data => data.id === id)
    },
    listByLesson: (state) => (lessonId) => {
        return state.list.filter(data => parseInt(data.lesson_id) === parseInt(lessonId))
    },
}
