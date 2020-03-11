export default {
	add(state, { id, lesson_id, title, subtitle, description, content, image, pdf, audio, video, order }) {
		var material = {
			id: id,
			lesson_id: lesson_id,
			title: title,
			subtitle: subtitle,
			description: description,
			content: content,
			image: {
				name: image.name,
				url: image.url
			},
			pdf: {
				name: pdf.name,
				url: pdf.url
			},
			audio: {
				name: audio.name,
				url: audio.url
			},
			video: {
				name: video.name,
				url: video.url
			},
			order: order
		};
		state.list.push(material);
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
