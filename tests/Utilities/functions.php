<?php

function create($class, $attributes = [], $amount = 1)
{
  if ($amount > 1) {
    return factory($class, $amount)->create($attributes);
  }
  return factory($class)->create($attributes);
}

function make($class, $attributes = [], $amount = 1)
{
  if ($amount > 1) {
    return factory($class)->make($attributes);
  }
  return factory($class)->make($attributes);
}
