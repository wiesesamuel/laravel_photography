<x-layout>
<div>

<style>

    .gallery * {margin:0;padding:0;border:0 none; position: relative;}
    .gallery html {
        box-sizing:border-box;
        background: #c6d9d3;
        font-family: Helvetica,Arial,san-serif;
    }
    .gallery .hide {display: none;}
    @media only screen and (min-width: 800px) {
        .gallery .wrap {
            display: grid;
            grid-template-columns: repeat(auto-fill,minmax(calc(8rem + 5vw + 5vh),1fr));
            grid-gap: 2.5vmin;
            padding: 2.5vmin;
        }
        .gallery #dense:checked + .wrap {
            grid-auto-flow: dense;
        }
        .gallery figure:first-child {
            grid-row-start: span 3;
            grid-column-start: span 3;
        }
        figure:nth-child(2n+3) {
            grid-row-start: span 3;
        }
        figure:nth-child(4n+5) {
            grid-column-start: span 2;
            grid-row-start: span 2;
        }
        figure:nth-child(6n+7) {
            grid-row-start: span 2;
        }
        figure:nth-child(8n+9) {
            grid-column-start: span 2;
            grid-row-start: span 3;
        }
        img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            box-shadow: 0 0 3px #496b7b;
            border-radius: 5px;
        }
        figure {
            counter-increment: numImg;
        }
        figure::after {
            background: rgba(0,0,0,.5);
            content: counter(numImg);
            position: absolute;
            top: 0%;
            left: 0;
            font-size: 2rem;
            color: #c6d9d3;
            width: 4rem;
            height: 4rem;
            line-height: 4rem;
            text-align: center;


        }
    }

    figure,
    img {
        transition: .4s;
    }
    label {
        background: rgba(73,107, 123,.75);
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        font-size: 1.5rem;
        font-weight: 100;
        color: #fff;
        text-align: center;
        letter-spacing: 2px;
        padding: 1rem;
        cursor: pointer;
        box-shadow: 0 0 3px rgba(25,42, 46,.75);
    }
    label span {
        background: #b1cccb;
        display: block;
        font-variant: small-caps;
        font-size: 150%;
        color: #496b7b;
    }
    label span::after {
        content: ' initial';
    }
    #dense:checked ~ label span:after {
        content: ' dense';
    }
    a {color: #f7e371}
    figcaption {
        background: #932e26;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 4rem;
        padding: 1.3rem 1rem 1rem 4.5rem;
        font-weight: 100;
        line-height: 1.5;
        color: #fff;
    }



</style>

<div class='wrap'>
    <figure><img src='https://unsplash.it/800/450?image=1011' alt /></figure>
    <figure><img src='https://unsplash.it/600/850?image=11' alt /></figure>
    <figure><img src='https://unsplash.it/900/850?image=1075' alt /><figcaption><a href='https://escss.blogspot.com.es/'>HERE YOU HAVE A REAL USE CASE</a></figcaption></figure>
    <figure><img src='https://unsplash.it/900/650?image=14' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=15' alt />
        <figcaption>Here is another version: <a href='https://codepen.io/Kseso/full/OjprYz/'>a case study. Latest post of a blog</a>. The titles & font sizes help to diversify the size of each area</figcaption>
    </figure>
    <figure><img src='https://unsplash.it/900/650?image=16' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=17' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=18' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=19' alt /><figcaption>More '#impoCSSible inside' <a href='https://escss.blogspot.com/search/label/demo'>my blog 👍</a></figcaption>
    </figure>
    <figure><img src='https://unsplash.it/900/650?image=20' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=21' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=23' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=24' alt />
        <figcaption>Here's the v2 with <a href='https://escss.blogspot.com/2017/07/css-grid-layout-as-masonry.html'>lazy-load images</a> pure Js</figcaption>
    </figure>
    <figure><img src='https://unsplash.it/900/650?image=25' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=26' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=27' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=28' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=29' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=30' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=33' alt /></figure>
    <figure><img src='https://unsplash.it/900/650?image=34' alt /><figcaption>Please, show the pen & <a href='https://escss.blogspot.com/2017/07/css-grid-layout-as-masonry.html'>link the post</a>. Thanks.</figcaption>
    </figure>
    <figure><img src='https://unsplash.it/900/350?image=35' alt /></figure>
    <figure><img src='https://unsplash.it/900/350?image=42' alt /></figure>
    <figure><img src='https://unsplash.it/900/350?image=46' alt /></figure>
</div>
</div>

</x-layout>
