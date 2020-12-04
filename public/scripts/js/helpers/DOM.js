export function getId(node) {
    return document.getElementById(node);
}

export function selectorAll(node) {
    return document.querySelectorAll(node);
}

export function selector(node) {
    return document.querySelector(node);
}

export function setProps(element, props = {}) {
    for (const [prop, value] of Object.entries(props)) {
        element[prop] = value;
    }
    return element;
}

export function element(nodeName, props) {
    return setProps(document.createElement(nodeName), props);
}

export function append(element, childs = []) {
    for (let i = 0, len = childs.length; i < len; ) {
        element.appendChild(childs[i++]);
    }
}

export function insertBefore(father, newNode) {
    father.insertBefore(newNode, father.firstChild);
}
