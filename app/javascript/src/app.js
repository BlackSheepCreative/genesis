const sliders = document.querySelector(".slider_list");
if (sliders) {
    let teamSlider = new Flickity(team, {
        cellAlign: "left",
        contain: true,
        watchCSS: true,
        imagesLoaded: true,
        adaptiveHeight: true,
        prevNextButtons: false
    });
}