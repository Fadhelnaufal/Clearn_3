<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('quiz/assets/css/Bootstrap/bootstrap.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('quiz/assets/css/style.css') }}" />
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('quiz/assets/css/animation.css') }}" />
    <!-- Responsive -->
    <link rel="stylesheet" href="{{ asset('quiz/assets/css/responsive.css') }}" />
    <!-- Thank You -->
    <link rel="stylesheet" href="{{ asset('quiz/assets/css/thankyou.css') }}" />
</head>
<body>
<main class="overflow-hidden">
    <!-- Steps Start -->
    <section class="steps container">
        <form class="show-section" id="stepForm" novalidate onsubmit="return false">
            @foreach ($quiz->questions as $index => $question)
            <fieldset id="step{{ $index + 1 }}" style="{{ $index !== 0 ? 'display:none;' : '' }}">
                <!-- Question Number -->
                <div class="qNumber">Question {{ $index + 1 }}</div>
                <!-- Question -->
                <h1 class="question">{{ $question->question_text }}</h1>
                <!-- Step Image -->
                <div class="stepImg">
                    @if(isset($question->question_image) && !empty($question->question_image))
                        <img src="{{ asset('quiz/assets/images/question/' . $question->question_image) }}" alt="Step" />
                    @else
                        <img src="{{ asset('quiz/assets/images/step4.png') }}" alt="Step" />
                    @endif
                </div>
                <!-- Options -->
                <div class="options">
                    @foreach ($question->options as $option)
                    <div class="option animate">
                        <input type="radio" name="op{{ $index + 1 }}" value="{{ $option->id }}" />
                        <label>{{ $option->option_text }}</label>
                    </div>
                    @endforeach
                </div>
            </fieldset>
            @endforeach
        </form>

        <!-- Next/Previous buttons -->
        <div class="nextPrev">
            <button type="button" class="prev" id="prevBtn" style="display:none;">Previous Question</button>
            <button type="button" class="next" id="nextBtn">Next Question</button>
            <button type="button" class="submit" id="submitBtn" style="display:none;">Submit Quiz</button>
        </div>
    </section>

    <!-- result -->
    <div class="loadingresult">
        <img src="{{ asset('quiz/assets/images/loading.gif') }}" alt="loading" />
      </div>
  
      <div class="thankyou-page">
        <header class="thankyouheader">
          <h2>Quiz telah diambil</h2>
        </header>
        <main class="thankyou-page-inner">
          <img src="{{ asset('quiz/assets/images/thankyou-check.png') }}" alt="" />
          <span>Jawaban Anda telah dikirimkan</span>
          <h1>Terima kasih telah mengikuti Kuis {{$quiz->nama}}</h1>

            <a href="{{route('siswa.show.result', $quiz->id)}}" class="btn btn-primary" type="button">Lihat Papan Peringkat</a>

        </main>
      </div>
      <div id="error"></div>
</main>

<!-- Bootstrap JS -->
<script src="{{ asset('quiz/assets/js/Bootstrap/bootstrap.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('quiz/assets/js/jQuery/jquery-3.7.1.min.js') }}"></script>

<script>
    let currentStep = 0; // Track current question index
    const totalSteps = {{ $quiz->questions->count() }}; // Total questions
    const answers = {}; // Object to store answers

    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn'); // Added submit button reference

    // Function to save the current answer
    function saveAnswer() {
        const selectedOption = document.querySelector(`input[name="op${currentStep + 1}"]:checked`);
        if (selectedOption) {
            answers[`question_${currentStep + 1}`] = selectedOption.value; // Store answer
        }
    }

    // Function to show the next question
    function showNext() {
        saveAnswer(); // Save the answer before moving to the next question
        if (currentStep < totalSteps - 1) {
            document.getElementById('step' + (currentStep + 1)).style.display = 'none'; // Hide current step
            currentStep++; // Increment step
            document.getElementById('step' + (currentStep + 1)).style.display = 'block'; // Show next step

            // Update button visibility
            prevBtn.style.display = currentStep > 0 ? 'block' : 'none'; // Show/Hide Previous button
            nextBtn.style.display = currentStep === totalSteps - 1 ? 'none' : 'block'; // Hide Next button on last step
            submitBtn.style.display = currentStep === totalSteps - 1 ? 'block' : 'none'; // Show Submit button on last step
        } else {
            submitQuiz(); // Call the submit function if needed
        }
    }

    // Function to show the previous question
    function showPrev() {
        if (currentStep > 0) {
            document.getElementById('step' + (currentStep + 1)).style.display = 'none'; // Hide current step
            currentStep--; // Decrement step
            document.getElementById('step' + (currentStep + 1)).style.display = 'block'; // Show previous step

            // Update button visibility
            prevBtn.style.display = currentStep > 0 ? 'block' : 'none'; // Show/Hide Previous button
            nextBtn.style.display = currentStep === totalSteps - 1 ? 'none' : 'block'; // Hide Next button on last step
            submitBtn.style.display = currentStep === totalSteps - 1 ? 'block' : 'none'; // Show Submit button on last step
        }
    }

    // Function to handle showing result
    function showresult() {
        $('.loadingresult').css('display', 'grid'); // Show loading

        setTimeout(function() {
            $('.loadingresult').css('display', 'none'); // Hide loading
            $('.thankyou-page').css('display', 'block').addClass('thankyou_show'); // Show thank you page
            $('section').css('display', 'none'); // Optionally hide other sections
        }, 1000); // Adjust this duration as needed (in milliseconds)
    }

    // Function to handle quiz submission
    function submitQuiz() {
        saveAnswer(); // Save the last answer

        // Show loading animation
        document.querySelector('.loadingresult').style.display = 'block'; // Show loading
        document.querySelector('.thankyou-page').style.display = 'none'; // Hide thank you page initially

        // AJAX call to submit the answers
        $.ajax({
            url: "{{ route('siswa.submit-quiz', $quiz->id) }}", // Adjust the route to your controller
            type: 'POST',
            data: {
                answers: answers,
                quiz_id: {{ $quiz->id }}, // Pass the quiz ID
                _token: '{{ csrf_token() }}' // Include CSRF token
            },
            success: function(response) {
                // Handle successful response
                console.log(response);
                showresult(); // Call the showresult function
            },
            error: function(xhr) {
                // Handle error response
                console.error(xhr.responseText);
                // Hide loading animation in case of error
                document.querySelector('.loadingresult').style.display = 'none'; // Hide loading
            }
        });
    }

    // Event listeners for button clicks
    nextBtn.addEventListener('click', showNext);
    prevBtn.addEventListener('click', showPrev);
    submitBtn.addEventListener('click', submitQuiz); // Add event listener for submit button
</script>
</body>
</html>
