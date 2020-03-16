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
	edit(state, item) {
		if (state.list.length > 0) {
			const index = state.list.findIndex(data => parseInt(data.id) === parseInt(item.id));
			if (index !== -1) {
				const material = state.list[index];
				material.id = item.id;
				material.lesson_id = item.lesson_id;
				material.title = item.title;
				material.subtitle = item.subtitle;
				material.description = item.description;
				material.content = item.content;
				material.image = item.image;
				material.pdf = item.pdf;
				material.audio = item.audio
				material.video = item.vide;
				material.order = item.order
			}
		}
	},
	remove(state, { id }) {
		const index = state.list.findIndex(data => parseInt(data.id) === parseInt(id));
		if (index !== -1) state.list.splice(index, 1);
	}
}
