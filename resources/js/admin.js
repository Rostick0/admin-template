import { inputSetErrorAdmin } from "../../../app";
const adminForm = document.querySelector(".admin-form");

console.log(inputSetErrorAdmin);
adminForm.onsubmit = (e) => {
    e.preventDefault();
    const errors = validate(adminForm, {
        title: {
            // type: String,
            presence: true,
            // email: true,
            length: {
                minimum: 6,
            },
        },
    });

    console.log(errors);

    inputSetErrorAdmin({
        name: "title",
    });

    // console.log(errors);
    // console.log(e);
};
