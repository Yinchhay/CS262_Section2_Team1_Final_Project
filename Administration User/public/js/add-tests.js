function updateAllElementsByClassName(className, value) {
    const elements = document.querySelectorAll(`.${className}`);
    elements.forEach(element => {
        element.textContent = value;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const difficulty = document.getElementById('difficulty');
    const year = document.getElementById('year');
    const month = document.getElementById('month');
    const vocabularyInstruction = document.getElementById('vocabularyInstruction');
    const vocabularyDuration = document.getElementById('vocabularyDuration');
    const grammarInstruction = document.getElementById('grammarInstruction');
    const grammarDuration = document.getElementById('grammarDuration');
    const listeningInstruction = document.getElementById('listeningInstruction');
    const listeningDuration = document.getElementById('listeningDuration');

    const l = document.getElementById('l');
    const y = document.getElementById('y');
    const m = document.getElementById('m');
    const vocabularyInst = document.getElementById('vocabularyInst');
    const vocabDur = document.getElementById('vocabDur');
    const grammarInst = document.getElementById('grammarInst');
    const grammarDur = document.getElementById('grammarDur');
    const listeningInst = document.getElementById('listeningInst');
    const listeningDur = document.getElementById('listeningDur');

    // const levels = [
    //     "Level",
    //     "Beginner",
    //     "Intermediate",
    //     "Advanced"
    // ];

    // const months = [
    //     "Month",
    //     "January",
    //     "February",
    //     "March",
    //     "April",
    //     "May",
    //     "June",
    //     "July",
    //     "August",
    //     "September",
    //     "October",
    //     "November",
    //     "December"
    // ];

    function updateResult() {
        // l.textContent = difficulty.options[difficulty.selectedIndex].text;
        // y.textContent = year.value;
        // m.textContent = month.options[month.selectedIndex].text;
        updateAllElementsByClassName('l', difficulty.options[difficulty.selectedIndex].text);
        updateAllElementsByClassName('y', year.value);
        updateAllElementsByClassName('m', month.options[month.selectedIndex].text);

        const vocabularyLines = vocabularyInstruction.value.split('\n');
        const grammarLines = grammarInstruction.value.split('\n');
        const listeningLines = listeningInstruction.value.split('\n');

        vocabularyInst.textContent = vocabularyLines.join('\n');
        grammarInst.textContent = grammarLines.join('\n');
        listeningInst.textContent = listeningLines.join('\n');

        vocabDur.textContent = vocabularyDuration.value;
        grammarDur.textContent = grammarDuration.value;
        listeningDur.textContent = listeningDuration.value;
    }

    difficulty.addEventListener('change', updateResult);
    year.addEventListener('input', updateResult);
    month.addEventListener('change', updateResult);
    vocabularyInstruction.addEventListener('input', updateResult);
    grammarInstruction.addEventListener('input', updateResult);
    listeningInstruction.addEventListener('input', updateResult);
    vocabularyDuration.addEventListener('input', updateResult);
    grammarDuration.addEventListener('input', updateResult);
    listeningDuration.addEventListener('input', updateResult);

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
        event.preventDefault(); // Prevent default link behavior
        showForm(addPosterForm, addQuestionForm);
        setActiveLink(addPosterLink, addQuestionLink);
    });

    // Add click event listener to the Add Questions link
    addQuestionLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior
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
        const question = document.getElementById('question').value;
        const desc = document.getElementById('desc').value;
        const options = document.getElementById('options').value.split('\n');
        const answerSelect = document.getElementById('answer');

        // Update the preview elements
        skillNameElement.textContent = skill.options[skill.selectedIndex].text;
        questionElement.textContent = question;
        descElement.textContent = desc;
        const answer = answerSelect.value;

        // Clear existing options
        optionsContainer.innerHTML = '';
        answerSelect.innerHTML = '';

        // Determine input type based on question type
        const inputType = qtnType.value == '2' ? 'checkbox' : 'radio';

        // Add the options dynamically
        options.forEach((option, index) => {
            const optionLetter = String.fromCharCode(65 + index); // Convert index to A, B, C, etc.
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

        // Update the answer
        const selectedIndex = [...answerSelect.options].findIndex(opt => opt.value === answer);
        if (selectedIndex !== -1) {
            answerSelect.selectedIndex = selectedIndex;
        }
        answerElement.textContent = answerSelect.options[answerSelect.selectedIndex]?.textContent || '';
    }

    // Listen for input changes on the form
    form.addEventListener('input', updatePreview);
    form.addEventListener('change', updatePreview);

    // Initial preview update
    updatePreview();
});
