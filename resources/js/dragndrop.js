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
