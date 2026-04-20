<?php
/**
 * Abdul Haseeb | Lab 4 - Edit Student Record
 */
require_once 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$pdo = getPDO();
$stmt = $pdo->prepare('SELECT * FROM students WHERE id = ?');
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) {
    header('Location: index.php?error=not_found');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first  = trim($_POST['first_name'] ?? '');
    $last   = trim($_POST['last_name'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $dob    = trim($_POST['dob'] ?? null);
    $course = trim($_POST['course'] ?? '');

    if ($first === '' || $last === '') $errors[] = 'First and last name are required.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';

    if (empty($errors)) {
        try {
            $upd = $pdo->prepare('UPDATE students SET first_name=?, last_name=?, email=?, dob=?, course=? WHERE id=?');
            $upd->execute([$first, $last, $email, $dob, $course, $id]);
            header('Location: index.php?msg=updated');
            exit;
        } catch (PDOException $e) {
            $errors[] = "Update failed: " . $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile | <?php echo htmlspecialchars($student['first_name']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .input-field { transition: all 0.2s ease; border: 1px solid #e2e8f0; }
        .input-field:focus { border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); outline: none; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-5xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-amber-100">E</div>
            <span class="text-xl font-bold text-slate-900 tracking-tight">Student<span class="text-amber-500">Editor</span></span>
        </div>
        <div class="flex gap-4">
            <a href="index.php" class="text-sm font-bold text-slate-500 hover:text-slate-900 transition">Back to Dashboard</a>
        </div>
    </div>
</nav>

<main class="flex-1 max-w-3xl mx-auto w-full px-6 py-12">
    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
        <div class="bg-amber-500 p-10 text-white relative">
            <div class="relative z-10">
                <span class="bg-amber-400/30 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full border border-amber-300/30 mb-4 inline-block">Editing Record #<?php echo $id; ?></span>
                <h2 class="text-3xl font-extrabold mb-1">Update Profile</h2>
                <p class="text-amber-50 opacity-90">Modifying details for <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></p>
            </div>
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        </div>

        <div class="p-10">
            <?php if ($errors): ?>
                <div class="mb-8 p-5 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <ul class="text-red-600 text-sm font-semibold space-y-1">
                        <?php foreach ($errors as $e) echo '<li>⚠️ ' . htmlspecialchars($e) . '</li>'; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-wider text-slate-400 ml-1" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required 
                               class="input-field w-full px-5 py-4 rounded-2xl bg-slate-50 text-slate-900 font-medium"
                               value="<?php echo htmlspecialchars($_POST['first_name'] ?? $student['first_name']); ?>">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-wider text-slate-400 ml-1" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required 
                               class="input-field w-full px-5 py-4 rounded-2xl bg-slate-50 text-slate-900 font-medium"
                               value="<?php echo htmlspecialchars($_POST['last_name'] ?? $student['last_name']); ?>">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-wider text-slate-400 ml-1" for="email">Email Address</label>
                    <input type="email" id="email" name="email" required 
                           class="input-field w-full px-5 py-4 rounded-2xl bg-slate-50 text-slate-900 font-medium"
                           value="<?php echo htmlspecialchars($_POST['email'] ?? $student['email']); ?>">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-wider text-slate-400 ml-1" for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" 
                               class="input-field w-full px-5 py-4 rounded-2xl bg-slate-50 text-slate-900 font-medium"
                               value="<?php echo htmlspecialchars($_POST['dob'] ?? $student['dob']); ?>">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-wider text-slate-400 ml-1" for="course">Assigned Course</label>
                        <input type="text" id="course" name="course" 
                               class="input-field w-full px-5 py-4 rounded-2xl bg-slate-50 text-slate-900 font-medium"
                               value="<?php echo htmlspecialchars($_POST['course'] ?? $student['course']); ?>">
                    </div>
                </div>

                <div class="pt-8 flex flex-col md:flex-row gap-4">
                    <button type="submit" class="flex-1 bg-amber-500 text-white py-4 rounded-2xl font-bold hover:bg-amber-600 transition transform active:scale-[0.98] shadow-lg shadow-amber-100">
                        Save Changes
                    </button>
                    <a href="index.php" class="px-8 py-4 text-center font-bold text-slate-400 hover:text-slate-600 transition">
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<footer class="py-10 text-center text-slate-400 text-sm">
    &copy; <?php echo date('Y'); ?> • Abdul Haseeb | Lab 4 Edit Interface
</footer>

</body>
</html>