// import "./bootstrap";
import './vue/main';

// const inputSetError = ({
//     name,
//     errorMessage,
//     labelSelector,
//     errorSelector = ".label__error",
// } = {}) => {
//     const inputElement = document.querySelector(`input[name="${name}"]`);
//     const parentLabel = inputElement.closest(labelSelector);

//     const errorTag = parentLabel.querySelector(errorSelector);

//     if (errorTag) {
//         errorTag.textContent = errorMessage;
//     } else {
//         parentLabel.insertAdjacentHTML(
//             "beforeend",
//             `<span class="${errorSelector}">${errorMessage}</span>`
//         );
//     }

//     console.log(parentLabel);
// };

// const inputSetErrorAdmin = ({
//     name,
//     errorMessage,
//     labelSelector = ".admin-label",
//     errorSelector = ".admin-label__error",
// } = {}) => {
//     inputSetError({ name, errorMessage, labelSelector, errorSelector });
// };

// // inputSetErrorAdmin({name: '', errorMessage: ''})

// export {
//     inputSetErrorAdmin
// };