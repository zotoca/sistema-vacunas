
window.lastLinkClicked = null;
export default function setLinkActive() {
    const hashUrl = location.hash.replace("#", "");
    const node = document.querySelector(`a[data-hash='${hashUrl}']`);
    if (node) {
        if (lastLinkClicked && lastLinkClicked.hashUrl !== hashUrl) {
            lastLinkClicked.node.classList.remove("active");
        }
        lastLinkClicked = { node, hashUrl };
        node.classList.add("active");
    }
}
