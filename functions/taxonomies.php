<?php
$includes = [
  'staff_category',
  'pa_category',
  'vacancy_category'
];

$func_error = '';

array_map(function ($file) use ($func_error) {
  $file = "functions/taxonomies/{$file}.php";

  if (!locate_template($file, true, true)) {
    $func_error(sprintf(__('Error locating <code>%s</code> for inclusion.'), $file), 'File not found');
  }
}, $includes);
