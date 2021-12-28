<!DOCTYPE html>

<head>

    <title>Justified Layout by Flickr</title>

    <link rel="stylesheet" href="https://yui-s.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/ico" href="https://s.yimg.com/pw/favicon.ico">
    <script type="text/javascript" src="dist/justified-layout.js"></script>
    <script type="text/javascript">

        var halfSizeConfig = {
            containerWidth: 530,
            containerPadding: 5,
            boxSpacing: 5,
            targetRowHeight: 160
        };

        function generateJustifiedOutput(input, outputContainerSelector, config) {

            var justifiedLayout = require('justified-layout');
            var geometry = justifiedLayout(input, config);
            var boxes = geometry.boxes.map(function (box) {
                return  `<div class="box" style="width: ${box.width}px; height: ${box.height}px; top: ${box.top}px; left: ${box.left}px"></div>`;
            }).join('\n');

            document.querySelector(outputContainerSelector).innerHTML = boxes;
            document.querySelector(outputContainerSelector).style.height = geometry.containerHeight + "px";
            document.querySelector(outputContainerSelector).style.width = config.containerWidth + "px";

        }

    </script>

</head>

<body>

<h1><a href="https://github.com/flickr/justified-layout">Justified Layout</a> by <a href="https://www.flickr.com">Flickr</a></h1>

<p>Accepts an array of boxes (with a lot of optional configuration options) and returns
    geometry for a nice justified layout as seen all over <a href="https://www.flickr.com/explore">Flickr</a>.</p>



<h2 id="installation">Installation</h2>

<p><pre><code>npm install justified-layout</code></pre></p>



<h2 id="usage">Usage</h2>

<p><pre><code>var layoutGeometry = require('justified-layout')([1.33, 1, 0.65] [, config])</code></pre></p>



<h2 id="inputs">Inputs</h2>

<p>There's two options for input. The simplest is an array of numbers representing aspect ratios. Alternatively
    you can pass in an array of objects with width and height properties.</p>

<p>Aspect ratios option:</p>

<p><pre><code>[1.33, 1, 0.65]</code></pre><p>

<p>Size object option:</p>

<p><pre><code>[{
    width: 400,
    height: 300
},
{
    width: 300,
    height: 300
},
{
    width: 250,
    height: 400
}]</code></pre></p>



<h2 id="outputs">Output</h2>

<p>Something like this:</p>

<p><pre><code>{
    "containerHeight": 1269,
    "widowCount": 0,
    "boxes": [
        {
            "aspectRatio": 0.5,
            "top": 10,
            "width": 170,
            "height": 340,
            "left": 10
        },
        {
            "aspectRatio": 1.5,
            "top": 10,
            "width": 510,
            "height": 340,
            "left": 190
        },
        ...
    ]
}</code></pre></p>



<h2 id="options">Configuration Options</h2>

<p>No configuration is required but chances are you'd like to change some things. Here are your options:</p>

<table class="pure-table pure-table-horizontal">
    <thead>
    <tr>
        <th>Parameter</th>
        <th>Type</th>
        <th>Default</th>
        <th>Description</th>
    </tr>
    </thead>
    <tr>
        <td><code class="inline">containerWidth</code></td>
        <td>Integer</td>
        <td><code class="inline">1060</code></td>
        <td><p>The width that boxes will be contained within irrelevant of padding.</p></td>
    </tr>
    <tr>
        <td><code class="inline">containerPadding</code></td>
        <td>Integer or Object</td>
        <td><code class="inline">10</code></td>
        <td><p>Provide a single integer to apply padding to all sides or provide an object to apply
                individual values to each side, like this:</p>

            <pre><code>containerPadding: {
    top: 50,
    right: 5,
    bottom: 50,
    left: 5
}</code></pre>
        </td>
    </tr>
    <tr>
        <td><code class="inline">boxSpacing</code></td>
        <td>Integer or Object</td>
        <td><code class="inline">10</code></td>
        <td><p>Provide a single integer to apply spacing both horizontally and vertically or provide an object to
                apply individual values to each axis, like this:</p>

            <pre><code>boxSpacing: {
    horizontal: 10,
    vertical: 30
}</code></pre>
        </td>
    </tr>
    <tr>
        <td><code class="inline">targetRowHeight</code></td>
        <td>Integer</td>
        <td><code class="inline">320</code></td>
        <td><p>It's called a target because row height is the lever we use in order to fit
                everything in nicely. The algorithm will get as close to the target row height
                as it can.</p></td>
    </tr>
    <tr>
        <td><code class="inline">targetRowHeightTolerance</code></td>
        <td>Float</td>
        <td><code class="inline">0.25</code></td>
        <td><p>How far row heights can stray from <code class="inline">targetRowHeight</code>. <code class="inline">0</code> would
                force rows to be the <code class="inline">targetRowHeight</code> exactly and would likely make it
                impossible to justify. The value must be between <code class="inline">0</code> and <code class="inline">1</code>.</p></td>
    </tr>
    <tr>
        <td><code class="inline">maxNumRows</code></td>
        <td>Integer</td>
        <td><code class="inline">Number.POSITIVE_INFINITY</code></td>
        <td><p>Will stop adding rows at this number regardless of how many items still need to be
                laid out.</p></td>
    </tr>
    <tr>
        <td><code class="inline">forceAspectRatio</code></td>
        <td>Boolean or Float</td>
        <td><code class="inline">false</code></td>
        <td><p>Provide an aspect ratio here to return everything in that aspect ratio. Makes the values
                in your input array irrelevant. The length of the array remains relevant.</p></td>
    </tr>
    <tr>
        <td><code class="inline">showWidows</code></td>
        <td>Boolean</td>
        <td><code class="inline">true</code></td>
        <td><p>By default we'll return items at the end of a justified layout even if they don't make
                a full row. If <code class="inline">false</code> they'll be omitted from the output.</p></td>
    </tr>
    <tr>
        <td><code class="inline">fullWidthBreakoutRowCadence</code></td>
        <td>Boolean or Integer</td>
        <td><code class="inline">false</code></td>
        <td><p>If you'd like to insert a full width box every <code class="inline">n</code> rows you can specify
                it with this parameter. The box on that row will ignore the <code class="inline">targetRowHeight</code>,
                make itself as wide as <code class="inline">containerWidth</code> - <code class="inline">containerPadding</code> and be
                as tall as its aspect ratio defines. It'll only happen if that item has an aspect ratio >= 1.
                Best to have a look at the examples to see what this does.</p></td>
    </tr>
</table>


<h2 id="examples">Live Examples</h2>

<p>*All examples scaled to half the size for better presentation here.</p>


<h3>The Default</h3>

<p><pre><code>var geometry = justifiedLayout([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2, 2.1])</code></pre></p>

<div class="example example-default"></div>
<script type="text/javascript">
    generateJustifiedOutput([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2, 2.1], '.example-default', halfSizeConfig);
</script>


<h3>Container Padding Config</h3>

<p><pre><code>var geometry = justifiedLayout([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5], {
	containerPadding: 50
})</code></pre></p>

<div class="example example-containerPadding"></div>
<script type="text/javascript">
    var halfSizeWithPadding = JSON.parse(JSON.stringify(halfSizeConfig));
    halfSizeWithPadding.containerPadding = 25;
    generateJustifiedOutput([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5], '.example-containerPadding', halfSizeWithPadding);
</script>


<h3>Uneven Container Padding Config</h3>

<p><pre><code>var geometry = justifiedLayout([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7], {
	containerPadding: {
		top: 50,
		right: 20,
		left: 200,
		bottom: 50
	}
})</code></pre></p>

<div class="example example-containerPaddingUneven"></div>
<script type="text/javascript">
    var halfSizeWithUnevenPadding = JSON.parse(JSON.stringify(halfSizeConfig));
    halfSizeWithUnevenPadding.containerPadding = {
        top: 25,
        right: 10,
        left: 100,
        bottom: 25
    };
    generateJustifiedOutput([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7], '.example-containerPaddingUneven', halfSizeWithUnevenPadding);
</script>


<h3>Box Spacing Config</h3>

<p><pre><code>var geometry = justifiedLayout([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5], {
	boxSpacing: {
		horizontal: 4,
		vertical: 30
	}
})</code></pre></p>

<div class="example example-boxSpacing"></div>
<script type="text/javascript">
    var halfSizeWithBoxSpacing = JSON.parse(JSON.stringify(halfSizeConfig));
    halfSizeWithBoxSpacing.boxSpacing = {
        horizontal: 2,
        vertical: 15
    };
    generateJustifiedOutput([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5], '.example-boxSpacing', halfSizeWithBoxSpacing);
</script>


<h3>Target Row Height Config</h3>

<p><pre><code>var geometry = justifiedLayout([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5, 0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2], {
	targetRowHeight: 100
})</code></pre></p>

<div class="example example-height"></div>
<script type="text/javascript">
    var halfSizeWithHeight = JSON.parse(JSON.stringify(halfSizeConfig));
    halfSizeWithHeight.targetRowHeight = 50;
    generateJustifiedOutput([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5, 0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2], '.example-height', halfSizeWithHeight);
</script>


<h3>Force Aspect Ratio Config</h3>

<p><pre><code>var geometry = justifiedLayout([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5], {
	forceAspectRatio: 1
})</code></pre></p>

<div class="example example-force"></div>
<script type="text/javascript">
    var halfSizeWithForce = JSON.parse(JSON.stringify(halfSizeConfig));
    halfSizeWithForce.forceAspectRatio = 1;
    generateJustifiedOutput([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5], '.example-force', halfSizeWithForce);
</script>


<h3>Don't Display Widows Config</h3>

<p><pre><code>var geometry = justifiedLayout([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2], {
	showWidows: false
})</code></pre></p>

<div class="example example-orphans"></div>
<script type="text/javascript">
    var halfSizeWithOrphans = JSON.parse(JSON.stringify(halfSizeConfig));
    halfSizeWithOrphans.showWidows = false;
    generateJustifiedOutput([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2], '.example-orphans', halfSizeWithOrphans);
</script>


<h3>Full Width Breakout Row Config</h3>

<p><pre><code>var geometry = justifiedLayout([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5], {
	fullWidthBreakoutRowCadence: 2
})</code></pre></p>

<div class="example example-breakout"></div>
<script type="text/javascript">
    var halfSizeWithBreakout = JSON.parse(JSON.stringify(halfSizeConfig));
    halfSizeWithBreakout.fullWidthBreakoutRowCadence = 2;
    generateJustifiedOutput([0.5, 1.5, 1, 1.8, 0.4, 0.7, 0.9, 1.1, 1.7, 2.2, 1.5], '.example-breakout', halfSizeWithBreakout);
</script>


<a href="https://github.com/flickr/justified-layout"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>

</body>

