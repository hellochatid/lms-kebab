export default {
	add(state, { id, title, subtitle, category, description, image, tag }) {
		var course = {
			id: id,
			title: title,
			subtitle: subtitle,
			category: { id: category.id, name: category.name },
			description: description,
			image: { name: image.name, url: image.url },
			tag: tag
		}
		state.list.push(course);
	},
	edit(state, { id, title, subtitle, description, image, tag }) {
		if (state.list.length > 0) {
			const index = state.list.findIndex(c => parseInt(c.id) === parseInt(id));
			const course = state.list[index];
			if (index !== -1) {
				course.title = title;
				course.subtitle = subtitle;
				course.description = description;
				course.image.name = image.name;
				course.image.url = image.url;
				course.tag = tag;
			}
		}
	},
	remove(state, { id }) {
		const index = state.list.findIndex(c => parseInt(c.id) === parseInt(id));
		if (index !== -1) state.list.splice(index, 1);
	}
}
