const image = {

    getDimension: function (src) {

        var dimension,
            img = new Image();
        img.src = src;

        if (img.naturalWidth > img.naturalHeight) {
            dimension = 'landscape';
        } else if (img.naturalWidth < img.naturalHeight) {
            dimension = 'potrait';
        } else {
            dimension = 'square';
        }

        return dimension;
    }
}

export default image;
