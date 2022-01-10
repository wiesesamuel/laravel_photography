<style>
    html:not(.touch) .gallery-image figcaption, .touch .gallery-image figcaption, .mfp-with-zoom .mfp-title {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 14px;
        color: rgba(255, 255, 255, 0);
        padding: 1em;
        transition: all .2s ease;
        font-weight: 600;
        max-width: calc(100% - 9em);
        line-height: 1.25;
        text-align: center;
        box-sizing: border-box; }
    html:not(.touch) .gallery-image figcaption:before, .touch .gallery-image figcaption:before, .mfp-with-zoom .mfp-title:before, html:not(.touch) .gallery-image figcaption:after, .touch .gallery-image figcaption:after, .mfp-with-zoom .mfp-title:after {
        content: '';
        position: absolute;
        background: rgba(0, 0, 0, 0.3);
        width: 130%;
        height: 160%;
        padding: 2em;
        transition: all .3s ease-in-out;
        opacity: 0;
        z-index: -1; }
    html:not(.touch) .gallery-image figcaption:before, .touch .gallery-image figcaption:before, .mfp-with-zoom .mfp-title:before, html:not(.touch) .gallery-image figcaption:after, .touch .gallery-image figcaption:after, .mfp-with-zoom .mfp-title:after {
        right: 100%;
        bottom: 100%; }
    html:not(.touch) .gallery-image figcaption:after, .touch .gallery-image figcaption:after, .mfp-with-zoom .mfp-title:after {
        left: 100%;
        top: 100%; }

    html:not(.touch) .gallery-image:hover figcaption, .touch .gallery-image figcaption, .mfp-with-zoom.mfp-ready .mfp-title {
        color: white;
        text-shadow: 0 0 1px rgba(0, 0, 0, 0.2);
        transition: all .2s ease .3s; }
    html:not(.touch) .gallery-image:hover figcaption:before, .touch .gallery-image figcaption:before, .mfp-with-zoom.mfp-ready .mfp-title:before, html:not(.touch) .gallery-image:hover figcaption:after, .touch .gallery-image figcaption:after, .mfp-with-zoom.mfp-ready .mfp-title:after {
        opacity: 1; }
    html:not(.touch) .gallery-image:hover figcaption:before, .touch .gallery-image figcaption:before, .mfp-with-zoom.mfp-ready .mfp-title:before {
        right: -1.5em;
        bottom: -1.5em; }
    html:not(.touch) .gallery-image:hover figcaption:after, .touch .gallery-image figcaption:after, .mfp-with-zoom.mfp-ready .mfp-title:after {
        left: -1.5em;
        top: -1.5em; }

    html {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizelegibility; }

    figcaption {
        font-family: 'Montserrat', sans-serif; }

    .gallery {
        column-gap: 0; }
    @media (min-width: 480px) {
        .gallery {
            column-count: 2; } }
    @media (min-width: 1260px) {
        .gallery {
            column-count: 3; } }

    .gallery-image {
        position: relative;
        margin: 0;
        padding: 0; }
    .gallery-image:before, .gallery-image:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: 16px solid rgba(0, 0, 0, 0.1);
        transition: all .2s;
        will-change: border; }
    .gallery-image:after {
        border-width: 0; }
    .gallery-image img {
        display: block;
        max-width: 100%;
        height: auto; }
    html:not(.touch) .gallery-image {
        overflow: hidden; }
    html:not(.touch) .gallery-image:hover:before {
        border-width: 16px; }
    html:not(.touch) .gallery-image:hover:after {
        border-width: 32px; }
    .touch .gallery-image figcaption {
        top: auto;
        bottom: 2em; }
    a {
        text-decoration: none;
        color: inherit; }
</style>

<article class="gallery">
    {{$slot ?? ''}}
</article>
