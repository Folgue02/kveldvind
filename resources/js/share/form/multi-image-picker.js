(function() {
    const DATA_ATTR_MAX_FILES = 'data-max-files';
    const DATA_ATTR_MIN_FILES = 'data-min-files';
    const DATA_ATTR_VALUE     = 'data-input-value';
    const DATA_ATTR_NAME      = 'data-input-name';

    class MultiImagePicker {
        // Elements
        container;
        input;
        clearInput;
        previewsContainer;

        // Data
        name;
        value = [];
        maxFiles = 0;
        minFiles = 0;

        constructor(element) {
            this.container = element;
            this.input = this.container.querySelector('input[type=file]');
            this.clearInput = this.container.querySelector('input[type=hidden]');
            this.previewsContainer = this.container.querySelector('.image-previews');
            this.name = this.container.getAttribute(DATA_ATTR_NAME);
            this.maxFiles = this.container.getAttribute(DATA_ATTR_MAX_FILES);
            this.minFiles = this.container.getAttribute(DATA_ATTR_MIN_FILES);
            this.value = this.container.getAttribute(DATA_ATTR_VALUE)?.split(',');
        }

        static byInputName(name) {
            let element = document.querySelector(`.multi-image-picker-container[data-input-name=${name}]`);
            if (!element)
                throw Error('No multi-image-picker-container with input name "' + name + '" found.');

            return new MultiImagePicker(element);
        }

        clearImage(fileIndex) {
            const previewIndex = (this.input.files.length - 1) - fileIndex;
            this.previewsContainer.querySelectorAll('div.image-preview')[previewIndex].remove();

            const dataTransfer = new DataTransfer();
            [...this.input.files].forEach((f, i) => {
                if (i != fileIndex)
                    dataTransfer.add(f);
            });
            this.input.files = dataTransfer.files;
        }

        renderLastUploadedFile() {
            const file = this.input.files[this.input.files.length - 1];
            const divPreview = document.createElement('div');
            divPreview.classList.add('image-preview');

            const fileReader = new FileReader();
            fileReader.onload = onloadE => {
                divPreview.style.backgroundImage = `url(${onloadE.target.result})`;
            };
            fileReader.readAsDataURL(file);

            const closeBtnIcon = document.createElement('i');
            closeBtnIcon.classList.add('fa-solid', 'fa-xmark');

            const clearButton = document.createElement('button');
            clearButton.classList.add('clear-button');
            clearButton.setAttribute('type', 'button');
            clearButton.setAttribute(DATA_ATTR_NAME, this.name);
            clearButton.appendChild(closeBtnIcon);
            divPreview.appendChild(clearButton);

            this.previewsContainer.prepend(divPreview);

            // Event listener for the clear button
            clearButton.addEventListener('click', () => {
                const previewIndex = [...this.previewsContainer.querySelectorAll('div.image-preview')].indexOf(divPreview);

                // Mirror file and preview index
                const fileIndex = (this.input.files.length - 1) - previewIndex;
                this.clearImage(fileIndex);
            });
        }
    }

    document.querySelectorAll('.multi-image-picker-container').forEach(mipContainer => {
        // TODO: Load initial values
    });

    document.querySelectorAll('.multi-image-picker-container input[type=file]').forEach(mipInput => {
        mipInput.addEventListener('change', e => {
            let mip = MultiImagePicker.byInputName(e.currentTarget.name);
            mip.renderLastUploadedFile();
        });
    });
})();
