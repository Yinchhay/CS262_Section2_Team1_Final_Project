<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poster;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestSkill;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\QuestionOption;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Typography\FontFactory;

class ApiController extends Controller
{
    //Store function for validation
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|string|in:poster,question,test-material,test-online-test',
                'level' => 'required_if:type,poster',
                'year' => 'required_if:type,poster|integer|min:2022|max:2072',
                'month' => 'required_if:type,poster',
                'question_text' => 'required_if:type,question',
                'description' => 'required_if:type,question',
                'question_type' => 'required_if:type,question',
                'points' => 'required_if:type,question|integer|min:1',
                'skills' => 'required_if:type,question|array|exists:skills,id',
                'poster_id' => 'required_if:type,test-material,test-online-test|exists:posters,id',
                'audio_file' => 'sometimes|required_if:type,test-material|file|mimes:mp3,wav',
                'order' => 'nullable',
            ]);

        // Map custom types to database enum values
        if ($validated['type'] === 'test-material') {
            $validated['type'] = 'materials';
        }
        if ($validated['type'] === 'test-online-test') {
            $validated['type'] = 'online-tests';
        }

        if ($validated['type'] === 'poster') {
            return $this->storePoster($validated);
        } elseif ($validated['type'] === 'question') {
            return $this->storeQuestion($validated);
        } elseif (in_array($validated['type'], ['materials', 'online-tests'])) {
            return $this->storeTest($validated, $request);
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation failed: ' . json_encode($e->errors()));
        return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        // Enhanced error logging
        Log::error('Error in store method: ' . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());
        return response()->json(['message' => 'Server error', 'details' => $e->getMessage()], 500);
    }
    }

    //Store function to store poster
    private function storePoster(array $validated)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read('images/Material_Poster_Sample.png');

        $elements = ['level', 'year', 'month'];

        $properties = [
            'textWidth' => [],
            'textYOffset' => [],
            'text' => [],
            'color' => [],
            'fontsize' => [],
            'font' => []
        ];

        $staticProperties = [
            'textYOffset' => [
                'level' => $image->height() * 0.485,
                'year' => $image->height() * 0.595,
                'month' => $image->height() * 0.77
            ],
            'text' => [
                'level' => $validated['level'],
                'year' => $validated['year'],
                'month' => $validated['month']
            ],
            'color' => [
                'level' => 'fff',
                'year' => 'fff',
                'month' => '9B5BDC'
            ],
            'fontsize' => [
                'level' => 120,
                'year' => 211,
                'month' => 80
            ],
            'font' => [
                'level' => public_path('fonts/Poppins/Poppins-Medium.ttf'),
                'year' => public_path('fonts/Poppins/Poppins-Bold.ttf'),
                'month' => public_path('fonts/Poppins/Poppins-Bold.ttf')
            ]
        ];

        foreach ($elements as $element) {
            $properties['textWidth'][$element] = ($image->width() - strlen($validated[$element]) + 10) / 2;
        }

        foreach ($staticProperties as $property => $values) {
            foreach ($elements as $element) {
                $properties[$property][$element] = $values[$element];
            }
        }

        foreach ($elements as $element) {
            $image->text(ucwords($properties['text'][$element]), $properties['textWidth'][$element], $properties['textYOffset'][$element], function (FontFactory $font) use ($properties, $element) {
                $font->filename($properties['font'][$element]);
                $font->size($properties['fontsize'][$element]);
                $font->color($properties['color'][$element]);
                $font->align('center');
                $font->valign('middle');
            });
        }

        $filename = uniqid() . '.png';
        $relativePath = 'posters/' . $filename;
        $fullPath = storage_path('app/public/' . $relativePath);
        $image->save($fullPath, 'png');

        $poster = Poster::create([
            'title' => 'Engish Material ' . $validated['level'] . ' ' . $validated['year'] . ' ' . $validated['month'],
            'level' => $validated['level'],
            'year' => $validated['year'],
            'month' => $validated['month'],
            'image' => $relativePath,
            'publish_date' => now(),
            'taken' => 0
        ]);

        return response()->json(['message' => 'Poster created successfully!', 'poster' => $poster], 201);
    }
    //Store function to retrieve poster
    public function getPosters()
    {
        try {
            $posters = Poster::all();
            return response()->json($posters);
        } catch (\Exception $e) {
            Log::error('Error retrieving posters: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve posters.', 'error' => $e->getMessage()], 500);
        }
    }
    // Delete funcstion to delete a poster by ID
    public function deletePoster($id)
    {
        try {
            $poster = Poster::findOrFail($id);
            $poster->delete();

            return response()->json(['message' => 'Poster deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting poster: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete poster.', 'error' => $e->getMessage()], 500);
        }
    }
    
    // fcuntion to add questions to database
    private function storeQuestion(array $validated)
    {
        Log::info('storeQuestion called with data: ' . json_encode($validated));
    
        try {
            Log::info('Creating question...');
            $question = Question::create([
                'question_text' => $validated['question_text'],
                'description' => $validated['description'],
                'question_type' => $validated['question_type'],
                'points' => $validated['points'],
                'test_skill_id' => 1, 
            ]);
    
            Log::info('Question created: ' . json_encode($question));
    
    
            Log::info('Question created successfully: ' . json_encode($question));
            return response()->json(['message' => 'Question created successfully!', 'question' => $question], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating question: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to create question.', 'error' => $e->getMessage()], 500);
        }
    }
    // get function to retrieve questions from dataabse
    public function getQuestions()
    {
        try {
            $questions = Question::with('skills')->get();
            return response()->json($questions);
        } catch (\Exception $e) {
            Log::error('Error retrieving questions: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve questions.', 'error' => $e->getMessage()], 500);
        }
    }
    // Delete function t odelete a question by ID
    public function deleteQuestion($id)
    {
        try {
            $question = Question::findOrFail($id);
            $question->delete();

            return response()->json(['message' => 'Question deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting question: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete question.', 'error' => $e->getMessage()], 500);
        }
    }
    //function to add test to database
    private function storeTest(array $validated, Request $request)
    {
        try {
            Log::info('storeTest called with validated data: ' . json_encode($validated));
            
            Log::info('Type value:', ['type' => $validated['type']]);
    
            $audioFile = $request->file('audio_file');
            if ($audioFile) {
                $audioFileName = $audioFile->getClientOriginalName();
                $audioFile->move(storage_path('audio'), $audioFileName);
            } else {
                $audioFileName = null;
            }
    
            $test = Test::create([
                'type' => $validated['type'],
                'order' => $validated['order'],
                'poster_id' => $validated['poster_id'],
            ]);
    
            Log::info('Test record created: ' . json_encode($test));
    
            $testSkillsData = $request->get('testSkills');
            if (is_string($testSkillsData)) {
                $testSkillsData = json_decode($testSkillsData, true);
            }
    
            if (is_array($testSkillsData)) {
                foreach ($testSkillsData as $testSkillData) {
                    Log::debug('Test Skill Data: ' . json_encode($testSkillData));
                    $testSkill = TestSkill::create([
                        'test_id' => $test->id,
                        'skill_id' => $testSkillData['skill'],
                        'instruction' => $testSkillData['instruction'],
                        'audio' => $audioFileName,
                        'duration' => $testSkillData['duration'] ?? null,
                    ]);
    
                    Log::info('TestSkill created: ' . json_encode($testSkill));
    
                    foreach ($testSkillData['questions'] as $questionData) {
                        Log::debug('Question Data: ' . json_encode($questionData));
                        $question = Question::create([
                            'question_text' => $questionData['question'],
                            'description' => $questionData['description'],
                            'question_type' => $questionData['type'],
                            'points' => $questionData['points'],
                            'test_skill_id' => $testSkill->id,
                            'order' => $questionData['order'] ?? 0,
                        ]);
    
                        Log::info('Question created: ' . json_encode($question));
    
                        if (in_array($questionData['type'], ['multiple choice', 'checkboxes'])) {
                            foreach ($questionData['options'] as $index => $optionData) {
                                Log::debug('Option Data: ' . json_encode($optionData));
                                $question->options()->create([
                                    'option_text' => $optionData['text'],
                                    'is_correct' => $optionData['isCorrect'],
                                    'question_id' => $question->id,
                                    'order' => $index + 1,
                                ]);
                            }
                        }
                    }
                }
            }
    
            return response()->json(['message' => 'Test and Test Skills created successfully!'], 201);
        } catch (\Exception $e) {
            Log::error('Error creating test: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to create test.', 'error' => $e->getMessage()], 500);
        }
    }
    // Get function to retrieve tests from database
    public function getTests()
    {
        try {
            $tests = Test::with('testSkills.questions.options')->get();
            return response()->json($tests);
        } catch (\Exception $e) {
            Log::error('Error retrieving tests: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve tests.', 'error' => $e->getMessage()], 500);
        }
    }
    // Delete function to delete a test by ID
    public function deleteTest($id)
    {
        try {
            $test = Test::findOrFail($id);
            $test->delete();

            return response()->json(['message' => 'Test deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting test: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete test.', 'error' => $e->getMessage()], 500);
        }
    }

    // functions to retrive test skills from madabase
    public function getTestSkills()
    {
        try {
            $testSkills = TestSkill::with('questions.options')->get();
            return response()->json($testSkills);
        } catch (\Exception $e) {
            Log::error('Error retrieving test skills: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve test skills.', 'error' => $e->getMessage()], 500);
        }
    }
    // fcuntion to add skill to database
    public function addSkill(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:skills,name',
            ]);

            $skill = Skill::create([
                'name' => $validated['name'],
            ]);

            return response()->json(['message' => 'Skill created successfully!', 'skill' => $skill], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating skill: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to create skill.', 'error' => $e->getMessage()], 500);
        }
    }
    // fcuntion to retrive the skills from databas
    public function getSkills()
    {
        $skills = Skill::all();
        return response()->json($skills);
    }
    // Delete fcuntiom to delete a skill by ID
    public function deleteSkill($id)
    {
        try {
            $skill = Skill::findOrFail($id);
            $skill->delete();

            return response()->json(['message' => 'Skill deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting skill: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete skill.', 'error' => $e->getMessage()], 500);
        }
    }
    // function to retrieve question type 
    public function getQuestionTypes()
    {
        $questionTypes = Question::getQuestionTypes();
        return response()->json($questionTypes);
    }
    //Register function
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'phone_number' => $request->phone_number,
            'is_admin' => $request->is_admin ?? false,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    //login function
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    //logout function
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    //update user function
    public function update(Request $request, $id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:100',
            'last_name' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8|confirmed',
            'country' => 'sometimes|string|max:50',
            'is_admin' => 'sometimes|boolean',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user->update($request->only('first_name', 'last_name', 'email', 'country', 'phone_number', 'is_admin'));
    
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
    
        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    //delete user function
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    // get all user form database
    public function getAllUsers()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    // Get function to retrieve a test by ID
    public function getTestById($id)
    {
        try {
            $test = Test::with('testSkills.questions.options')->findOrFail($id);
            $formattedTest = $test->toArray();
            foreach ($formattedTest['test_skills'] as &$skill) {
                foreach ($skill['questions'] as &$question) {
                    unset($question['test_skill_id']);
                    foreach ($question['options'] as &$option) {
                        unset($option['is_correct']);
                    }
                    $question['user_answer'] = null;
                }
            }

            unset($formattedTest['created_at']);
            unset($formattedTest['updated_at']);
            foreach ($formattedTest['test_skills'] as &$skill) {
                unset($skill['created_at']);
                unset($skill['updated_at']);
                foreach ($skill['questions'] as &$question) {
                    unset($question['created_at']);
                    unset($question['updated_at']);
                    foreach ($question['options'] as &$option) {
                        unset($option['created_at']);
                        unset($option['updated_at']);
                    }
                }
            }

            return response()->json($formattedTest);
        } catch (\Exception $e) {
            Log::error('Error retrieving test: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve test.', 'error' => $e->getMessage()], 500);
        }

        
    }

    //fiunction to save the user answer
    public function saveUserAnswer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'question_id' => 'required|exists:questions,id', 
            'selected_option_id' => 'required|exists:question_options,id', 
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $selectedOption = QuestionOption::find($request->input('selected_option_id'));
        $question = Question::find($request->input('question_id'));
    
        if (!$selectedOption) {
            return response()->json(['error' => 'Selected option not found'], 400);
        }
    
        if (!$question) {
            return response()->json(['error' => 'Question not found'], 400);
        }
    
        if (!isset($selectedOption->is_correct)) {
            return response()->json(['error' => 'is_correct attribute is missing or null'], 400);
        }
    
        if (!isset($question->points)) {
            return response()->json(['error' => 'Question point is missing or null'], 400);
        }
    
        $score = $selectedOption->is_correct ? $question->points : 0;
    
        Log::info('Selected Option:', ['selected_option' => $selectedOption]);
        Log::info('Question:', ['question' => $question]);
        Log::info('Score calculated:', ['score' => $score]);
    
        $userAnswer = new UserAnswer([
            'user_id' => $user->id,
            'question_id' => $request->input('question_id'),
            'selected_option_id' => $request->input('selected_option_id'),
            'score' => $score,
        ]);
    
        Log::info('User Answer:', ['user_answer' => $userAnswer]);
    
        try {
            $userAnswer->save();
        } catch (\Exception $e) {
            Log::error('Error saving user answer:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error saving user answer'], 500);
        }
    
        return response()->json(['message' => 'User answer saved', 'score' => $score], 201);
    }
    
}
