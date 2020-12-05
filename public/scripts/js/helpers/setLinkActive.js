import { selector } from "./DOM.js";

window.lastLinkClicked = null;
export default function setLinkActive() {
    const hashUrl = location.hash.replace("#", "");
    const node = selector(`a[data-hash='${hashUrl}']`);
    if (node) {
        if (lastLinkClicked && lastLinkClicked.hashUrl !== hashUrl) {
            lastLinkClicked.node.classList.remove("active");
        }
        lastLinkClicked = { node, hashUrl };
        node.classList.add("active");
    }
}
