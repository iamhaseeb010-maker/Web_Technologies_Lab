<?php
/**
 * Abdul Haseeb | Lab 4 - Main Dashboard (The "Read" in CRUD)
 */
require_once 'db.php';

$pdo = getPDO();
$stmt = $pdo->query('SELECT * FROM students ORDER BY id DESC');
$students = $stmt->fetchAll();

// Handle various feedback messages
$message = '';
$msgType = 'success';

if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'updated') $message = "Student record updated successfully!";
}
if (isset($_GET['added'])) {
    $message = "New student enrolled successfully!";
}
if (isset($_GET['deleted'])) {
    $message = "Student record has been permanently removed.";
    $msgType = 'danger';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard | Abdul Haseeb Student Records</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
        .table-row-hover:hover { background-color: #f1f5f9; transition: all 0.2s; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-100">S</div>
            <span class="text-xl font-bold text-slate-900 tracking-tight">Student<span class="text-indigo-600">Records</span></span>
        </div>
        <div class="flex gap-2 bg-slate-100 p-1 rounded-xl">
            <a href="index.php" class="px-5 py-2 text-sm font-bold bg-white text-indigo-600 rounded-lg shadow-sm">Dashboard</a>
            <a href="create.php" class="px-5 py-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition">Add New</a>
        </div>
    </div>
</nav>

<main class="flex-1 max-w-6xl mx-auto w-full px-6 py-10">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">Student Directory</h1>
            <p class="text-slate-500 font-medium italic">Database: <span class="text-indigo-600 not-italic font-bold">crud_system</span></p>
        </div>
        <a href="create.php" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-indigo-700 transition transform active:scale-95 shadow-xl shadow-indigo-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Enroll New Student
        </a>
    </div>

    <?php if ($message): ?>
        <div class="mb-8 p-4 rounded-2xl flex items-center gap-3 animate-bounce-short <?php echo $msgType === 'danger' ? 'bg-red-50 text-red-700 border border-red-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-100'; ?>">
            <span class="text-xl"><?php echo $msgType === 'danger' ? '🗑️' : '✨'; ?></span>
            <p class="font-bold text-sm"><?php echo htmlspecialchars($message); ?></p>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <?php if (count($students) === 0): ?>
            <div class="p-20 text-center">
                <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">📭</div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No Records Found</h3>
                <p class="text-slate-500 mb-8 max-w-xs mx-auto">The students table is currently empty. Start by adding your first student.</p>
                <a href="create.php" class="text-indigo-600 font-bold hover:underline">Add First Student &rarr;</a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400">ID</th>
                            <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400">Student Info</th>
                            <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400">Email</th>
                            <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400">Course</th>
                            <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach ($students as $s): ?>
                            <tr class="table-row-hover group">
                                <td class="px-8 py-6">
                                    <span class="text-slate-400 font-bold text-sm">#<?php echo $s['id']; ?></span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 font-bold text-xs uppercase">
                                            <?php echo $s['first_name'][0] . $s['last_name'][0]; ?>
                                        </div>
                                        <p class="font-bold text-slate-900 tracking-tight">
                                            <?php echo htmlspecialchars($s['first_name'] . ' ' . $s['last_name']); ?>
                                        </p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-slate-500 text-sm font-medium">
                                    <?php echo htmlspecialchars($s['email']); ?>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-indigo-100">
                                        <?php echo htmlspecialchars($s['course'] ?: 'Pending'); ?>
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="edit.php?id=<?php echo $s['id']; ?>" class="p-2 hover:bg-white rounded-lg text-slate-400 hover:text-indigo-600 transition shadow-sm border border-transparent hover:border-slate-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <a href="delete.php?id=<?php echo $s['id']; ?>" 
                                           onclick="return confirm('⚠️ Permanent Action: Are you sure you want to delete this student?');"
                                           class="p-2 hover:bg-white rounded-lg text-slate-400 hover:text-red-600 transition shadow-sm border border-transparent hover:border-slate-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>

<footer class="py-12 text-center">
    <p class="text-slate-400 text-sm font-medium">
        &copy; <?php echo date('Y'); ?> • <span class="text-slate-900 font-bold">Abdul Haseeb</span> Student Management
    </p>
    <div class="mt-2 flex justify-center gap-4 grayscale opacity-50">
        <span class="text-[10px] font-black uppercase tracking-tighter">PHP 8.x</span>
        <span class="text-[10px] font-black uppercase tracking-tighter">PDO MySQL</span>
        <span class="text-[10px] font-black uppercase tracking-tighter">Tailwind CSS</span>
    </div>
</footer>

</body>
</html>