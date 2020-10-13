
class PostHandler {
    constructor (url, data) {
        this.url = url;
        this.data = data;
        this.method = 'POST'
    }

    _send () {
        this.xhr = new XMLHttpRequest();
        this.xhr.open(this.method, this.url, true);
        // this.xhr.setRequestHeader('Content-Type', 'text/html');
        this.xhr.setRequestHeader('X-Content-Id', this.data);

        this.xhr.send(0);
    }

    start () {
        this._send();
    }
}

const media = document.querySelector('video');
let realView = false;

media.addEventListener('timeupdate', checkTime);

function checkTime() {

    if (media.currentTime >= 10 && !realView) {
        const url = media.id.toString().substring(4);
        realView = true;
        // Ajax call to update view count.
        const post = new PostHandler('/watch/view', url);
        post.start();
    }
}

const gallery = document.getElementsByClassName('video__link');
let nextContainer = gallery[0];
nextContainer.setAttribute('id', 'up-next');

media.addEventListener('ended', function(event) {

    if (gallery.length > 0) {
        const next = gallery[0].getAttribute('href');
        console.log(next);
        window.open(next, "_self");
    }
    else {
        media.play();
    }
});
document.addEventListener('DOMContentLoaded', function () {
    let allVideos = document.getElementsByClassName('media');
    const totalVideos = allVideos.length;


    console.log(allVideos);
    const numberVisible = 5;
    const forwardButton = document.getElementById('forward');
    const backButton = document.getElementById('back');
    let visibleStart = 0;
    let visibleStop = numberVisible;

    for (let i = 0; i < totalVideos; i++) {
        allVideos[i].className = 'media';
    }

    for (let i = visibleStop; i < totalVideos; i++) {
        allVideos[i].setAttribute('class', 'media hidden_item');
    }

    forwardButton.addEventListener('click', function () {
        console.log(visibleStart);
        console.log(visibleStop);
        if (visibleStop === totalVideos) {
            visibleStop = 0;
            allVideos[visibleStop].className = 'media';
            allVideos[visibleStart].className = 'media hidden_item';
            visibleStart++;
            visibleStop++;
        }
        else if (visibleStart === totalVideos) {
            visibleStart = 0;
            allVideos[visibleStop].className = 'media';
            allVideos[visibleStart].className = 'media hidden_item';
            visibleStart++;
            visibleStop++;
        }
        else {
            allVideos[visibleStart].className = 'media hidden_item';
            allVideos[visibleStop].className = 'media';
            visibleStart++;
            visibleStop++;
        }

    });

});

