export default {
    list(state) {
        return state.list
    },
    listById: (state) => (id) => {
        return state.list.filter(data => data.id === id)
    },
    listByLesson: (state) => (lessonId) => {
        const listByLesson = [];
        const items = state.list.filter(data => parseInt(data.lesson_id) === parseInt(lessonId))
        items.forEach(data => {
            var item = {
                id: data.id,
                title: data.title
            }
            listByLesson.push(item);
        });
        return listByLesson;
    },
}
