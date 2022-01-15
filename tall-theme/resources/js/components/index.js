import tallFlatPickr from "./tall-flat-pickr";


window.tallFlatPickr = tallFlatPickr


document.addEventListener('alpine:init', () => {
    window.Alpine.data('tallFlatPickr', tallFlatPickr)
})