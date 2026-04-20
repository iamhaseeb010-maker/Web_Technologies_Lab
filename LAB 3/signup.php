<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to prevent XSS and file format issues
    $name     = str_replace("|", "-", htmlspecialchars($_POST["name"]));
    $email    = str_replace("|", "-", htmlspecialchars($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);

    // Check if user already exists
    if (file_exists("users.txt")) {
        $lines = file("users.txt");
        foreach ($lines as $line) {
            $data = explode("|", trim($line));
            if (isset($data[1]) && $data[1] == $email) {
                $error = "This email is already registered!";
                break;
            }
        }
    }

    if ($error == "") {
        // Save user to file - name|email|password
        $user = $name . "|" . $email . "|" . $password . PHP_EOL;
        file_put_contents("users.txt", $user, FILE_APPEND | LOCK_EX);
        header("Location: login.php?success=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdul Haseeb | Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .mesh-gradient {
            background-color: #f0fdf4;
            background-image: 
                radial-gradient(at 0% 0%, hsla(161,71%,90%,1) 0, transparent 50%), 
                radial-gradient(at 100% 100%, hsla(161,71%,85%,1) 0, transparent 50%);
        }
    </style>
</head>
<body class="mesh-gradient min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-600 rounded-2xl shadow-lg shadow-emerald-200 mb-4 transform rotate-6">
                <span class="text-white text-2xl font-black">AH</span>
            </div>
            <h1 class="text-3xl font-extrabold text-emerald-950 tracking-tight">Create Account</h1>
            <p class="text-emerald-600 font-medium">Join the Lab 3 Secure Environment</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] shadow-2xl shadow-emerald-900/10 border border-white">
            
            <?php if ($error): ?>
                <div class="mb-6 p-4 rounded-2xl bg-red-50 text-red-600 border border-red-100 flex items-center gap-3">
                    <span class="text-lg">⚠️</span>
                    <p class="text-sm font-semibold"><?php echo $error; ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" action="signup.php" class="space-y-5">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-emerald-900 ml-1">Full Name</label>
                    <input type="text" name="name" required placeholder="Abdul Haseeb" 
                        class="w-full px-5 py-4 border border-emerald-100 rounded-2xl bg-white/50 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all placeholder:text-emerald-300">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-emerald-900 ml-1">Email Address</label>
                    <input type="email" name="email" required placeholder="abdul@example.com" 
                        class="w-full px-5 py-4 border border-emerald-100 rounded-2xl bg-white/50 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all placeholder:text-emerald-300">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-emerald-900 ml-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" 
                        class="w-full px-5 py-4 border border-emerald-100 rounded-2xl bg-white/50 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all placeholder:text-emerald-300">
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-emerald-700 shadow-xl shadow-emerald-200 transition-all transform hover:scale-[1.01] active:scale-95">
                        Get Started
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-emerald-50 text-center">
                <p class="text-emerald-900/50 text-sm font-medium">
                    Already part of the team? 
                    <a href="login.php" class="text-emerald-600 font-bold hover:text-emerald-700 transition-colors ml-1">Sign In</a>
                </p>
            </div>
        </div>
        
        <p class="text-center mt-8 text-emerald-900/30 text-xs font-bold uppercase tracking-widest">
            &copy; 2026 Developed by Abdul Haseeb
        </p>
    </div>

</body>
</html>