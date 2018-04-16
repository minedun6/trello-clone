export const randomObjectKey = function (array) {
    return Object.keys(array)[Math.floor(Math.random()*Object.keys(array).length)]
}