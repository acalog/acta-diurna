const isAdvancedUpload = function () {
    const div = document.createElement('div');
    return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}();

const test_progress = function (response) {
    console.log(response);
    if (!document.getElementById(response.file)){
        const $resultsContainer = $('div.upload-results-container');
        const $resultsItem = $('<div class="upload-results-item"></div>');
        const $thumbnail = $('<img alt="prev-thumbnail">');
        $resultsItem.attr('id', response.file);
        $thumbnail.attr('src', response.url)
        $resultsItem.append($thumbnail);
        $resultsContainer.append($resultsItem);
    }
}

// Run when the page loads.
document.addEventListener('DOMContentLoaded', function () {
    // Upload form element

    addListeners();
    let $form = $('form.box');
    console.log($form);
    let $updatePodcastForm = $('form#update-podcast');
    let $boxUpdateThumbnail = $('.box#update-thumbnail');
    // console.log($boxUpdateThumbnail);
    // File input element
    let $input = $form.find('input[type="file"]');
    // File input (vanilla)
    let $file_input = document.getElementById('thumbnailFile');
    let $input2 = $("form#update-podcast input[type='file']");
    // console.log($input2);
    let uploadingDisplay = $('#upload-display');
    let uploadsResultsContainer = $('.upload-results-container');
    if (isAdvancedUpload) {
        $form.addClass('has-advanced-upload');
        $boxUpdateThumbnail.addClass('has-advanced-upload');
        console.log('Drag n\' drop enabled.');
    }

    if (isAdvancedUpload) {
        let droppedFiles = false;
        let uploaders = [];
        $form.on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
        })
        .on('dragover dragenter', function () {
                $form.addClass('is-dragover');
        })
        .on('dragleave dragend drop', function () {
                $form.removeClass('is-dragover');
        })
        .on('drop', function (e) {
            // When drag n drop is supported.
            droppedFiles = e.originalEvent.dataTransfer.files;
            // Trigger submit form.
            // console.log($form)
            // $form.trigger('submit');

            // console.log($form.find('input#file.box-file'));
            $inputBoxFile = $form.find('#file');
            console.log($inputBoxFile);
            console.log($('#file'));
            $inputBoxFile.prop('files', droppedFiles);
            $form.trigger('submit');
        });
        /*
        $form.on('submit', function (e) {
            console.log('Submitting Create New Images Form.');
            console.log('Adding to Uploader');
            uploadingDisplay.addClass('working');
            uploadsResultsContainer.addClass('working');
            if (droppedFiles) {
                if (droppedFiles.length === 1) {
                    let uploader = new ChunkedUploader(droppedFiles[0], $form, test_progress);
                    uploader.start();
                    e.preventDefault();
                } else {
                    $.each(droppedFiles, function (i, file) {
                        let uploader = new ChunkedUploader(file, $form, test_progress);
                        uploader.start();
                        e.preventDefault();
                    });
                }
            } else {}
        });

         */
        $boxUpdateThumbnail.on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
        })
            .on('dragover dragenter', function () {
                $boxUpdateThumbnail.addClass('is-dragover');
            })
            .on('dragleave dragend drop', function () {
                $boxUpdateThumbnail.removeClass('is-dragover');
            })
            .on('drop', function (e) { // When drag n drop is supported.
                droppedFiles = e.originalEvent.dataTransfer.files;
                // Trigger submit form.
                console.log('Triggering form submit');
                $updatePodcastForm.trigger('submit');
            });
        $updatePodcastForm.on('submit', function (e) {
            console.log('Submitting Update Podcast Form.');
            console.log('Adding to Uploader');
            uploadingDisplay.addClass('working');
            uploadsResultsContainer.addClass('working');
            if (droppedFiles) {
                if (droppedFiles.length === 1) {
                    if (droppedFiles[0].size <= 1500000) {
                        $input2.prop("files", droppedFiles);
                    }
                    else {
                        let uploader = new ChunkedUploader(droppedFiles[0], $updatePodcastForm, test_progress);
                        uploader.start();
                        e.preventDefault();
                    }
                } else {
                    $.each(droppedFiles, function (i, file) {
                        console.log('Chunked multiple', i);
                        let uploader = new ChunkedUploader(file, $updatePodcastForm, test_progress);
                        uploader.start();
                        e.preventDefault();
                    });
                }
            } else {}
        });



    }
});

const dragList = [];
let dragStartIndex;

function dragStart() {
    dragStartIndex = +this.closest("div.edit-image-container").getAttribute("data-index");

}

function dragEnter() {
    this.classList.add("over");

}

function dragLeave() {
    this.classList.remove("over");

}

function dragOver(e) {
    e.preventDefault(); // dragDrop is not executed otherwise
}

function dragDrop() {
    const dragEndIndex = +this.closest("div.edit-image-container").getAttribute("data-index");
    // swap
    this.classList.remove("over");
    // console.log(this);
    swap(dragStartIndex, dragEndIndex);
    saveSwap(dragStartIndex, dragEndIndex);
}

function saveSwap(item1, item2) {
    const img1 = dragList[item1].querySelector('img').getAttribute('data-img-id');
    const img2 = dragList[item2].querySelector('img').getAttribute('data-img-id');
    const post = new PostHandler('/swap', 'sort', 'GET');
    post.setHeader('X-Img-One', img1);
    post.setHeader('X-Img-Two', img2);
    post.start();

}

function addListeners() {
    const draggables = document.querySelectorAll(".edit-image-container");
    const dragListItems = document.querySelectorAll(".edit-image-inner-container");


    draggables.forEach((draggable, index) => {
        draggable.setAttribute("data-index", index);
        draggable.addEventListener("dragstart", dragStart);
        dragList.push(draggable);
    });

    dragListItems.forEach((item) => {
        item.addEventListener("dragover", dragOver);
        item.addEventListener("drop", dragDrop);
        item.addEventListener("dragenter", dragEnter);
        item.addEventListener("dragleave", dragLeave);
    });
}

function swap(item1, item2) {

    console.log(dragList[item1].querySelector('div.edit-image-form-container'));
    console.log(dragList[item1].querySelector('form'));
    const form1 = dragList[item1].querySelector('form');
    const form2 = dragList[item2].querySelector('form');

    const img1 = dragList[item1].querySelector('img');
    const img2 = dragList[item2].querySelector('img');
    // console.log(dragList[item1].closest('div.edit-image-img'));
    // console.log(dragList[item1].childNodes);
    console.log(img1, img2);
    let temp = img1.getAttribute('src');
    img1.setAttribute('src', img2.getAttribute('src'));
    img2.setAttribute('src', temp);

    temp = form1.getAttribute('action');
    form1.setAttribute('action', form2.getAttribute('action'));
    form2.setAttribute('action', temp);

    const captionInput1 = dragList[item1].querySelector('div.edit-image-input-container input');
    const captionInput2 = dragList[item2].querySelector('div.edit-image-input-container input');

    console.log(captionInput1, captionInput2);

    let tempInput = captionInput1.getAttribute('value');
    captionInput1.setAttribute('value', captionInput2.getAttribute('value'));
    captionInput2.setAttribute('value', tempInput);

    console.log(captionInput1, captionInput2);


}

document.addEventListener('DOMContentLoaded', function () {

    addListeners()

})


class ChunkedUploader {
    constructor (file, form, progressHandler) {
        if (!this instanceof ChunkedUploader) {
            return new ChunkedUploader(file, form, progressHandler);
        }

        // const dt = Date.now().toString().substring(6);

        this.file = file;
        this.url = form.attr('action');
        this.type = form.attr('method');
        this.form = form;
        this.fileSize = this.file.size;
        this.fileType = this.file.type;
        this.chunkSize = (1024 * 1024); //
        this.rangeStart = 0;
        this.rangeEnd = this.chunkSize;
        this.chunksQuantity = Math.ceil(this.fileSize / this.chunkSize);
        this.chunksQueue = new Array(this.chunksQuantity).fill().map((_, index) => index).reverse();

        this._get_slice_method();
        this._progress_handler = progressHandler;

    }

    _get_slice_method () {
        if ('mozSlice' in this.file) {
            this.slice_method = 'mozSlice';
        }
        else if ('webkitSlice' in this.file) {
            this.slice_method = 'webkitSlice';
        }
        else {
            this.slice_method = 'slice';
        }

    }

    _sendNext () {
        if (!this.chunksQueue.length) {
            this.form.removeClass('is-uploading');
            $('#upload-display').removeClass('working');
            return;
        }
        const chunkId = this.chunksQueue.pop();
        this.rangeStart = chunkId * this.chunkSize;
        this.rangeEnd = this.rangeStart+this.chunkSize;

        // Prevent range overflow
        if (this.rangeEnd > this.fileSize) {
            this.rangeEnd = this.fileSize;
        }

        // Get chunk to send
        const chunk = this.file[this.slice_method](this.rangeStart, this.rangeEnd);

        // Package chunk and formData for upload method.
        let formData = new FormData(this.form.get(0));
        formData.append('file', chunk);
        this._upload(formData, chunkId)
            .then(() => {
                this._sendNext();
            })
            .catch(() => {
                this.chunksQueue.push();
            });
    }

    _upload (formData, chunkId) {
        return new Promise((resolve, reject) => {
            /* AJAX Request Object */
            this.upload_request = new XMLHttpRequest();

            this.upload_request.open(this.type, this.url, true);

            this.upload_request.overrideMimeType('application/octet-stream');


            this.upload_request.setRequestHeader('Content-Range', 'bytes ' + this.rangeStart + '-' + this.rangeEnd + '/' + this.fileSize);
            this.upload_request.setRequestHeader('Content-Disposition', `${chunkId}:${this.file.name}-${this.fileType}-${this.fileSize}`);

            this.upload_request.onreadystatechange = () => {
                if (this.upload_request.readyState === 4 && this.upload_request.status === 200) {
                    const response = JSON.parse(this.upload_request.responseText);
                    // ChunkedUploader._progress_handler(response);
                    this._progress_handler(response);
                    resolve();
                }
            };
            this.upload_request.onerror = reject;
            this.upload_request.send(formData);
        });


    }

    /* Public Functions */
    start () {
        this._sendNext();
    }
}

function processEvent(evt) {
    let logMessage = `${evt.type}: ${evt.loaded} bytes transferred`;
    console.log(logMessage);
}


class PostHandler {
    constructor (url, data='', method='POST') {
        this.url = url;
        this.data = data;
        this.method = method;
        this.xhr = new XMLHttpRequest();
        this.xhr.open(this.method, this.url, true);
    }

    _send () {
        
        
        // this.xhr.setRequestHeader('Content-Type', 'text/html');
        

        this.xhr.send(0);
    }

    setHeader(header, value) {
        this.xhr.setRequestHeader(header, value);
    }

    start () {
        this._send();
    }
}

$(function () {
    let upWidget = $('#up');

    upWidget.on('click', function (e) {
        $(this).addClass('hidden');
    });

    $(window).scroll(function () {
        upWidget.removeClass('hidden');
        clearTimeout($.data(this, 'scrollTimer'));
        $.data(this, 'scrollTimer', setTimeout(function () {
            upWidget.addClass('hidden');
        }, 3000));
    });

    console.log("PageUp Widget enabled");
});

document.addEventListener('DOMContentLoaded', function () {
    let navs = document.querySelectorAll('.nav-link');
    let displays = document.querySelectorAll('.form-wrapper');
    if (navs && displays) {
        console.log('Options Display widget enabled.');
    }
    navs.forEach(function (nav) {
        // nav.classList.remove('nav__active');
        nav.addEventListener('click', function (e) {
            navs.forEach(function (nav) {
                nav.classList.remove('nav-active');
            });
            nav.classList.add('nav-active');
            let displayTarget = e.target.getAttribute('id').split('-')[1];

            displays.forEach(function (display) {
                display.setAttribute('class', 'form-wrapper');
                if (display.getAttribute('id').split('-')[1] === displayTarget) {
                    display.classList.add('active');
                }
            });
        });
    });
});
