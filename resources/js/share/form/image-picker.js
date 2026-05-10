(function() {
    const DATA_ATTR_NAME = 'data-input-name';
    const DATA_ATTR_VALUE = 'data-input-value';

    /**
     * Loads an image by the value attribute (DATA_ATTR_VALUE). This only affects the visuals
     * of the image picker, the input will stay empty.
     *
     * @param {object} ipContainer Image picker container used to access the rest of elements.
     */
    function loadImageByValue(ipContainer) {
        const imageUrl = ipContainer.getAttribute('data-input-value');
        const ipClearButton = ipContainer.querySelector('.image-picker-clear');
        const ipFilename = ipContainer.querySelector('.image-picker-file-name');
        const ipIcon = ipContainer.querySelector('.image-picker-icon');
        const ipLabel = ipContainer.querySelector('label');
        const ipRemoveImageFlag = ipContainer.querySelector('input.image-picker-remove-flag');


        ipClearButton.style.display = 'block';

        const sections = imageUrl.split(/\//g);
        ipFilename.textContent = sections.length == 0 ? '' : sections[sections.length - 1];
        ipIcon.style.display = 'none';
        ipLabel.style.backgroundImage = `url(${imageUrl})`;
        ipRemoveImageFlag.value = 0;
    }

    /**
     * Loads an image into the image picker, this only affects the picker visually, since
     * the image is loaded naturally by the input.
     *
     * @param {object} imageInput File input element
     */
    function loadImageByInput(imageInput) {
        const file = imageInput.files[0];

        if (file) {
            const imagePickerContainer = document.querySelector(`.image-picker-container[${DATA_ATTR_NAME}=${imageInput.name}]`);
            const label = imagePickerContainer.querySelector('label');
            const ipFilename = imagePickerContainer.querySelector('.image-picker-file-name');
            const clearButton = imagePickerContainer.querySelector('button.image-picker-clear');
            const icon = imagePickerContainer.querySelector('label .image-picker-icon');
            const ipRemoveImageFlag = imagePickerContainer.querySelector('input.image-picker-remove-flag');

            const reader = new FileReader();
            reader.onload = onloadE => {
                label.style.backgroundImage = `url(${onloadE.target.result})`;
                ipFilename.textContent = file.name;
                clearButton.style.display = 'block';
                icon.style.display = 'none';
                ipRemoveImageFlag.value = 0;
            };
            reader.readAsDataURL(file);
        }
    }

    /**
     * Unloads the file from the image picker, effectively resettings its state.
     *
     * @param {object} imageInputClear Element of the clear button pressed by the user.
     */
    function unloadFile(imageInputClear) {
            const imagePickerContainer = document.querySelector(`.image-picker-container[${DATA_ATTR_NAME}=${imageInputClear.getAttribute(DATA_ATTR_NAME)}]`);
            const imagePickerLabel = imagePickerContainer.querySelector('label');
            const imageInput = imagePickerContainer.querySelector('input[type=file].image-input');
            const imagePickerFilename = imagePickerContainer.querySelector(`.image-picker-file-name`);
            const imagePickerIcon = imagePickerContainer.querySelector('.image-picker-icon');
            const ipRemoveImageFlag = imagePickerContainer.querySelector('input.image-picker-remove-flag');

            imageInputClear.style.display = 'none';
            imagePickerLabel.style.backgroundImage = '';
            imageInput.value = null;
            imagePickerFilename.textContent = 'No file selected.';
            imagePickerIcon.style.display = 'block';
            ipRemoveImageFlag.value = 1;
    }

    document.querySelectorAll('.image-picker-container .image-input').forEach(imagePickerInput => {
        imagePickerInput.addEventListener('change', e => loadImageByInput(e.target));
    });

    document.querySelectorAll('.image-picker-container button.image-picker-clear').forEach(element => {
        element.addEventListener('click', e => unloadFile(e.currentTarget));
    });

    document.querySelectorAll('.image-picker-container[data-input-value]')
        .forEach(element => loadImageByValue(element));
})();
