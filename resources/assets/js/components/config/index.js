export const storyDraggableOptions = {
    group: "stories",
    animation: 150,
    ghostClass: ".sortable-ghost",
    chosenClass: ".sortable-chosen",
    forceFallback: false,
    fallbackOnBody: false,
    fallbackTolerance: 0,
    scroll: true,
    scrollSpeed: 10
    // setData(dataTransfer) {
    //     console.log(dataTransfer)
    //     dataTransfer.setDragImage(null, 0, 0);
    // }
};

export const groupsDraggableOptions = {
    group: "groups",
    handle: ".group-handle",
    animation: 150,
    ghostClass: ".sortable-ghost",
    chosenClass: ".sortable-chosen",
    forceFallback: false,
    fallbackOnBody: false,
    fallbackTolerance: 0,
    scroll: true,
    scrollSpeed: 10
}