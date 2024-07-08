function updateAllElementsByClassName(className, value) {
    const elements = document.querySelectorAll(`.${className}`);
    elements.forEach(element => {
        element.textContent = value;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const level = document.getElementById('level');
    const year = document.getElementById('year');
    const month = document.getElementById('month');
    const vocabularyInstruction = document.getElementById('vocabularyInstruction');
    const grammarInstruction = document.getElementById('grammarInstruction');
    const listeningInstruction = document.getElementById('listeningInstruction');

    const l = document.getElementById('l');
    const y = document.getElementById('y');
    const m = document.getElementById('m');
    const vocabularyInst = document.getElementById('vocabularyInst');
    const grammarInst = document.getElementById('grammarInst');
    const listeningInst = document.getElementById('listeningInst');

    function updateResult() {
        // l.textContent = difficulty.options[difficulty.selectedIndex].text;
        // y.textContent = year.value;
        // m.textContent = month.options[month.selectedIndex].text;
        updateAllElementsByClassName('l', level.options[level.selectedIndex].text);
        updateAllElementsByClassName('y', year.value);
        updateAllElementsByClassName('m', month.options[month.selectedIndex].text);

        const vocabularyLines = vocabularyInstruction.value.split('\n');
        const grammarLines = grammarInstruction.value.split('\n');
        const listeningLines = listeningInstruction.value.split('\n');

        vocabularyInst.textContent = vocabularyLines.join('\n');
        grammarInst.textContent = grammarLines.join('\n');
        listeningInst.textContent = listeningLines.join('\n');
    }

    level.addEventListener('change', updateResult);
    year.addEventListener('input', updateResult);
    month.addEventListener('change', updateResult);
    vocabularyInstruction.addEventListener('input', updateResult);
    grammarInstruction.addEventListener('input', updateResult);
    listeningInstruction.addEventListener('input', updateResult);

    updateResult();

    const addPosterLink = document.getElementById('addPosterLink');
    const addQuestionLink = document.getElementById('addQuestionLink');

    const addPosterForm = document.getElementById('addPosterForm');
    const addQuestionForm = document.getElementById('addQuestionForm');

    // Function to show the selected form and hide the other
    function showForm(formToShow, formToHide) {
        formToShow.classList.add('show');
        formToShow.classList.remove('collapse');
        formToHide.classList.add('collapse');
        formToHide.classList.remove('show');
    }

    // Function to set active link
    function setActiveLink(activeLink, inactiveLink) {
        activeLink.classList.add('active');
        inactiveLink.classList.remove('active');
    }

    // Add click event listener to the Add Poster link
    addPosterLink.addEventListener('click', function (event) {
        event.preventDefault();
        showForm(addPosterForm, addQuestionForm);
        setActiveLink(addPosterLink, addQuestionLink);
    });

    // Add click event listener to the Add Questions link
    addQuestionLink.addEventListener('click', function (event) {
        event.preventDefault();
        showForm(addQuestionForm, addPosterForm);
        setActiveLink(addQuestionLink, addPosterLink);
    });

    const form = document.getElementById('questionForm');
    const skillNameElement = document.querySelector('.skill-name');
    const questionElement = document.querySelector('.qtn');
    const descElement = document.querySelector('.desc');
    const optionsContainer = document.querySelector('.options');
    const answerElement = document.querySelector('.ans');
    const qtnType = document.getElementById('qtnType');

    function updatePreview() {
        // Get the values from the form
        const skill = document.getElementById('skills');
        const qtnType = document.getElementById('qtnType');
        const question = document.getElementById('question').value;
        const desc = document.getElementById('desc').value;
        const options = document.getElementById('options').value.split('\n');
        const answerSelect = document.getElementById('answer');

        // Update the preview elements
        skillNameElement.textContent = skill.options[skill.selectedIndex].text;
        questionElement.innerHTML = qtnType.value == 'fill in the blank' ? question.replace(/{}/g, '<span class="blank"></span>') : question;
        // questionElement.textContent = qtnType.value == '3' ? question.replace(/{}/g, '<span class="blank">___</span>') : question;
        descElement.textContent = desc;
        const answer = answerSelect.value;

        // Clear existing options
        optionsContainer.innerHTML = '';
        answerSelect.innerHTML = '';

        // Check if the question type is "Fill in the Blank"
        if (qtnType.value == 'fill in the blank') {
            // Hide the options and answer selection elements
            optionsContainer.style.display = 'none';
            answerSelect.style.display = 'none';
            answerElement.style.display = 'none';
        } else {
            // Show the options and answer selection elements
            optionsContainer.style.display = 'block';
            answerSelect.style.display = 'block';
            answerElement.style.display = 'block';

            // Determine input type based on question type
            const inputType = qtnType.value == 'checkboxes' ? 'checkbox' : 'radio';

            options.forEach((option, index) => {
                const optionLetter = String.fromCharCode(65 + index);
                const optionDiv = document.createElement('div');
                optionDiv.classList.add('option', 'd-flex', 'align-items-center', 'gap-2');

                const input = document.createElement('input');
                input.type = inputType;
                input.name = 'option';
                input.id = `option${index + 1}`;
                input.value = option;

                const label = document.createElement('label');
                label.htmlFor = `option${index + 1}`;
                label.textContent = `${optionLetter}. ${option}`;

                optionDiv.appendChild(input);
                optionDiv.appendChild(label);

                optionsContainer.appendChild(optionDiv);

                const selectOption = document.createElement('option');
                selectOption.value = option;
                selectOption.textContent = `${optionLetter}. ${option}`;
                answerSelect.appendChild(selectOption);
            });

            const selectedIndex = [...answerSelect.options].findIndex(opt => opt.value === answer);
            if (selectedIndex !== -1) {
                answerSelect.selectedIndex = selectedIndex;
            }
            answerElement.textContent = answerSelect.options[answerSelect.selectedIndex]?.textContent || '';
        }
    }

    form.addEventListener('input', updatePreview);
    form.addEventListener('change', updatePreview);

    updatePreview();
});
