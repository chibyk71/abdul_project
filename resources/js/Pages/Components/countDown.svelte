<script>
    import { derived } from "svelte/store";

    import { ExamStarted, submitAnswers } from "../../store";

    // Set the exam duration (e.g., 1 hour, 30 minutes = 90 minutes)
    const examDuration = 90 * 60; // in seconds
    let timeLeft = examDuration;

    let countdownElement;

    // Function to format the time as HH:MM:SS
    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;
        return `${hours < 10 ? "0" : ""}${hours}:${minutes < 10 ? "0" : ""}${minutes}:${secs < 10 ? "0" : ""}${secs}`;
    }

    // Update the countdown every second
    const countdownTimer = derived( ExamStarted, ($ExamStarted, set) => {
            let interval;

            if ($ExamStarted) {
                interval = setInterval(() => {
                    if (timeLeft > 0) {
                        timeLeft -= 1;
                        set(formatTime(timeLeft)); // Update formatted time
                    } else {
                        clearInterval(interval);
                        set("Time's up!");
                        $ExamStarted = false;
                        submitAnswers()
                    }
                }, 1000);
            } else {
                set(formatTime(timeLeft))
            }

            return () => clearInterval(interval); // Cleanup on unsubscribe
        }
    );
</script>

<div class="exam-timer flex items-center justify-end mb-4">
    <small>Exam Time Remaining</small>
    <div class:time-up={timeLeft <= 0} class="time ml-4">{$countdownTimer}</div>
</div>

<style>
    .exam-timer {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f8f9fa;
    }

    .exam-timer .time {
        font-size: 24px;
        font-weight: bold;
        color: #3d5ee1;
    }

    .time-up {
        color: #dc3545;
    }
</style>
