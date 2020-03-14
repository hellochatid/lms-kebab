export default {
	add(state, item) {
		const quiz = {
			id: item.id,
			lesson_id: item.lesson_id,
			question: item.question,
			order: item.order,
			answers: item.answers
		}
		state.list.push(quiz);
	},
	edit(state, { id, course_id, title, subtitle, description, image, tag, order }) {
		if (state.list.length > 0) {
			const index = state.list.findIndex(data => parseInt(data.id) === parseInt(id));
			const lesson = state.list[index];
			if (index !== -1) {
				lesson.course_id = course_id;
				lesson.title = title;
				lesson.subtitle = subtitle;
				lesson.description = description;
				lesson.image.name = image.name;
				lesson.image.url = image.url;
				lesson.tag = tag;
				lesson.order = order;
			}
		}
	},
	remove(state, { id }) {
		const index = state.list.findIndex(data => parseInt(data.id) === parseInt(id));
		if (index !== -1) state.list.splice(index, 1);
	}
}
