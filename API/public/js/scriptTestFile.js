    // function previewAudio() {
//     const fileInput = document.getElementById('audioFileInput');
//     const audioPreview = document.getElementById('audioPreview');

//     if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
//         console.error('No file selected or file input element not found.');
//         audioPreview.innerHTML = '<p>No file selected</p>';
//         return;
//     }

//     const file = fileInput.files[0];
//     console.log('Selected file:', file);

//     const reader = new FileReader();
//     reader.onload = function (event) {
//         const audio = new Audio();
//         audio.src = event.target.result;
//         audio.controls = true;
//         audio.play();
//         audioPreview.innerHTML = '';
//         audioPreview.appendChild(audio);
//     };
//     reader.onerror = function (event) {
//         console.error('File reading error:', event.target.error);
//         audioPreview.innerHTML = '<p>Error reading file</p>';
//     };
//     reader.readAsDataURL(file);
// }
