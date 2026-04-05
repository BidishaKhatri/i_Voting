// Selects the <meta> tag in your Blade layout that stores the CSRF token and reads its content.
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');   //JS selects the meta tag, actual token is inside the content

// Start webcam : Browser asks permission to access the webcam.
navigator.mediaDevices.getUserMedia({ video: true })    // JS requests camera access using navigator.mediaDevices.getUserMedia().
    .then(stream => {
        document.getElementById('video').srcObject = stream;    //displays live feed
    });

function capture() {    //Triggered when Verify Face button is clicked.
    const canvas = document.getElementById('canvas');  //a frame from the video is captured using canvas
    const video = document.getElementById('video');    // current live camera feed 

    const context = canvas.getContext('2d');    //prepares 2D drawing on canvas.

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    context.drawImage(video, 0, 0, canvas.width, canvas.height);    //captures a single frame from the video stream.
    const image = canvas.toDataURL("image/png");            //Then convert it to base64 image(string format)

    const messageEl = document.getElementById('message');
    messageEl.textContent = '⏳ Verifying...';
    messageEl.style.color = 'black';

    fetch('/verify-face', {         // The image is sent to the Laravel backend with fetch().
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',     //tells server it’s JSON.
            'X-CSRF-TOKEN': csrfToken               //ensures request is secure and comes from your site.
        },
        body: JSON.stringify({ image: image })      //converts JS object to JSON for server.
    })

    //Handle server response
    .then(res => res.json())
    .then(data => {
        const messageEl = document.getElementById('message');
        if(data.status === 'verified') {
            messageEl.textContent = '✅ Face verified!';
            messageEl.style.color = 'green';

        setTimeout(() => {
                window.location.href = '/candidates';
            }, 1000);
        } else {
            messageEl.textContent = '❌ Face verification failed!';
            messageEl.style.color = 'red';
        }
    });
}
