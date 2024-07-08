<div class="qtn-result flex-grow-1" draggable="true">
    <div class="text-center" style="height: 20px;">
        <i class='bx bx-grid-horizontal' style="font-size: 20px;"></i>
    </div>
    <div class="qtn-details">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <h5 class="qtn-header m-0 text-primary" style="font-size: 18px;">
                Question <span class="qtn-number" id="index">1</span> (<span
                    id="pointResult">0</span> pts)
            </h5>
            <div>
                <button class="btn btn-primary btn-sm rounded" id="editQuestion"
                    data-skill-index="0" data-question-index="0"><i
                        class='bx bx-edit-alt fs-14'></i></button>
                <button class="btn btn-danger btn-sm rounded" id="removeQuestion"
                    data-skill-index="0" data-question-index="0">X</button>
            </div>
        </div>
        <div class="qtn-desc">
            <p class="qtn" id="questionResult">Your Question</p>
            <p class="desc fs-14" id="descResult">Description</p>
        </div>
        <div class="options py-1" id="optionsResult">
            <div class="option form-check">
                <input class="form-check-input opacity-100" type="radio" name=""
                    id="" disabled>
                <label class="form-check-label opacity-100" for="">Option 1</label>
            </div>
        </div>
        <div id="answerResult" style="display: none;">
            <p class="fs-14" style="color: red;">Answer: <span class="ans">Option 1</span>
            </p>
        </div>
    </div>
</div>
