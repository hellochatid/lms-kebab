export default {
    list(state) {
        return state.list
    },
    listById: (state) => (id) => {
        return state.list.filter(data => data.id === id)
    },
    listItems: (state) => (courseId) => {
        const listItems = [];
        const items = state.list.filter(data => parseInt(data.course_id) === parseInt(courseId))
        items.forEach(data => {
            var item = {
                id: data.id,
                name: data.title,
                materials: [
                    {
                        id: 1,
                        title: "aaaaaaa"
                    },
                ],
                quiz: [
                    {
                        id: 1,
                        title: "aaaaaaa"
                    },
                ]
            }
            listItems.push(item);
        });
        return listItems;
    },
}
