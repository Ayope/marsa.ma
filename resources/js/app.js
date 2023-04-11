import './bootstrap';

if (window.location.pathname === '/register') {

    const image = document.getElementById('image');
    const imgInput = document.getElementById('imgInput')

    image.addEventListener('click', function(){
        imgInput.click()
    })

    // Add a change event listener to the input
    imgInput.addEventListener('change', function() {
        // Get the selected file from the input
        const file = imgInput.files[0];

        // Create a new FileReader object
        const reader = new FileReader();

        // Set the onload function of the reader
        reader.onload = function() {
        // Set the source of the image to the data URL
        image.src = reader.result;
        }

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
    });

}
