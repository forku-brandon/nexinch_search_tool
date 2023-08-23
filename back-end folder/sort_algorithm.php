<?php

// Function to search for a word in a text using ASCII code
function search($text, $word) {
  // Get the ASCII code of the search term
  $search_term_ascii = ord($word);

  // Convert the text to an array of ASCII codes
  $text_ascii = [];
  for ($i = 0; $i < strlen($text); $i++) {
    $text_ascii[$i] = ord($text[$i]);
  }

  // Check if the search term is found in the text
  $found = false;
  for ($i = 0; $i < count($text_ascii); $i++) {
    if ($text_ascii[$i] == $search_term_ascii) {
      $found = true;
      break;
    }
  }

  // Return whether the word was found
  return $found;
}

// Get the text to search
$text = 'This is a text with the word "search" in it.';

// Get the search term
$search_term = 'search';

// Search for the word in the text using ASCII code
$found = search($text, $search_term);

// Print the results
if ($found) {
  echo 'The word "' . $search_term . '" was found in the text.';
} else {
  echo 'The word "' . $search_term . '" was not found in the text.';
}

?>
