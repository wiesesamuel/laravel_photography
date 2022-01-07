<x-layout>

<style>
    HTML, BODY {
        height: 100%;
        font-size: 16px;
        line-height: 1.5;
        font-family: Trebuchet MS, Helvetica, Arial, sans-serif;
    }
    BODY {
        overflow: hidden;
        background-color: #222;
        background-image: linear-gradient(to right, rgba(255, 255, 255, .025) 10%, transparent 0), linear-gradient(#222, #000);
        background-size: 0.75em 100%, 100% 100%;
        background-attachment: fixed;
        display: flex;
        align-items: center;
    }
    .wrapper {
        position: relative;
        flex-grow: 1;
        margin: auto;
        max-width: 1200px;
        max-height: 1200px;
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        grid-template-rows: repeat(4, 1fr);
        grid-gap: 2vmin;
        justify-items: center;
        align-items: center;
    }
    IMG {
        z-index: 1;
        grid-column: span 2;
        max-width: 100%;
        margin-bottom: -52%;
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        transform: scale(1);
        transition: all 0.25s;
    }
    IMG:nth-child(7n + 1) {
        grid-column: 2 / span 2;
    }
    IMG:hover {
        z-index: 2;
        transform: scale(2);
    }
</style>



<div class="wrapper">
    <img src="https://source.unsplash.com/random/600x600?water" alt="">
    <img src="https://source.unsplash.com/random/600x600?summer" alt="">
    <img src="https://source.unsplash.com/random/600x600?plants" alt="">
    <img src="https://source.unsplash.com/random/600x600?snow" alt="">
    <img src="https://source.unsplash.com/random/600x600?roses" alt="">
    <img src="https://source.unsplash.com/random/600x600?sky" alt="">
    <img src="https://source.unsplash.com/random/600x600?nature" alt="">
    <img src="https://source.unsplash.com/random/600x600?blossom" alt="">
    <img src="https://source.unsplash.com/random/600x600?ice" alt="">
    <img src="https://source.unsplash.com/random/600x600?spring" alt="">
</div>

</x-layout>
