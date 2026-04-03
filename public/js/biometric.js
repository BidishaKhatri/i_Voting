// Get CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');   //JS selects the meta tag, actual token is inside the content

// Start webcam : Browser asks permission to access the webcam.
navigator.mediaDevices.getUserMedia({ video: true })    // JS requests camera access using navigator.mediaDevices.getUserMedia().
    .then(stream => {
        document.getElementById('video').srcObject = stream;     //Browser asks permission to access the webcam.
    });

function capture() {
    const canvas = document.getElementById('canvas');  //When the user clicks Verify Face, a frame from the video is captured using canvas
    const video = document.getElementById('video');    // The camera stream is shown inside a <video> element. 

    canvas.getContext('2d').drawImage(video, 0, 0, 400, 500);   //You take a frame from the video and draw it on a canvas
    const image = canvas.toDataURL("image/png");            //Then convert it to an image

        // Show snapshot in the <img>
    const img = document.getElementById('snapshot');
    img.src = image;
    img.style.display = 'block';

    fetch('/verify-face', {         // The image is sent to the Laravel backend with fetch().
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',   
            'X-CSRF-TOKEN': csrfToken               //laravel checks the token to make sure The request came from your website
        },
        body: JSON.stringify({ image: image })
    })
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
