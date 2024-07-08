<?php

// Game: Guessing Game

// Initialize the secret number
$secretNumber = rand(1, 100);

// Initialize the number of attempts
$attempts = 0;

// Game loop
while (true) {
  // Ask the user to guess the number
  echo "Guess a number between 1 and 100: ";
  $guess = trim(fgets(STDIN));

  // Check if the user wants to quit
  if ($guess == "quit") {
    echo "Goodbye!";
    break;
  }

  // Check if the guess is valid
  if (!is_numeric($guess) || $guess < 1 || $guess > 100) {
    echo "Invalid guess. Please try again.\n";
    continue;
  }

  // Increment the number of attempts
  $attempts++;

  // Check if the guess is correct
  if ($guess == $secretNumber) {
    echo " Congratulations! You guessed the number in $attempts attempts.\n";
    break;
  } elseif ($guess < $secretNumber) {
    echo "Too low! Try again.\n";
  } else {
    echo "Too high! Try again.\n";
  }
}

?>
