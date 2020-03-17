const sliders = document.querySelector(".slider_list");
if (sliders) {
    let homeslider = new Flickity(sliders, {
        cellAlign: "left",
        contain: true,
        imagesLoaded: true,
        adaptiveHeight: true,
        prevNextButtons: false,
        wraparound: true
    });
}
