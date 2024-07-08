document.addEventListener('DOMContentLoaded', function () {

    const skillInput = document.getElementById('skills');
    const instructionInput = document.getElementById('instruction');
    const questionTypeSelect = document.getElementById('qtnType');
    const pointInput = document.getElementById('point');
    const questionInput = document.getElementById('question');
    const descInput = document.getElementById('desc');

    const optionsSection = document.getElementById('optionsSection');
    const optionsContainer = document.getElementById('optionsContainer');
    const addOptionButton = document.getElementById('addOption');

    const answerContainer = document.getElementById('answerContainer');

    const skillResult = document.getElementById('skillResult');
    const instructionResult = document.getElementById('instructionResult');
    const pointResult = document.getElementById('pointResult');


    const testSkillsInput = document.getElementById('testSkills');
    const addQuestionBtn = document.getElementById('addQuestionBtn');

    const audioSection = document.getElementById('audioSection');
    const fileInput = document.getElementById('audioFileInput');
    const audioPreview = document.getElementById('audioPreview');
    let selectedAudioFile = null;

    const editQuestionButton = document.getElementById('editQuestion');
    const removeQuestionButton = document.getElementById('removeQuestion');



    let selectedTestSkillIndex = 0;
    let questionResult = document.getElementById(`questionResult-${selectedTestSkillIndex}`);
    let descResult = document.getElementById(`descResult-${selectedTestSkillIndex}`);
    let optionsResult = document.getElementById(`optionsResult-${selectedTestSkillIndex}`);
    let answerResult = document.getElementById(`answerResult-${selectedTestSkillIndex}`);

    const testSkillsList = [{
        skill: 1,
        instruction: "Instruction",
        questions: [{
            question: "Your Question",
            points: 0,
            description: "Description",
            type: "multiple choice",
            options: [{
                text: "Option 1",
                isCorrect: false,
            }],
        }],
        // audio_url: selectedAudioFile,
        duration: null
    }];

    const updateSelectedTestSkillIndex = (index) => {
        selectedTestSkillIndex = index;

        questionResult = document.getElementById(`questionResult-${selectedTestSkillIndex}`);
        descResult = document.getElementById(`descResult-${selectedTestSkillIndex}`);
        optionsResult = document.getElementById(`optionsResult-${selectedTestSkillIndex}`);
        answerResult = document.getElementById(`answerResult-${selectedTestSkillIndex}`);
    }
    const answerElement = document.querySelector('.ans');



    let optionCount = 1;

    const skillNamesElement = document.getElementById('skillNames');
    const skillList = JSON.parse(skillNamesElement.getAttribute('data-skills'));

    pointInput.addEventListener('input', function () {
        pointResult.innerHTML = pointInput.value;
    });

    const updateQuestionNumbers = () => {
        const questionDivs = document.querySelectorAll('.qtn-result');
        questionDivs.forEach((questionDiv, index) => {
            const questionNumberElement = questionDiv.querySelector('.qtn-header .qtn-number');
            questionNumberElement.innerHTML = index + 1;
        });
    };

    const updateAnswerOptions = () => {
        const questionType = questionTypeSelect.value;

        answerContainer.innerHTML = '';
        const optionInputs = document.querySelectorAll('.option-input') ?? [];

        updateSelectedTestSkillIndex(selectedTestSkillIndex);
        optionsResult.innerHTML = '';
        if (questionType === 'multiple choice' || questionType === 'checkboxes') {
            optionInputs.forEach((input, index) => {
                if (input.value.trim() !== '') {
                    const optionDiv = document.createElement('div');
                    optionDiv.className = 'option';
                    optionDiv.innerHTML =
                        `<div class="form-check">
                            <input id="Option${index + 1}" type="${questionType === 'multiple choice' ? 'radio' : 'checkbox'}" class="form-check-input answer-option" name="answer" value="${index + 1}">
                            <label for="Option${index + 1}" class="form-check-label">${input.value}</label>
                        </div>`;

                    const resultOptionDiv = document.createElement('div');
                    resultOptionDiv.className = 'option';
                    resultOptionDiv.innerHTML =
                        `<div class="form-check">
                            <input id="option${index + 1}" type="${questionType === 'multiple choice' ? 'radio' : 'checkbox'}" class="form-check-input answer-option opacity-100" name="answer" value="${index + 1}" disabled>
                            <label for="option${index + 1}" class="form-check-label opacity-100">${input.value}</label>
                        </div>`;

                    answerContainer.appendChild(optionDiv);
                    optionsResult.appendChild(resultOptionDiv);

                    optionDiv.querySelector('.answer-option').addEventListener('change', updateSelectedAnswer);
                }
            });

            // update array
            if (Array.isArray(optionInputs))
            testSkillsList[selectedTestSkillIndex].questions[selectedTestSkillIndex].options = optionInputs.map((input, index) => {
                return {
                    text: input.value,
                    isCorrect: document.getElementById(`Option${index + 1}`)?.checked || false
                };
            }
            );


        } else {

            const answerDiv = document.createElement('div');
            answerDiv.className = 'input-group mb-2';
            answerDiv.innerHTML = `<input type="text" class="form-control" id="answer">`;

            answerContainer.appendChild(answerDiv);

            document.getElementById('answer').addEventListener('input', updateSelectedAnswer);
        }
    };

    const updateSelectedAnswer = () => {
        const questionType = questionTypeSelect.value;

        if (questionType === 'multiple choice' || questionType === 'checkboxes') {
            const allAnswers = document.querySelectorAll('input[name="answer"]');
            allAnswers.forEach(answer => {
                const lowerCaseId = answer.id.toLowerCase();
                const correspondingElement = document.getElementById(lowerCaseId);
                if (correspondingElement) {
                    correspondingElement.checked = answer.checked;
                }
            })
        } else {
            answerElement.textContent = document.getElementById('answer').value;
        }
    };

    const updateResults = () => {
        const questionType = questionTypeSelect.value;

        const selectedSkillName = skillList[skillInput.selectedIndex];
        skillResult.innerHTML = selectedSkillName;

        instructionResult.innerText = instructionInput.value;

        audioSection.style.display = selectedSkillName === 'listening' ? 'block' : 'none';

        questionResult.innerHTML = questionType === 'fill in the blank' ? questionInput.value.replace(/{}/g, '<span class="blank"></span>') : questionInput.value;

        descResult.innerText = descInput.value;

        if (questionType === 'multiple choice' || questionType === 'checkboxes') {
            optionsSection.style.display = 'block';
            answerResult.style.display = 'none';
        }
        else {
            optionsSection.style.display = 'none';
            answerResult.style.display = 'block';
        }

        if (selectedSkillName != 'listening') {
            audioPreview.style.display = 'none';
        }
        else {
            audioPreview.style.display = 'block';
        }

        // update array
        testSkillsList[selectedTestSkillIndex].skill = selectedSkillName;
        testSkillsList[selectedTestSkillIndex].instruction = instructionInput.value;
        testSkillsList[selectedTestSkillIndex].questions[selectedTestSkillIndex].question = questionInput.value;
        testSkillsList[selectedTestSkillIndex].questions[selectedTestSkillIndex].description = descInput.value;
        testSkillsList[selectedTestSkillIndex].questions[selectedTestSkillIndex].type = questionType;


        updateAnswerOptions();
    };

    const addOption = () => {
        optionCount++;
        const optionDiv = document.createElement('div');
        optionDiv.className = 'input-group mb-2';
        optionDiv.innerHTML = `
            <input type="text" class="form-control option-input" name="option">
            <button type="button" class="btn btn-danger remove-option">X</button>
        `;
        optionsContainer.appendChild(optionDiv);
        updateAnswerOptions();
    };

    const removeOption = (event) => {
        if (event.target.classList.contains('remove-option')) {
            event.target.parentElement.remove();
            optionCount--;
            updateAnswerOptions();
        }
    };

    const addQuestion = () => {
        const questionType = questionTypeSelect.value;
        const optionsInputs = Array.from(document.querySelectorAll('.option-input'));

        const options = optionsInputs.map((input, index) => {
            const isChecked = document.querySelector(`input[name="answer"][value="${index + 1}"]`)?.checked;
            return {
                text: input.value,
                isCorrect: isChecked || false
            };
        });

        const question = {
            question: "Your Question",
            points: 0,
            description: "Description",
            type: "multiple choice",
            options: [{
                text: "Option 1",
                isCorrect: false,
            }],
        };

        if (question.type === 'fill in the blank' || question.type === 'short answer') {
            const answer = document.getElementById('answer').value;
            question.options = [{
                text: answer,
                isCorrect: true
            }];
        }

        const selectedSkillIndex = skillInput.selectedIndex;
        if (!testSkillsList[selectedSkillIndex]) {
            testSkillsList[selectedSkillIndex] = {
                skill: skillInput.value,
                instruction: instructionInput.value.replace(/\n/g, '<br>'),
                questions: [],
                // audio_url: selectedAudioFile,
                duration: null
            };
        }

        // questionsList.push(question);

        // const testSkill = {
        //     skill: skillInput.value,
        //     instruction: instructionInput.value,
        //     questions: [...questionsList]
        // };

        // testSkillsList.push(testSkill);
        testSkillsList[selectedSkillIndex].questions.push(question);
        testSkillsInput.value = JSON.stringify(testSkillsList);

        updateSelectedTestSkillIndex(testSkillsList[selectedSkillIndex].questions.length);

        testSkillsList.forEach(testSkill => {
            console.log(testSkill);
        });

        // console.log(questionsList);
        displayQuestions();
        clearForm();

        updateQuestionNumbers();
    };

    // document.addEventListener('click', function (event) {
    //     if (event.target.classList.contains('edit-question-btn')) {
    //         const skillIndex = parseInt(event.target.getAttribute('data-skill-index'));
    //         const questionIndex = parseInt(event.target.getAttribute('data-question-index'));
    //         editQuestion(skillIndex, questionIndex);
    //     }
    // });

    // document.addEventListener('click', function (event) {
    //     if (event.target.classList.contains('remove-question-btn')) {
    //         const skillIndex = parseInt(event.target.getAttribute('data-skill-index'));
    //         const questionIndex = parseInt(event.target.getAttribute('data-question-index'));
    //         removeQuestion(skillIndex, questionIndex);
    //     }
    // });
    // Add event listener to edit a question
    // const editQuestion = (skillIndex, questionIndex) => {
    //     const question = testSkillsList[skillIndex].questions[questionIndex];

    //     pointInput.value = question.points;
    //     questionInput.value = question.question;
    //     descInput.value = question.description;
    //     questionTypeSelect.value = question.type;

    //     if (question.type === 'multiple choice' || question.type === 'checkboxes') {
    //         optionsContainer.innerHTML = '';
    //         question.options.forEach(option => {
    //             const optionDiv = document.createElement('div');
    //             optionDiv.className = 'input-group mb-2';
    //             optionDiv.innerHTML = `
    //             <input type="text" class="form-control option-input" name="option" value="${option.text}">
    //             <button type="button" class="btn btn-danger remove-option">X</button>
    //         `;
    //             optionsContainer.appendChild(optionDiv);
    //         });
    //     } else {
    //         answerContainer.innerHTML = `
    //         <div class="input-group mb-2">
    //             <input type="text" class="form-control" id="answer" value="${question.answer}">
    //         </div>
    //     `;
    //     }

    //     updateResults();

    //     // Remove the old question
    //     testSkillsList[skillIndex].questions.splice(questionIndex, 1);
    //     displayQuestions();
    // };

    // Add event listener to remove a question
    // const removeQuestion = (skillIndex, questionIndex) => {
    //     testSkillsList[skillIndex].questions.splice(questionIndex, 1);
    //     displayQuestions();
    // };

    const removeQuestion = (skillIndex, questionIndex) => {
        if (testSkillsList[skillIndex] && Array.isArray(testSkillsList[skillIndex].questions)) {
            testSkillsList[skillIndex].questions.splice(questionIndex, 1);
            displayQuestions();
        } else {
            console.error(`Error: Unable to remove question at skillIndex ${skillIndex}`);
        }
    };

    const onEditQuestion = (skillIndex, questionIndex) => {
        // console.log("Hello");
        questionTypeSelect.value = testSkillsList[skillIndex].questions[questionIndex].type;
        questionInput.value = testSkillsList[skillIndex].questions[questionIndex].question;
        pointInput.value = testSkillsList[skillIndex].questions[questionIndex].points;
        descInput.value = testSkillsList[skillIndex].questions[questionIndex].description;

        const optionsInputs = document.querySelectorAll('.option-input');
        optionsInputs.forEach((input, index) => {
            input.value = testSkillsList[skillIndex].questions[questionIndex].options[index].text;
        });

        updateSelectedTestSkillIndex(questionIndex)
    }

    const displayQuestions = () => {
        const selectedSkillIndex = skillInput.selectedIndex;
        const questionType = questionTypeSelect.value;
        const questionsDisplay = document.getElementById('questionsDisplay');
        questionsDisplay.innerHTML = '';

        if (!testSkillsList[selectedSkillIndex] || !testSkillsList[selectedSkillIndex].questions) {
            return;
        }

        let questionIndex = 0;
        testSkillsList[selectedSkillIndex].questions.forEach((q, index) => {
            const questionDiv = document.createElement('div');
            questionDiv.className = 'qtn-result flex-grow-1';
            questionDiv.setAttribute('draggable', 'true');
            questionDiv.innerHTML = `
                <div class="text-center" style="height: 20px;">
                    <i class='bx bx-grid-horizontal' style="font-size: 20px;"></i>
                </div>
                <div class="qtn-details">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <h5 class="qtn-header m-0 text-primary" style="font-size: 18px;">Question <span class="qtn-number" id="index">${++questionIndex}</span> (<span id="pointResult">${q.points || 0}</span> pts)</h5>
                        <div>
                            <button class="btn btn-primary btn-sm rounded" data-skill-index="${selectedSkillIndex}" data-question-index="${questionIndex}" id="questionIndex-${questionIndex - 1}"><i class='bx bx-edit-alt fs-14'></i></button>
                            <button class="btn btn-danger btn-sm rounded" id="removeQuestion"
                            data-skill-index="${selectedSkillIndex}" data-question-index="${questionIndex}">X</button>
                        </div>
                    </div>
                    <div class="qtn-desc">
                        <p class="qtn" id="questionResult-${questionIndex - 1}">${q.type === 'fill in the blank' ? q.question.replace(/{}/g, '<span class="blank"></span>') : q.question}</p>
                        <p class="desc fs-14" id="descResult-${questionIndex - 1}">${q.description}</p>
                    </div>
                    <div class="options" id="optionsResult-${questionIndex - 1}">
                        ${q.options.map((option, i) => `
                            <div class="option form-check">
                                <input class="form-check-input opacity-100" type="${q.type === 'multiple choice' ? 'radio' : 'checkbox'}" name="question${index}" id="option${index}-${i}" disabled ${option.isCorrect ? 'checked' : ''}/>
                                <label class="form-check-label opacity-100" for="option${index}-${i}">${option.text}</label>
                            </div>
                        `).join('')}
                    </div>
                    <div class="answer" id="answerResult-${questionIndex - 1}" style="display: ${q.type === 'fill in the blank' || q.type === 'short answer' ? 'block' : 'none'};">
                        <p class="fs-14" style="color: red;">Answer: <span class="ans">${q.answer}</span></p>
                    </div>
                </div>
            `;

            const questionIndexButton = questionDiv.querySelector(`#questionIndex-${questionIndex - 1}`);
            questionIndexButton.addEventListener('click', () => {
                onEditQuestion(selectedSkillIndex, questionIndex - 1);
            });

            questionDiv.addEventListener('dragstart', () => {
                setTimeout(() => {
                    questionDiv.classList.add('dragging');
                }, 0);
            });

            questionDiv.addEventListener('dragend', () => {
                questionDiv.classList.remove('dragging');
                updateQuestionNumbers();
            });

            questionDiv.addEventListener('dragover', e => {
                e.preventDefault();
                const draggingItem = document.querySelector('.dragging');
                const siblings = [...questionsDisplay.querySelectorAll('.qtn-result:not(.dragging)')];
                let nextSibling = siblings.find(sibling => {
                    return e.clientY <= sibling.offsetTop + sibling.offsetHeight / 2;
                });

                questionsDisplay.insertBefore(draggingItem, nextSibling);
            });

            questionDiv.addEventListener('dragenter', e => {
                e.preventDefault();
            });

            questionsDisplay.appendChild(questionDiv);
        });

        updateQuestionNumbers();
    };

    const clearForm = () => {
        questionInput.value = 'Your Question';
        pointInput.value = 0;
        descInput.value = 'Description';
        const optionInputs = document.querySelectorAll('.input-group');
        const optionInput = document.querySelector('.option-input');

        if (optionInputs.length > 1) {
            optionInputs.forEach((input, index) => {
                if (index > 0) {
                    input.parentNode.removeChild(input);
                }
            });
        }

        optionInput.value = 'Option 1';

        answerElement.textContent = '';
        document.querySelectorAll('input[name="answer"]').forEach(input => input.checked = false);
        optionCount = 1;
        updateResults();
        updateQuestionNumbers();
    };

    const previewAudio = (file) => {
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const audioUrl = e.target.result;
            selectedAudioFile = audioUrl;

            const audioElement = document.createElement('audio');
            audioElement.controls = true;
            audioElement.src = audioUrl;
            audioElement.id = 'audioControl';

            audioPreview.innerHTML = '';
            audioPreview.appendChild(audioElement);
        };
        reader.readAsDataURL(file);
    };

    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        previewAudio(file);
    });

    // skillInput.addEventListener('change', updateResults);
    skillInput.addEventListener('change', () => {
        updateResults();
        displayQuestions();
    });
    instructionInput.addEventListener('input', updateResults);
    questionTypeSelect.addEventListener('change', updateResults);
    questionInput.addEventListener('input', updateResults);
    // pointInput.addEventListener('input', updateResults);
    descInput.addEventListener('input', updateResults);

    addOptionButton.addEventListener('click', addOption);
    optionsContainer.addEventListener('click', removeOption);
    optionsContainer.addEventListener('input', updateAnswerOptions);

    addQuestionBtn.addEventListener('click', addQuestion);
    // editQuestionButton.addEventListener('click', editQuestion);
    // removeQuestionButton.addEventListener('click', removeQuestion);

    const items = document.querySelectorAll('.qtn-result');
    const qtnsResult = document.querySelector('.qtns-result');

    items.forEach(item => {
        item.addEventListener('dragstart', () => {
            setTimeout(() => {
                item.classList.add('dragging');
            }, 0);
        });
        item.addEventListener('dragend', () => {
            item.classList.remove('dragging');
            // updateQuestionNumbers();
        });
    });

    // qtnsResult.addEventListener('dragover', e => {
    //     e.preventDefault();
    //     const draggingItem = document.querySelector('.dragging');
    //     const siblings = [...qtnsResult.querySelectorAll('.qtn-result:not(.dragging)')];
    //     let nextSibling = siblings.find(sibling => {
    //         return e.clientY <= sibling.offsetTop + sibling.offsetHeight / 2;
    //     });

    //     qtnsResult.insertBefore(draggingItem, nextSibling);
    // });

    // qtnsResult.addEventListener('dragenter', e => {
    //     e.preventDefault();
    // });

    qtnsResult.addEventListener('dragover', e => {
        e.preventDefault();
        const draggingItem = document.querySelector('.dragging');
        const siblings = [...qtnsResult.querySelectorAll('.qtn-result:not(.dragging)')];
        let nextSibling = siblings.find(sibling => {
            return e.clientY <= sibling.offsetTop + sibling.offsetHeight / 2;
        });

        if (draggingItem && draggingItem !== qtnsResult && !qtnsResult.contains(draggingItem)) {
            qtnsResult.insertBefore(draggingItem, nextSibling);
        }
    });

    qtnsResult.addEventListener('dragenter', e => {
        e.preventDefault();
    });

    displayQuestions();
});
