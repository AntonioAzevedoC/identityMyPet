'use strict';

const inp = document.getElementById('file');
const img = document.getElementById('output');

const showImage = function() {
    if (this.files && this.files[0]) {
        let file = new FileReader();
        file.onload = function(e) {
            img.src = e.target.result;
        };       
        file.readAsDataURL(this.files[0]);
    }
}

inp.addEventListener("change", showImage, false);