// import the Flickr algorithm
import layout from "justified-layout";

const breakPoints = [
    // media query is null for the default style
    {mediaQuery: null, containerWidth: 400},
    {mediaQuery: 568, containerWidth: 600},
    // add more if needed
];

const Flickr = ({photos}) => {
    const ratios = photos.map((photo) => photo.aspectRatio);
    const layouts = breakPoints.map((breakPoint) => ({
        breakPoint,
        layout: layout(ratios, {
            boxSpacing: 0,
            containerPadding: 0,
            containerWidth: breakPoint.containerWidth,
        }),
    }));

    const getRatiosAndBreakpointsForPhoto = (photoIndex) => {
        // returns an array containing the media query and the width percentage the photo should take on that media query
        // example: [{ mediaQuery: null, ratio: 0.3 }, { mediaQuery: null, ratio: 0.8 }]
        return layouts.map((layout) => ({
            mediaQuery: layout.breakPoint.mediaQuery,
            ratio:
                (layout.boxes[photoIndex].width / layout.breakPoint.containerWidth) *
                100,
        }));
    };

    return (
        <div style={{display: "flex", flexWrap: "wrap"}}>
            {photos.map((photo, index) => {
                <PhotoBox responsiveRatios={getRatiosAndBreakpointsForPhoto(index)}>
                    <ImageComponent photo={photo}/>
                </PhotoBox>;
            })}
        </div>
    );
};

const flexCssValue = (photoBreakPoint) =>
    photoBreakPoint.mediaQuery === null
        ? `flex: 0 0 ${photoBreakPoint.ratio}%;`
        : `@media (min-width: ${photoBreakPoint.breakpoint}px) {
        flex: 0 0 ${photoBreakPoint.ratio}%;
      }`;

const PhotoBox = styled`
  ${(props) => {
    return props.responsiveRatios.map((r) => flexCssValue(r)).join("\n");
}}
`;


const input = [{
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
    }];

const output = {
    "containerHeight": 1269,
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
    ]
};
