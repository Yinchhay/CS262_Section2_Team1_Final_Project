document.addEventListener("DOMContentLoaded", function () {
    const addOptionBtn = document.querySelector("#addOption");
    const questionType = document.querySelector("#qtnType");

    function getOptionDivs() {
        return document.querySelectorAll(".optionDiv");
    }

    function getAnswerOptionDivs() {
        return document.querySelectorAll(".answerOptionDiv");
    }

    getOptionDivs().forEach((div) => {
        div.querySelector("button").addEventListener("click", () => {
            deleteOption(div);
        });
    });

    function deleteOption(optionDiv) {
        if (getOptionDivs().length === 1) {
            return;
        }

        const optionIndex = Array.from(optionDiv.parentNode.children).indexOf(
            optionDiv
        );

        const optDiv = getOptionDivs();
        optDiv[optionIndex - 1].remove();

        // update the labels of the remaining options and answer options
        const optionDivs = getOptionDivs();
        let answerOptionDivs = getAnswerOptionDivs();

        optionDivs.forEach((div, index) => {
            const input = div.querySelector("input");
            const label = div.querySelector("label");
            input.id = `option${index + 1}`;
            label.htmlFor = `option${index + 1}`;
            label.textContent = `Option ${index + 1}`;
        });

        // remove the clicked option from the answer options
        answerOptionDivs[optionIndex - 1].remove();

        answerOptionDivs = getAnswerOptionDivs();
        // update the labels of the remaining answer options
        answerOptionDivs.forEach((div, index) => {
            const input = div.querySelector("input");
            const label = div.querySelector("label");
            input.value = index + 1;
            input.id = `answerOption${index + 1}`;
            label.htmlFor = `answerOption${index + 1}`;
            label.textContent = `Option ${index + 1}`;
        });
    }

    function cloneOneOption() {
        const optionDivs = getOptionDivs();

        const newOption = optionDivs[0].cloneNode(true);
        const newLabel = newOption.querySelector("label");
        const newInput = newOption.querySelector("input");
        const deleteBtn = newOption.querySelector("button");

        newInput.value = `Option ${optionDivs.length + 1}`;
        newInput.id = `option${optionDivs.length + 1}`;
        newLabel.htmlFor = `option${optionDivs.length + 1}`;
        newLabel.textContent = `Option ${optionDivs.length + 1}`;

        deleteBtn.addEventListener("click", () => {
            deleteOption(newOption);
        });

        optionDivs[0].parentNode.appendChild(newOption);
    }

    function cloneOneAnswerOption() {
        const answerOptionDivs = getAnswerOptionDivs();

        const newAnswerOption = answerOptionDivs[0].cloneNode(true);
        newInput = newAnswerOption.querySelector("input");
        newLabel = newAnswerOption.querySelector("label");
        newInput.value = 1;
        newInput.id = `answerOption${answerOptionDivs.length + 1}`;
        newLabel.htmlFor = `answerOption${answerOptionDivs.length + 1}`;
        newLabel.textContent = `Option ${answerOptionDivs.length + 1}`;
        answerOptionDivs[0].parentNode.appendChild(newAnswerOption);
    }

    addOptionBtn.addEventListener("click", () => {
        const optionDivs = getOptionDivs();

        // if there are no options div, return because we don't have any div to clone
        if (!optionDivs || optionDivs.length === 0) {
            return;
        }

        cloneOneOption();
        cloneOneAnswerOption();
    });

    function changeQuestionType() {
        const answerOptionDivs = getAnswerOptionDivs();
        const questionType = document.querySelector("#qtnType");

        switch (questionType.value) {
            case "checkboxes":
                // update answer options to checkboxes
                answerOptionDivs.forEach((div) => {
                    const input = div.querySelector("input");
                    input.type = "checkbox";
                });
                break;
            case "multiple choice":
                // update answer options to radio buttons
                answerOptionDivs.forEach((div) => {
                    const input = div.querySelector("input");
                    input.type = "radio";
                });
                break;
            default:
                break;
        }
    }

    // on change of question type
    questionType.addEventListener("change", (e) => {
        changeQuestionType();
    });

    // on load
    changeQuestionType();
});
