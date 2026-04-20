<?php
/**
 * Abdul Haseeb | Lab 5 - Functions Library
 * This file handles all File System operations (CRUD) modularly.
 */

$file = "students.txt";

/**
 * READ: Fetches all students from the text file
 */
function getStudents() {
    global $file;

    if (!file_exists($file)) {
        return [];
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $students = [];

    foreach ($lines as $line) {
        // Explode the string by the pipe symbol
        $parts = explode("|", $line);
        
        // Basic check to ensure the line has all 4 pieces of data
        if (count($parts) === 4) {
            list($id, $name, $email, $course) = $parts;
            $students[] = [
                "id"     => $id,
                "name"   => $name,
                "email"  => $email,
                "course" => $course
            ];
        }
    }

    return $students;
}

/**
 * CREATE: Appends a new student to the end of the file
 */
function addStudent($name, $email, $course) {
    global $file;

    // Use current timestamp as a unique ID
    $id = time();
    $data = "$id|$name|$email|$course" . PHP_EOL;
    
    return file_put_contents($file, $data, FILE_APPEND);
}

/**
 * DELETE: Filters out the ID and overwrites the file
 */
function deleteStudent($id) {
    global $file;

    $students = getStudents();
    $newContent = "";

    foreach ($students as $student) {
        if ($student['id'] != $id) {
            $newContent .= "{$student['id']}|{$student['name']}|{$student['email']}|{$student['course']}" . PHP_EOL;
        }
    }

    return file_put_contents($file, $newContent);
}

/**
 * UPDATE: Replaces specific student data and overwrites the file
 */
function updateStudent($id, $name, $email, $course) {
    global $file;

    $students = getStudents();
    $newContent = "";

    foreach ($students as $student) {
        if ($student['id'] == $id) {
            // Write the new data for the matching ID
            $newContent .= "$id|$name|$email|$course" . PHP_EOL;
        } else {
            // Keep the old data for others
            $newContent .= "{$student['id']}|{$student['name']}|{$student['email']}|{$student['course']}" . PHP_EOL;
        }
    }

    return file_put_contents($file, $newContent);
}