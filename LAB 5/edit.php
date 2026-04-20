<?php
/**
 * Abdul Haseeb | Lab 5 - Modular Edit Handler
 */
require "functions.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch all students via the modular function and find the specific one
$students = getStudents();
$currentStudent = null;

foreach ($students as $student) {
    if ($student['id'] == $id) {
        $currentStudent = $student;
        break;
    }
}

// Redirect if student doesn't exist
if (!$currentStudent) {
    header("Location: index.php?error=not_found");
    exit;
}

if (isset($_POST['submit'])) {
    updateStudent($id, $_POST['name'], $_POST['email'], $_POST['course']);
    
    session_start();
    $_SESSION['message'] = "Student profile updated successfully!";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Abdul Haseeb Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .edit-gradient { background: linear-gradient(135deg, #fffcf5 0%, #fef3c7 100%); }
    </style>
</head>
<body class="edit-gradient min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-lg">
    <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 border border-white relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-2 bg-amber-500"></div>

        <div class="mb-8">
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-600 bg-amber-50 px-3 py-1 rounded-full">ID: #<?= htmlspecialchars($id) ?></span>
            <h2 class="text-3xl font-black text-slate-900 mt-3">Edit Profile</h2>
            <p class="text-slate-500 font-medium">Updating records for <span class="text-slate-900 font-bold"><?= htmlspecialchars($currentStudent['name'] ?? '') ?></span></p>
        </div>

        <form method="POST" class="space-y-5">
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 ml-1" for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($currentStudent['name'] ?? '') ?>" required
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-medium text-slate-800">
            </div>
            
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 ml-1" for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($currentStudent['email'] ?? '') ?>" required
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-medium text-slate-800">
            </div>
            
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 ml-1" for="course">Course</label>
                <input type="text" id="course" name="course" value="<?= htmlspecialchars($currentStudent['course'] ?? '') ?>" required
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 outline-none transition-all font-medium text-slate-800">
            </div>
            
            <div class="pt-6">
                <button type="submit" name="submit"
                    class="w-full bg-amber-500 text-white py-5 rounded-2xl font-bold text-lg hover:bg-amber-600 shadow-xl shadow-amber-200/50 transition-all active:scale-[0.98]">
                    Update Student
                </button>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-50 text-center">
            <a href="index.php" class="text-slate-400 font-bold hover:text-slate-900 transition inline-flex items-center gap-2 text-sm">
                Discard Changes & Return
            </a>
        </div>
    </div>
</div>

</body>
</html>