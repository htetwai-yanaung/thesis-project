$(document).ready(function () {
    // Get drop area
    const $dropArea = $('#drop-area');
    const $fileInput = $('#file-input');

    // Prevent default behavior
    $dropArea.on('dragenter dragover dragleave drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Highlight drop area when dragging over
    $dropArea.on('dragenter dragover', function () {
        $dropArea.addClass('highlight');
    });

    $dropArea.on('dragleave drop', function () {
        $dropArea.removeClass('highlight');
    });

    // Handle dropped files
    $dropArea.on('drop', function (e) {
        const files = e.originalEvent.dataTransfer.files;
        console.log(files);
        handleFiles(files);
    });

    // Handle selected files from file input
    $fileInput.on('change', function (e) {
        const files = e.target.files;
        handleFiles(files);
    });

    // Check if there are any files in the drop area
    function hasFiles() {
        return $fileInput[0].files.length > 1 || $('#file-list li').length > 1;
    }

    function handleFiles(files) {
        const $fileList = $('#file-list');
        $fileList.empty();
        const $preview1 = $('.preview-1');
        $preview1.hide();
        let $fileArr = [];

        // $fileInput[0].files = files;

        $.each(files, function (index, file) {
            const $listItem = $('<li>');
            $fileList.append($listItem);

            $fileArr.push(file)
            // Object.assign($fileInput[0].files, {'': file});

            // Check if the uploaded file is an image
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const $img = $('<img>');
                    $img.attr('src', event.target.result);
                    $img.attr('class', 'thumbnail');
                    $listItem.prepend($img);
                };
                reader.readAsDataURL(file);
            }

            // Add remove button
            const $removeBtn = $('<button>');
            $removeBtn.text('Remove');
            $removeBtn.addClass('remove-btn');
            $removeBtn.on('click', function () {
                $listItem.remove(); // Remove the list item when the button is clicked
                // Check if there are any files remaining
                console.log($fileInput)
                if (!hasFiles()) {
                    // Do something if there are no files remaining
                    console.log('No files remaining');
                    $fileInput.val('');
                    $preview1.show();
                }
            });
            $listItem.append($removeBtn);
        });
        // $fileInput[0].files = {...$fileArr};
        console.log({...$fileArr});
        console.log(files);
    }
});
