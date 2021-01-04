import { getStreets, getHouses, isValidDni } from "../helpers/requests.js";

export const body = document.body;

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

export function createHTMLOptions(arrayObjects, props = []) {
    let tpl = "";
    const [value, text] = props;
    for (const item of arrayObjects) {
        tpl += `<option value="${item[value]}">${item[text]}</option>`;
    }
    return tpl;
}

export function display(element, display = "block") {
    element.style.display = display;
}

export function addClass(element, className) {
    element.classList.add(className);
}

export function removeClass(element, className) {
    element.classList.remove(className);
}

export function togglerTextLarge(
    nodes = [],
    symbol = "[ver más]",
    symbolHide = "[ocultar]",
    maxLen = 400
) {
    const commentsText = {};
    const togglerText = (e) => {
        e.preventDefault();
        const t = e.target;
        const id = t.getAttribute("data-comment");
        const obj = commentsText[id];
        const span = obj.node.querySelector("span");
        if (!obj.isExpanded) {
            span.innerText = obj.text;
            t.innerText = symbolHide;
        } else {
            t.innerText = symbol;
            span.innerText = obj.text.substring(0, maxLen);
        }

        obj.isExpanded = !obj.isExpanded;
    };

    nodes.forEach((node, i) => {
        const text = node.innerText;
        const anchor = element("a", {
            href: "#",
            innerText: symbol,
            className: "comment-toggler",
            onclick: togglerText,
        });
        commentsText[i] = {
            node,
            text,
            isExpanded: false,
        };

        if (text.length > maxLen) {
            anchor.setAttribute("data-comment", i);
            node.querySelector("span").innerText = text.substring(0, maxLen);
            node.appendChild(anchor);
        }
    });
}

export function setValueInSelect(select, value) {
    const countOptions = select.options.length;
    let flag = true;
    for (let i = 0; i < countOptions && flag; i++) {
        if (value === select.options[i].value) {
            flag = false;
            select.value = select.options[i].value;
        }
    }
}

export function setLinkImagePreview({ img, imagePreview, anchorImagePreview }) {
    imagePreview.src = img;
    anchorImagePreview.href = img;
    anchorImagePreview.setAttribute("data-lightbox", img);
}

export async function showStreets({
    loaderStreet,
    loaderHouse,
    streetsSelect,
    streetId,
    showHouses,
    streetError,
    houseError,
}) {
    try {
        display(loaderStreet);
        streetsSelect.disabled = true;
        const streets = await getStreets();
        streetsSelect.innerHTML = createHTMLOptions(streets, ["id", "name"]);
        streetsSelect.disabled = false;
        setValueInSelect(streetsSelect, streetId);
        showHouses(streetsSelect.value);
    } catch (e) {
        console.log(e);
        display(streetError, "inline");
        display(houseError, "inline");
        display(loaderHouse, "none");
    }
    display(loaderStreet, "none");
}

export async function showHouses({
    id,
    loaderHouse,
    housesSelect,
    houseId,
    toggleBtnSubmit,
    houseError,
}) {
    toggleBtnSubmit(true);
    try {
        display(loaderHouse);
        housesSelect.disabled = true;
        const houses = await getHouses(id);
        housesSelect.innerHTML = createHTMLOptions(houses, ["id", "number"]);
        housesSelect.disabled = false;
        setValueInSelect(housesSelect, houseId);
    } catch (e) {
        display(houseError, "inline");
    }
    display(loaderHouse, "none");
    toggleBtnSubmit();
}

export async function checkDni({
    target,
    personsDNI,
    dniError,
    toggleBtnSubmit,
}) {
    let input = personsDNI[target.name];
    if (target.value) {
        try {
            display(input.node);
            toggleBtnSubmit(true);
            const isValid = await isValidDni(target.value);

            if (!isValid.isValid) {
                addClass(target, "bad");
                input.valid = false;
            } else {
                removeClass(target, "bad");
                input.valid = true;
            }
        } catch (error) {
            display(dniError[target.name], "inline");
        }
        display(input.node, "none");
    } else {
        removeClass(target, "bad");
        input.valid = true;
    }

    toggleBtnSubmit();

    if (!personsDNI.father_dni.valid || !personsDNI.mother_dni.valid) {
        toggleBtnSubmit(true);
    }
}
