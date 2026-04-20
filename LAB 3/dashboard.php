<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
// Placeholder for demonstration if session email isn't set yet
$userEmail = $_SESSION["email"] ?? "admin@abdulhaseeb.tech";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdul Haseeb | Secure Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(16, 185, 129, 0.1);
        }
    </style>
</head>
<body class="bg-[#f0fdf4] min-h-screen flex">

    <aside class="hidden lg:flex flex-col w-64 bg-emerald-900 text-white p-6">
        <div class="mb-10">
            <h2 class="text-2xl font-bold tracking-tight">Abdul<span class="text-emerald-400">Haseeb</span></h2>
            <p class="text-xs text-emerald-300 opacity-70">Lab 3 Management System</p>
        </div>
        <nav class="space-y-2 flex-1">
            <a href="#" class="flex items-center space-x-3 bg-emerald-800 p-3 rounded-xl text-white">
                <span>🏠</span> <span class="font-medium">Overview</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 rounded-xl text-emerald-100 hover:bg-emerald-800 transition">
                <span>📊</span> <span class="font-medium">Analytics</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 rounded-xl text-emerald-100 hover:bg-emerald-800 transition">
                <span>⚙️</span> <span class="font-medium">Settings</span>
            </a>
        </nav>
        <div class="pt-6 border-t border-emerald-800">
            <a href="logout.php" class="flex items-center space-x-3 p-3 text-red-300 hover:text-red-100 transition">
                <span>🚪</span> <span class="font-medium">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 p-4 md:p-10 overflow-y-auto">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-emerald-950">Welcome Back, <?php echo htmlspecialchars($_SESSION["user"]); ?>! 👋</h1>
                <p class="text-emerald-600">Here's what's happening with your account today.</p>
            </div>
            <div class="flex items-center space-x-4 bg-white p-2 pr-6 rounded-full shadow-sm border border-emerald-100">
                <div class="h-10 w-10 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                    <?php echo strtoupper(substr($_SESSION["user"], 0, 1)); ?>
                </div>
                <div>
                    <p class="text-sm font-bold text-emerald-900 leading-none"><?php echo htmlspecialchars($_SESSION["user"]); ?></p>
                    <p class="text-xs text-emerald-500 italic">Pro Member</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="glass-panel p-6 rounded-3xl shadow-sm">
                <p class="text-emerald-600 text-sm font-semibold mb-1">Status</p>
                <h3 class="text-2xl font-bold text-emerald-900">Active</h3>
            </div>
            <div class="glass-panel p-6 rounded-3xl shadow-sm">
                <p class="text-emerald-600 text-sm font-semibold mb-1">Security</p>
                <h3 class="text-2xl font-bold text-emerald-900">Verified</h3>
            </div>
            <div class="glass-panel p-6 rounded-3xl shadow-sm">
                <p class="text-emerald-600 text-sm font-semibold mb-1">Last Login</p>
                <h3 class="text-2xl font-bold text-emerald-900"><?php echo date("h:i A"); ?></h3>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl shadow-emerald-900/5 overflow-hidden border border-emerald-100">
            <div class="bg-emerald-600 p-8 text-white">
                <h2 class="text-xl font-bold">Account Information</h2>
                <p class="text-emerald-100 opacity-80 text-sm">Verify your credentials and linked email.</p>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-emerald-50 pb-6">
                        <div class="mb-2 md:mb-0">
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-500 mb-1">Display Name</p>
                            <p class="text-lg font-semibold text-emerald-900"><?php echo htmlspecialchars($_SESSION["user"]); ?></p>
                        </div>
                        <button class="text-sm font-bold text-emerald-600 hover:text-emerald-700">Edit</button>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-emerald-50 pb-6">
                        <div class="mb-2 md:mb-0">
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-500 mb-1">Email Address</p>
                            <p class="text-lg font-semibold text-emerald-900"><?php echo htmlspecialchars($userEmail); ?></p>
                        </div>
                        <span class="bg-emerald-100 text-emerald-700 text-[10px] font-black px-2 py-1 rounded-md uppercase">Primary</span>
                    </div>
                </div>

                <div class="mt-10 flex gap-4">
                    <button class="flex-1 bg-emerald-600 text-white py-4 rounded-2xl font-bold hover:bg-emerald-700 transition transform hover:scale-[1.02] active:scale-95 shadow-lg shadow-emerald-200">
                        Update Settings
                    </button>
                    <a href="logout.php" class="flex-1">
                        <button class="w-full bg-white text-red-500 border-2 border-red-50 py-4 rounded-2xl font-bold hover:bg-red-50 hover:border-red-100 transition">
                            Sign Out
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <footer class="mt-10 text-center text-emerald-400 text-sm">
            &copy; 2026 Abdul Haseeb Lab 3 | Built with PHP & Tailwind CSS
        </footer>
    </main>

</body>
</html>