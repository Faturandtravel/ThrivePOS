<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; font-family: sans-serif; background-color: #f8fafc; color: #0f172a; margin: 0;">
    <div style="text-align: center;">
        <svg style="width: 64px; height: 64px; margin: 0 auto; color: #22c55e;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <h2 style="margin-top: 16px; margin-bottom: 8px;">Payment Successful!</h2>
        <p style="color: #64748b;">You can close this window now.</p>
        <script>
            setTimeout(() => {
                window.close();
            }, 1000);
        </script>
    </div>
</body>
</html>
