document.addEventListener('DOMContentLoaded', function () {
    const optionsContainer = document.getElementById('optionsContainer');
    const addOptionBtn = document.getElementById('addOption');
    const optionsSection = document.getElementById('optionsSection');
    const answerContainer = document.getElementById('answerContainer');
    const qtnTypeSelect = document.getElementById('qtnType');

    const createOptionElement = (optionNumber) => {
        const optionGroup = document.createElement('div');
        optionGroup.className = 'input-group mb-2';

        const optionInput = document.createElement('input');
        optionInput.type = 'text';
        optionInput.className = 'form-control option-input';
        optionInput.name = 'options[]';
        optionInput.placeholder = `Option ${optionNumber}`;

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-danger remove-option';
        removeBtn.textContent = 'X';

        optionGroup.appendChild(optionInput);
        optionGroup.appendChild(removeBtn);

        return optionGroup;
    };

    const createAnswerElement = (optionNumber) => {
        const formCheck = document.createElement('div');
        formCheck.className = 'form-check';

        const answerOption = document.createElement('input');
        answerOption.type = 'radio';
        answerOption.className = 'form-check-input answer-option';
        answerOption.name = 'answer';
        answerOption.id = `option${optionNumber}`;

        const answerLabel = document.createElement('label');
        answerLabel.className = 'form-check-label';
        answerLabel.setAttribute('for', `option${optionNumber}`);
        answerLabel.textContent = `Option ${optionNumber}`;

        formCheck.appendChild(answerOption);
        formCheck.appendChild(answerLabel);

        return formCheck;
    };

    const addOption = () => {
        const optionCount = optionsContainer.children.length + 1;
        const newOption = createOptionElement(optionCount);
        optionsContainer.appendChild(newOption);

        const newAnswer = createAnswerElement(optionCount);
        answerContainer.appendChild(newAnswer);
    };

    const removeOption = (event) => {
        const button = event.target;
        const optionGroup = button.parentElement;
        const optionIndex = Array.from(optionsContainer.children).indexOf(optionGroup);

        optionsContainer.removeChild(optionGroup);
        answerContainer.removeChild(answerContainer.children[optionIndex]);
    };

    const handleQuestionTypeChange = () => {
        const selectedType = qtnTypeSelect.value;
        if (selectedType === 'fill in the blank' || selectedType === 'short answer') {
            optionsSection.style.display = 'none';
            answerContainer.innerHTML = `
                <input type="text" class="form-control" id="answer" name="answer">
            `;
        } else {
            optionsSection.style.display = 'block';
            answerContainer.innerHTML = '';
            optionsContainer.querySelectorAll('.option-input').forEach((input, index) => {
                const newAnswer = createAnswerElement(index + 1);
                answerContainer.appendChild(newAnswer);
            });
        }
    };

    addOptionBtn.addEventListener('click', addOption);
    optionsContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-option')) {
            removeOption(event);
        }
    });
    qtnTypeSelect.addEventListener('change', handleQuestionTypeChange);

    // Initialize the form state based on the current question type
    handleQuestionTypeChange();
});
