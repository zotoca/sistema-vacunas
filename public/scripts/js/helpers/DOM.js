export function querySelector(node) {
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

export function createButtonEdit(props = {}) {
    const btn = element("button");
    btn.className = "btn btn-primary btn-block";
    btn.innerHTML = `Editar <i class="fa fa-pencil ml-1"></i>`;
    return setProps(btn, props);
}

export function createButtonDelete(props = {}) {
    const btn = element("button");
    btn.className = "btn btn-danger btn-block";
    btn.innerHTML = `Eliminar <i class="fa fa-trash-alt ml-1"></i>`;
    return setProps(btn, props);
}

export function append(element, childs = []) {
    for (let i = 0, len = childs.length; i < len; ) {
        element.appendChild(childs[i++]);
    }
}

export function insertBefore(father, newNode) {
    father.insertBefore(newNode, father.firstChild);
}
