import img from "~/libs/image";

export default {
	add(state, { id, course_id, title, subtitle, description, image, tag, order }) {
		var lesson = {
            id: id,
            course_id: course_id,
            title: title,
            subtitle: subtitle,
            description: description,
            tag: tag,
			image: { 
				name: image.name,
				url: image.url,
				dimension: img.getDimension(image.url)
			 },
            order: order
		}
		state.list.push(lesson);
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
				lesson.image.dimension = img.getDimension(image.url);
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
