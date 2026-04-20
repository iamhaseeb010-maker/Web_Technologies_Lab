<?php
/**
 * Abdul Haseeb | Lab 4 - Student Enrollment (Database Driven)
 */
require_once 'db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first  = trim($_POST['first_name'] ?? '');
    $last   = trim($_POST['last_name'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $dob    = trim($_POST['dob'] ?? null);
    $course = trim($_POST['course'] ?? '');

    // Validation
    if ($first === '' || $last === '') $errors[] = 'First and last name are required.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';

    if (empty($errors)) {
        try {
            $pdo = getPDO();
            $stmt = $pdo->prepare('INSERT INTO students (first_name, last_name, email, dob, course, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
            $stmt->execute([$first, $last, $email, $dob, $course]);
            
            // Redirect with a success flag
            header('Location: index.php?added=1');
            exit;
        } catch (PDOException $e) {
            $errors[] = "Database Error: " . $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student | Abdul Haseeb Records</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc;
        }
        .form-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }
        .input-field {
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0;
        }
        .input-field:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-5xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-100">S</div>
            <span class="text-xl font-bold text-slate-900 tracking-tight">Student<span class="text-indigo-600">Records</span></span>
        </div>
        <div class="flex gap-1 bg-slate-100 p-1 rounded-xl">
            <a href="index.php" class="px-5 py-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition">Dashboard</a>
            <a href="create.php" class="px-5 py-2 text-sm font-bold bg-white text-indigo-600 rounded-lg shadow-sm">Add New</a>
        </div>
    </div>
</nav>

<main class="flex-1 max-w-3xl mx-auto w-full px-6 py-12">
    <div class="form-card overflow-hidden">
        <div class="bg-slate-900 p-10 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl font-extrabold mb-2">New Enrollment</h2>
                <p class="text-slate-400 font-medium">Create a new persistent student record in the SQL database.</p>
            </div>
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/20 rounded-full blur-3xl"></div>
        </div>

        <div class="p-10">
            <?php if ($errors): ?>
                <div class="mb-8 p-5 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <h4 class="text-red-800 font-bold mb-2">Please correct the following:</h4>
                    <ul class="text-red-600 text-sm space-y-1 list-disc ml-5">
                        <?php foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>'; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required placeholder="Jane" 
                               class="input-field w-full px-4 py-3 rounded-xl bg-slate-50 text-slate-900"
                               value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required placeholder="Doe" 
                               class="input-field w-full px-4 py-3 rounded-xl bg-slate-50 text-slate-900"
                               value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700" for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="jane.doe@university.edu" 
                           class="input-field w-full px-4 py-3 rounded-xl bg-slate-50 text-slate-900"
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700" for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" 
                               class="input-field w-full px-4 py-3 rounded-xl bg-slate-50 text-slate-900"
                               value="<?php echo htmlspecialchars($_POST['dob'] ?? ''); ?>">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700" for="course">Assigned Course</label>
                        <input type="text" id="course" name="course" placeholder="Advanced Web Development" 
                               class="input-field w-full px-4 py-3 rounded-xl bg-slate-50 text-slate-900"
                               value="<?php echo htmlspecialchars($_POST['course'] ?? ''); ?>">
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex flex-col md:flex-row gap-4">
                    <button type="submit" class="flex-1 bg-indigo-600 text-white py-4 rounded-2xl font-bold hover:bg-indigo-700 transition transform active:scale-[0.98] shadow-lg shadow-indigo-100">
                        Complete Registration
                    </button>
                    <a href="index.php" class="px-8 py-4 text-center font-bold text-slate-500 hover:text-slate-800 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<footer class="py-10 text-center text-slate-400 text-sm">
    <p>&copy; <?php echo date('Y'); ?> • Abdul Haseeb Student Management System</p>
    <p class="mt-1 text-xs uppercase tracking-widest font-bold opacity-50">Lab 4: PDO Integration</p>
</footer>

</body>
</html>