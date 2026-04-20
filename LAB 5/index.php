<?php
/**
 * Abdul Haseeb | Lab 5 - Student Dashboard
 * Modernized UI for File-Based Management
 */
session_start();
require "functions.php";

// Fetch data from students.txt via your modular function
$students = getStudents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | Abdul Haseeb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .portal-bg { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
    </style>
</head>
<body class="portal-bg min-h-screen p-4 md:p-12">

<div class="max-w-5xl mx-auto">
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="mb-8 flex items-center p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-2xl shadow-sm animate-fade-in">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3 font-bold text-emerald-800">
                <?= $_SESSION['message'] ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Student<span class="text-amber-500">Portal</span></h1>
            <p class="text-slate-500 font-medium mt-1">Lab 5: File-Based Record Management</p>
        </div>
        <a href="create.php" class="inline-flex items-center justify-center px-6 py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 shadow-xl shadow-slate-200 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New Student
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Student Profile</th>
                        <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400">Course</th>
                        <th class="px-8 py-6 text-xs font-black uppercase tracking-widest text-slate-400 text-right">Options</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php if (empty($students)): ?>
                        <tr>
                            <td colspan="3" class="px-8 py-20 text-center">
                                <div class="text-slate-300 font-bold text-lg">No records found in students.txt</div>
                                <p class="text-slate-400 text-sm mt-1">Add your first student to get started.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $student): ?>
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-900 text-lg"><?= htmlspecialchars($student['name']) ?></span>
                                    <span class="text-slate-400 text-sm font-medium"><?= htmlspecialchars($student['email']) ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-block bg-amber-50 text-amber-700 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wide">
                                    <?= htmlspecialchars($student['course']) ?>
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="edit.php?id=<?= $student['id'] ?>" 
                                       class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:border-amber-500 hover:text-amber-600 transition shadow-sm">
                                        Edit
                                    </a>
                                    <a href="delete.php?id=<?= $student['id'] ?>" 
                                       onclick="return confirm('Abdul, are you sure you want to delete this record?')"
                                       class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:border-red-500 hover:text-red-600 transition shadow-sm">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="mt-12 text-center">
        <div class="inline-block px-4 py-2 bg-white rounded-full shadow-sm border border-slate-100">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                &copy; 2026 Developed by <span class="text-slate-900">Abdul Haseeb</span>
            </p>
        </div>
    </footer>

</div>

</body>
</html>