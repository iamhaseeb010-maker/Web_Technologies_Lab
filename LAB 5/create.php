<?php
/**
 * Abdul Haseeb | Lab 5 - Modular Student Management
 * Logic is handled via functions.php for better code reuse.
 */
session_start();
require "functions.php";

if (isset($_POST['submit'])) {
    // We pass the data to our modular function
    addStudent($_POST['name'], $_POST['email'], $_POST['course']);
    
    $_SESSION['message'] = "Student added successfully!";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student | Lab 5 Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%); }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-lg">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-black text-slate-800 tracking-tight">Student<span class="text-amber-600">Portal</span></h1>
        <p class="text-slate-500 mt-2 font-medium">Modular System Architecture (Lab 5)</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 border border-white">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900">Add New Student</h2>
            <div class="h-1 w-12 bg-amber-500 rounded-full mt-2"></div>
        </div>

        <form method="POST" class="space-y-6">
            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="name">Student Name</label>
                <input type="text" id="name" name="name" placeholder="Enter student name" required
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="student@university.edu" required
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-700 ml-1" for="course">Course</label>
                <input type="text" id="course" name="course" placeholder="e.g. Computer Science" required
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all">
            </div>
            
            <div class="pt-4">
                <button type="submit" name="submit"
                    class="w-full bg-slate-900 text-white py-5 rounded-2xl font-bold text-lg hover:bg-slate-800 shadow-xl transition-all active:scale-[0.98]">
                    Save Student Record
                </button>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-50 text-center">
            <a href="index.php" class="text-slate-400 font-bold hover:text-amber-600 transition inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>

    <p class="text-center mt-8 text-slate-400 text-xs font-bold uppercase tracking-widest">
        &copy; 2026 Developed by Abdul Haseeb
    </p>
</div>

</body>
</html>