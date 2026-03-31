/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
//=========image Preview============//
const fileImage = document.querySelector('.input-preview__src');
const filePreview = document.querySelector('.input-preview');

fileImage.onchange = function () {
    const reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        filePreview.style.backgroundImage  = "url("+e.target.result+")";
        filePreview.classList.add("has-image");
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};


//==========Delete Alart============//
function confirm_delete_backend(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $('#delete_form_' + id).submit();
        }
    })
}
