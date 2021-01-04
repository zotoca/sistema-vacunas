import { selectorAll, togglerTextLarge } from "../helpers/DOM.js";

document.addEventListener("DOMContentLoaded", () => {
    const commentsNode = selectorAll(".post-comment-text");
    togglerTextLarge(commentsNode)
});
