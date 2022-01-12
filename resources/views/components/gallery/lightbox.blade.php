<x-layout>


<style>
    /* stylelint-disable sh-waqar/declaration-use-variable */
    .dialog {
        --min-button-size: 44px;
        bottom: 0;
        display: flex;
        left: 0;
        position: fixed;
        right: 0;
        top: 0;
    }
    .dialog[aria-hidden="true"] {
        display: none;
    }
    .dialog:fullscreen .dialog__fullscreen {
        background-color: currentColor;
        mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M15.984 8.016h3v1.969h-4.969V5.016h1.969v3zm-1.968 10.968v-4.969h4.969v1.969h-3v3h-1.969zm-6-10.968v-3h1.969v4.969H5.016V8.016h3zm-3 7.968v-1.969h4.969v4.969H8.016v-3h-3z'/%3E%3C/svg%3E");
    }
    .dialog__overlay {
        animation: fade-in 200ms both;
        background-color: rgba(0, 0, 0, 0.9);
        bottom: 0;
        left: 0;
        position: fixed;
        right: 0;
        top: 0;
    }
    .dialog__content {
        animation: fade-in 400ms 200ms both;
        color: #fff;
        display: flex;
        width: 100%;
    }
    .dialog__region {
        -webkit-overflow-scrolling: touch;
        /* Lets it scroll lazy */
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        width: 100%;
    }
    .dialog__region:focus {
        outline: 4px solid #fff;
        outline-offset: -6px;
    }
    .dialog__images {
        display: flex;
        height: 100%;
        margin: auto;
        padding: 0;
        width: 100%;
    }
    .dialog__images-item {
        align-items: center;
        display: flex;
        flex: 0 0 100%;
        justify-content: center;
        scroll-snap-align: center;
    }
    .dialog__images-item figure {
        margin: 0;
    }
    .dialog__images-item img {
        height: auto;
        max-height: 80vh;
        max-width: 100%;
        vertical-align: middle;
        width: auto;
    }
    .dialog__controls {
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
    }
    .dialog__control {
        appearance: none;
        border: 1px solid transparent;
        color: #fff;
        display: flex;
        mask-position: center;
        mask-repeat: no-repeat;
        mask-size: 2rem;
        min-height: var(--min-button-size);
        min-width: var(--min-button-size);
        opacity: 0.5;
        padding: 0;
        position: fixed;
        transition-duration: 200ms;
        transition-property: border-color, opacity;
    }
    .dialog__control:hover, .dialog__control:focus {
        border-color: #fff;
        opacity: 1;
    }
    .dialog__close {
        background-color: currentColor;
        mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M18.984 6.422L13.406 12l5.578 5.578-1.406 1.406L12 13.406l-5.578 5.578-1.406-1.406L10.594 12 5.016 6.422l1.406-1.406L12 10.594l5.578-5.578z'/%3E%3C/svg%3E");
        right: var(--min-button-size);
        top: 0;
    }
    .dialog__fullscreen {
        background-color: currentColor;
        mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M14.016 5.016h4.969v4.969h-1.969v-3h-3V5.016zm3 12v-3h1.969v4.969h-4.969v-1.969h3zm-12-7.032V5.015h4.969v1.969h-3v3H5.016zm1.968 4.032v3h3v1.969H5.015v-4.969h1.969z'/%3E%3C/svg%3E");
        right: 0;
        top: 0;
    }
    .dialog__previous {
        background-color: currentColor;
        left: 0;
        mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M15.422 16.594L14.016 18l-6-6 6-6 1.406 1.406L10.828 12z'/%3E%3C/svg%3E");
        top: 50%;
        transform: translateY(-50%);
    }
    .dialog__next {
        background-color: currentColor;
        mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M8.578 16.594L13.172 12 8.578 7.406 9.984 6l6 6-6 6z'/%3E%3C/svg%3E");
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }
    .dialog__counter {
        align-items: center;
        color: #fff;
        display: flex;
        justify-content: center;
        left: 0;
        line-height: 1;
        min-height: var(--min-button-size);
        min-width: var(--min-button-size);
        opacity: 0.5;
        padding: 0.5em;
        position: absolute;
        top: 0;
        white-space: nowrap;
    }
    .dialog__announce {
        border: 0;
        clip: rect(1px, 1px, 1px, 1px);
        clip-path: inset(50%);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
        word-wrap: normal !important;
    }
    @keyframes fade-in {
        from {
            opacity: 0;
        }
    }
    @keyframes scale-up {
        from {
            transform: scale(0.5);
        }
    }
    img {
        height: auto;
        max-width: 100%;
    }
    .blocks-gallery-grid, .wp-block-gallery {
        display: flex;
        flex-wrap: wrap;
        list-style-type: none;
        padding: 0;
        margin: 0;
        gap: 2rem;
    }
    .blocks-gallery-item {
        flex-basis: 20rem;
    }
    .blocks-gallery-item figure {
        margin: 0;
    }

</style>

<figure class="wp-block-gallery">
    <ul class="blocks-gallery-grid">
        <li class="blocks-gallery-item">
            <figure>
                <a href="https://picsum.photos/id/1002">
                    <img loading="lazy" src="https://picsum.photos/id/1002/2000/2000" alt="A shoreline from high above">
                </a>
                <figcaption class="blocks-gallery-item__caption">Shoreline from high above. By NASA.</figcaption>
            </figure>
        </li>
        <li class="blocks-gallery-item">
            <figure>
                <a href="https://picsum.photos/id/1041">
                    <img loading="lazy" src="https://picsum.photos/id/1041/2000/2000" alt="Waves crashing">
                </a>
                <figcaption class="blocks-gallery-item__caption">Waves for potentially good surfing.</figcaption>
            </figure>
        </li>
        <li class="blocks-gallery-item">
            <figure>
                <a href="https://picsum.photos/id/1069">
                    <img loading="lazy" src="https://picsum.photos/id/1069/2000/2000" alt="An orange jellyfish in the water.">
                </a>
                <figcaption class="blocks-gallery-item__caption">Orange jellyfish swim in the ocean.</figcaption>
            </figure>
        </li>
        <li class="blocks-gallery-item">
            <figure>
                <a href="https://picsum.photos/id/1074">
                    <img loading="lazy" src="https://picsum.photos/id/1074/2000/2000" alt="A female lion looking at the camera.">
                </a>
                <figcaption class="blocks-gallery-item__caption">A female lion looks at the camera.</figcaption>
            </figure>
        </li>
        <li class="blocks-gallery-item">
            <figure>
                <a href="https://picsum.photos/id/1080">
                    <img loading="lazy" src="https://picsum.photos/id/1080/2000/2000" alt="Fresh strawberries.">
                </a>
                <figcaption class="blocks-gallery-item__caption">Fresh strawberries.</figcaption>
            </figure>
        </li>
        <li class="blocks-gallery-item">
            <figure>
                <a href="https://picsum.photos/id/167">
                    <img loading="lazy" src="https://picsum.photos/id/167/2000/2000" alt="Leaves on the ground">
                </a>
                <figcaption class="blocks-gallery-item__caption">Leaves on the ground.</figcaption>
            </figure>
        </li>
    </ul>
</figure>


<script>
    /* eslint-disable @wordpress/no-global-event-listener */
    /* eslint-disable @wordpress/no-global-active-element */
    class A11yGallery {
        constructor(element, options = {}) {
            if (!element) {
                return;
            }

            // Bindings
            this.hide = this.hide.bind(this);
            this.show = this.show.bind(this);
            this.fullscreen = this.fullscreen.bind(this);

            // Elements
            this.$current = null;
            this.$dialog = null;
            this.$galleryElement = element;
            this.$galleryImages = Array.from(element.querySelectorAll('img'));
            this.$dialogItems = null;
            this.$dialogImages = null;
            this.$previouslyFocused = null;
            this.$dialogRegion = null;

            // Data
            this.shown = false;
            this._listeners = {};
            this._observer = null;

            // Defaults
            const defaults = {
                id: `gallery-${Date.now()}`,
                title: 'My Gallery',

                close: 'Close this modal',
                fullscreen: 'Toggle fullscreen',
                previous: 'Go to previous item',
                next: 'Go to next item',
            };

            // Settings
            this.settings = { ...defaults, ...options };

            // Initialise everything needed for the dialog to work properly
            this.create();
        }

        /**
         * Debounce functions for better performance
         * (c) 2018 Chris Ferdinandi, MIT License, https://gomakethings.com
         *
         * @param  {Function} fn The function to debounce
         * @return {Function} The debounced function.
         */
        _debounce(fn) {
            // Setup a timer
            let timeout;

            // Return a function to run debounced
            return function () {
                // Setup the arguments
                const context = this;
                // eslint-disable-next-line prefer-rest-params
                const args = arguments;

                // If there's a timer, cancel it
                if (timeout) {
                    window.cancelAnimationFrame(timeout);
                }

                // Setup the new requestAnimationFrame()
                timeout = window.requestAnimationFrame(function () {
                    fn.apply(context, args);
                });
            };
        }

        /**
         * Register a new callback for the given event type
         *
         * @param {string} type
         * @param {Function} handler
         * @return {Object} instance
         */
        on(type, handler) {
            if (typeof this._listeners[type] === 'undefined') {
                this._listeners[type] = [];
            }

            this._listeners[type].push(handler);

            return this;
        }

        /**
         * Unregister an existing callback for the given event type
         *
         * @param {string} type
         * @param {Function} handler
         * @return {Object} instance
         */
        off(type, handler) {
            const index = (this._listeners[type] || []).indexOf(handler);

            if (index > -1) {
                this._listeners[type].splice(index, 1);
            }

            return this;
        }

        /**
         * Iterate over all registered handlers for given type and call them all with
         * the dialog element as first argument, event as second argument (if any).
         *
         * @access private
         * @param {string} type The event type.
         * @param {Event} event The event object.
         */
        _fire(type, event) {
            console.log(type);
            const listeners = this._listeners[type] || [];

            listeners.forEach(
                function (listener) {
                    listener(this.$galleryElement, event);
                }.bind(this),
            );
        }

        _createControl(key) {
            const control = document.createElement('button');
            control.classList.add(`dialog__${key}`);
            control.classList.add('dialog__control');
            control.setAttribute('type', 'button');
            control.setAttribute('aria-label', this.settings[key]);

            return control;
        }

        _createControls() {
            const dialogControls = document.createElement('div');
            dialogControls.classList.add('dialog__controls');
            const contolKeys = ['close', 'fullscreen', 'previous', 'next'];

            contolKeys.forEach((key) => {
                const control = this._createControl(key);
                dialogControls.appendChild(control);
            });

            this.$dialogControls = dialogControls;
        }

        _createCarousel() {
            const list = this.$galleryElement.querySelector('ul').cloneNode(true);
            list.removeAttribute('class');
            list.classList.add('dialog__images');
            this.$dialogImages = list;

            const items = list.querySelectorAll('li');
            items.forEach((item) => {
                item.removeAttribute('class');
                item.classList.add('dialog__images-item');
            });
            this.$dialogItems = Array.from(items);
        }

        _createDialog() {
            const dialog = document.createElement('div');
            dialog.classList.add('dialog');
            dialog.setAttribute('id', this.settings.id);
            dialog.setAttribute('aria-hidden', true);

            const dialogOverlay = document.createElement('div');
            dialogOverlay.classList.add('dialog__overlay');
            dialogOverlay.setAttribute('tabindex', -1);

            const dialogContent = document.createElement('div');
            dialogContent.classList.add('dialog__content');
            dialogContent.setAttribute('role', 'dialog');
            dialogContent.setAttribute('aria-label', this.settings.title);
            this.$dialogContent = dialogContent;

            const dialogRegion = document.createElement('div');
            dialogRegion.classList.add('dialog__region');
            dialogRegion.setAttribute('role', 'region');
            dialogRegion.setAttribute('tabindex', 0);
            dialogRegion.setAttribute('aria-label', 'gallery');
            this.$dialogRegion = dialogRegion;

            // Live region for page update
            const dialogAnnounce = document.createElement('div');
            dialogAnnounce.classList.add('dialog__announce');
            dialogAnnounce.setAttribute('aria-live', 'polite');
            this.$dialogAnnouce = dialogAnnounce;

            const dialogCounter = document.createElement('span');
            dialogCounter.classList.add('dialog__counter');
            dialogCounter.setAttribute('aria-hidden', true);
            this.$dialogCounter = dialogCounter;

            // Create controls
            this._createControls();
            const controls = this.$dialogControls;

            // Create carousel
            this._createCarousel();
            const dialogImages = this.$dialogImages;

            // Append all the things
            dialogRegion.appendChild(dialogImages);
            dialogContent.appendChild(dialogCounter);
            dialogContent.appendChild(controls);
            dialogContent.appendChild(dialogRegion);
            dialog.appendChild(dialogAnnounce);
            dialog.appendChild(dialogOverlay);
            dialog.appendChild(dialogContent);

            this.$dialog = dialog;
            this.$galleryElement.appendChild(dialog);
        }

        create() {
            // Create the dialog
            this._createDialog();

            this.$galleryImages.forEach((image) => {
                let target;

                if (image.parentElement.matches('a')) {
                    target = image.parentElement;
                } else {
                    target = image;
                }

                target?.addEventListener('click', this.show.bind(this));
            });

            // Execute all callbacks registered for the `create` event
            this._fire('create');

            return this;
        }

        destroy() {
            this.hide();

            this.$galleryImages.forEach((image) => {
                let target;

                if (image.parentElement.matches('a')) {
                    target = image.parentElement;
                } else {
                    target = image;
                }

                target?.removeEventListener('click', this.show);
            });

            this.$dialog.remove();

            // Execute all callbacks registered for the `destroy` event
            this._fire('destroy');

            // Keep an object of listener types mapped to callback functions
            this._listeners = {};

            return this;
        }

        show(event) {
            // If the dialog is already open, abort
            if (this.shown) {
                return this;
            }

            event.stopPropagation();
            event.preventDefault();

            const { target } = event;
            const gallery = target.closest('ul');
            const galleryItem = target.closest('li');
            const galleryItems = Array.from(gallery.querySelectorAll('li'));
            const galleryItemIndex = galleryItems.indexOf(galleryItem);
            const item = this.$dialogItems[galleryItemIndex];

            // Keep a reference to the currently focused element to be able to restore
            // it later
            this.$previouslyFocused = document.activeElement;
            this.$dialog.removeAttribute('aria-hidden');
            this._scroll(item);
            this.shown = true;

            this._bind();
            this._connectObservers();

            this.$dialog.querySelector('.dialog__close')?.focus();

            // Execute all callbacks registered for the `show` event
            this._fire('show', event);

            return this;
        }

        hide(event) {
            // If the dialog is already closed, abort
            if (!this.shown) {
                return this;
            }

            this._unbind();
            this._disconnectObservers();

            this.shown = false;
            this.$dialog.setAttribute('aria-hidden', 'true');

            // If there was a focused element before the dialog was opened (and it has a
            // `focus` method), restore the focus back to it
            // See: https://github.com/KittyGiraudel/a11y-dialog/issues/108
            if (this.$previouslyFocused && this.$previouslyFocused.focus) {
                this.$previouslyFocused.focus();
            }

            // Execute all callbacks registered for the `hide` event
            this._fire('hide', event);

            return this;
        }

        fullscreen(event) {
            if (!document.fullscreenElement) {
                this.$dialog.requestFullscreen();
            } else {
                document.exitFullscreen();
            }

            this.goTo(this.$current);
            this._fire('fullscreen', event);
        }

        goTo(target) {
            this._scroll(target);
            this._fire('goto');
        }

        _scroll(target) {
            if (!target || !target.matches('.dialog__images-item')) {
                return;
            }

            const rect = target.getBoundingClientRect();

            const options = {
                behavior: 'auto',
                top: 0,
                left: rect.x,
            };

            this.$dialogRegion.scrollBy(options);

            this.$current = target;

            this._fire('scroll');
        }

        _bind() {
            window.addEventListener('resize', this._handleWindowResize.bind(this));

            this.$dialog.addEventListener('keyup', this._handleDialogKeyup.bind(this));
            this.$dialog.addEventListener('keydown', this._handleDialogKeydown.bind(this));

            this.$dialogRegion.addEventListener('keyup', this._handleDialogRegionKeyup.bind(this));

            this.$dialogImages.addEventListener('click', this.hide.bind(this));

            this.$galleryElement
                .querySelectorAll('.dialog__overlay, .dialog__close')
                .forEach((element) => {
                    element?.addEventListener('click', this.hide.bind(this));
                });

            this.$galleryElement
                .querySelector('.dialog__fullscreen')
                ?.addEventListener('click', this.fullscreen.bind(this));

            this.$galleryElement
                .querySelector('.dialog__previous')
                ?.addEventListener('click', this._handlePreviousClick.bind(this));
            this.$galleryElement
                .querySelector('.dialog__next')
                ?.addEventListener('click', this._handleNextClick.bind(this));
        }

        _unbind() {
            window.removeEventListener('resize', this._handleWindowResize);

            this.$dialog.removeEventListener('keyup', this._handleDialogKeyup);
            this.$dialog.removeEventListener('keydown', this._handleDialogKeydown);

            this.$dialogImages.removeEventListener('click', this.hide);

            this.$galleryElement
                .querySelectorAll('.dialog__overlay, .dialog__close')
                .forEach((element) => {
                    element?.removeEventListener('click', this.hide);
                });

            this.$galleryElement
                .querySelector('.dialog__fullscreen')
                ?.removeEventListener('click', this.fullscreen);

            this.$galleryElement
                .querySelector('.dialog__previous')
                ?.removeEventListener('click', this._handlePreviousClick);
            this.$galleryElement
                .querySelector('.dialog__next')
                ?.removeEventListener('click', this._handleNextClick);
        }

        _connectObservers() {
            const that = this;

            const options = {
                root: this.$dialogRegion,
                rootMargin: '-10px',
            };

            const callback = (entries) => {
                entries.forEach((entry) => {
                    const { target: item } = entry;
                    const link = item.querySelector('a');

                    item.classList.remove('is-active');
                    link.setAttribute('tabindex', -1);

                    if (!entry.intersectionRatio > 0) {
                        return;
                    }

                    item.classList.add('is-active');
                    link.removeAttribute('tabindex');
                });

                // Update counter
                const current = that.$dialogItems.indexOf(that.$current) + 1;
                const total = that.$dialogItems.length;
                that.$dialogCounter.textContent = `${current} / ${total}`;
                that.$dialogAnnouce.textContent = `Showing item ${current} of ${total}`;
            };

            this._observer = new IntersectionObserver(callback, options);

            this.$dialogItems.forEach(function (item) {
                that._observer.observe(item);
            });
        }

        _disconnectObservers() {
            const that = this;

            this.$dialogItems.forEach(function (item) {
                that._observer.unobserve(item);
            });
        }

        _handleItemClick(event) {
            event.stopPropagation();
        }

        _handleDialogKeyup(event) {
            const { code } = event;

            if (code !== 'Escape') {
                return;
            }

            this.hide(event);
        }

        _handleDialogKeydown(event) {
            const { code, shiftKey, target } = event;

            if (code !== 'Tab') {
                return;
            }

            const focusable = this.$dialog.querySelectorAll('a:not([tabindex]), button');
            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (first === target && shiftKey) {
                event.preventDefault();
                last.focus();
            }
            if (last === target && !shiftKey) {
                event.preventDefault();
                first.focus();
            }
        }

        _handleDialogRegionKeyup(event) {
            const { code } = event;

            event.preventDefault();

            switch (code) {
                case 'ArrowLeft':
                    this._handlePreviousClick();
                    break;
                case 'ArrowRight':
                    this._handleNextClick();
                    break;
                default:
                    break;
            }
        }

        _handleNextClick() {
            const items = this.$dialogItems;
            const indexOfCurrent = items.indexOf(this.$current);
            const item = items[indexOfCurrent + 1];

            if (item) {
                this.goTo(item);
            }
        }

        _handlePreviousClick() {
            const items = this.$dialogItems;
            const indexOfCurrent = items.indexOf(this.$current);
            const item = items[indexOfCurrent - 1];

            if (item) {
                this.goTo(item);
            }
        }

        _handleWindowResize() {
            this._debounce(this._scroll(this.$current));
        }
    }
    new A11yGallery(document.querySelector('.wp-block-gallery'));
</script>
</x-layout>
