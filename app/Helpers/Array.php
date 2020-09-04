<?php

function consistsOfTheSameValues(array $a, array $b)
{
  // check size of both arrays
  if (count($a) !== count($b)) {
    return false;
  }

  foreach ($b as $key => $bValue) {

    // check that expected value exists in the array
    if (!in_array($bValue, $a, true)) {
      return false;
    }

    // check that expected value occurs the same amount of times in both arrays
    if (count(array_keys($a, $bValue, true)) !== count(array_keys($b, $bValue, true))) {
      return false;
    }

  }

  return true;
}
