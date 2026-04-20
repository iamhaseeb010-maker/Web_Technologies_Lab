<?php
// Handle form submission logic at the top
$submitted = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST["name"]);
    $email   = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);
    $submitted = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdul Haseeb | Contact Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .form-input {
            transition: all 0.2s ease-in-out;
        }
        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            outline: none;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <?php if ($submitted): ?>
            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200 border border-slate-100 text-center animate-in fade-in zoom-in duration-300">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    ✅
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Form Submitted!</h2>
                <p class="text-slate-500 mb-8">Thanks for reaching out, Abdul. Here is the data we received:</p>
                
                <div class="bg-slate-50 rounded-2xl p-6 text-left space-y-4 mb-8">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Name</p>
                        <p class="text-slate-700 font-medium"><?php echo $name; ?></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Email</p>
                        <p class="text-slate-700 font-medium"><?php echo $email; ?></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Message</p>
                        <p class="text-slate-700 leading-relaxed"><?php echo $message; ?></p>
                    </div>
                </div>

                <a href="index.php" class="inline-block w-full py-4 bg-slate-900 text-white rounded-2xl font-semibold hover:bg-slate-800 transition active:scale-95">
                    Go Back to Form
                </a>
            </div>

        <?php else: ?>
            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200 border border-slate-100">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-slate-900">Get in touch</h1>
                    <p class="text-slate-500">Send me a message and I'll get back to you.</p>
                </div>

                <form method="POST" action="" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                        <input type="text" name="name" required placeholder="Abdul Haseeb" 
                               class="form-input w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder:text-slate-400">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                        <input type="email" name="email" required placeholder="abdul@example.com" 
                               class="form-input w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder:text-slate-400">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Your Message</label>
                        <textarea name="message" rows="4" required placeholder="How can I help you?" 
                                  class="form-input w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder:text-slate-400 resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-bold text-lg hover:bg-blue-700 transition transform active:scale-[0.98] shadow-lg shadow-blue-200">
                        Send Message
                    </button>
                </form>
            </div>
        <?php endif; ?>
        
        <p class="text-center mt-8 text-slate-400 text-sm font-medium">
            &copy; 2026 Developed by Abdul Haseeb
        </p>
    </div>

</body>
</html>