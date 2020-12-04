import {
    createButtonEdit,
    createButtonDelete,
    append,
    insertBefore,
    element,
} from "../../helpers/DOM.js";

const column = element("div", {
    className: "col-sm-12 col-md-6 col-lg-4 px-2 py-2",
});
const card = element("div", { className: "card" });
const cardBody = element("div", { className: "card-body" });
const cardTitle = element("h5", { className: "card-title title pl-1" });
const cardImage = element("img", {
    className: "card-img-top",
    src: "http://localhost:8000/images/vacunas.png",
    alt: "Vacuna",
});
const cardRowButtons = element("div");
cardRowButtons.className = "row w-100 m-0";

const cardColumnButton1 = element("div", {
    className: "col-sm-12 col-lg-6 p-1",
});
const cardColumnButton2 = element("div", {
    className: "col-sm-12 col-lg-6 p-1",
});
const buttonEdit = createButtonEdit();
const buttonDelete = createButtonDelete();
const vaccionationsContainer = document.getElementById("vaccinations-list");

export function createCardVaccionation(title, id) {
    column.id = id;
    cardTitle.innerText = title;

    cardColumnButton1.appendChild(buttonEdit);
    cardColumnButton2.appendChild(buttonDelete);
    append(cardRowButtons, [cardColumnButton1, cardColumnButton2]);
    append(cardBody, [cardTitle, cardRowButtons]);
    append(card, [cardImage, cardBody]);
    column.appendChild(card);

    insertBefore(vaccionationsContainer, column);
}
