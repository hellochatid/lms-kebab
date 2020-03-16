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
	edit(state, item) {
		if (state.list.length > 0) {
			const index = state.list.findIndex(data => parseInt(data.id) === parseInt(item.id));
			const quiz = state.list[index];
			if (index !== -1) {
				quiz.id = item.id;
				quiz.lesson_id = item.lesson_id;
				quiz.question = item.question;
				quiz.order = item.order;
				quiz.answers = item.answers;
			}
		}
	},
	remove(state, { id }) {
		const index = state.list.findIndex(data => parseInt(data.id) === parseInt(id));
		if (index !== -1) state.list.splice(index, 1);
	}
}
