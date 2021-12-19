<style>
    * {
        box-sizing: border-box;
    }
    .flex {
        background-color: #122312;
        display: flex;
    }
    .col {
        margin: 40px;
        width: calc(33.3333% - 80px);
    }
    .border {
        outline: 4px solid #f00;
        outline-offset: -20px;
        padding: 36px 0 0 36px;
        margin: -36px 0 0 -36px;
    }
    .border img {
        max-width: 100%;
        height: auto;
        display: block;
    }

</style>

<div class="flex">
    <div class="col">
        <div class="border">
            <a href="//google.com">
                <img src="//via.placeholder.com/600x400" alt="image">
            </a>
        </div>
    </div>
    <div class="col">
        <div class="border">
            <a href="//google.com">
                <img src="//via.placeholder.com/600x400" alt="image">
            </a>
        </div>
    </div>
    <div class="col">
        <div class="border">
            <a href="//google.com">
                <img src="//via.placeholder.com/600x400" alt="image">
            </a>
        </div>
    </div>
</div>
