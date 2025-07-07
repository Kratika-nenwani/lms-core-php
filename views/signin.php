<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow bg-dark text-white">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <div id="response"></div>
                    <form id="loginForm">
                        <input type="hidden" name="action" value="login">
                        <input class="form-control mb-2" name="unique_name" placeholder="Unique Name" required>
                        <input class="form-control mb-2" name="password" type="password" placeholder="Password" required>
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </form>
                    <div class="text-center mt-2">
                        <a href="signup.php" class="text-white">Don't have an account? Signup</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = new FormData(this);
    fetch('../controller/AuthController.php', {
        method: 'POST',
        body: form
    })
    .then(res => res.json())
    .then(data => {
    document.getElementById('response').innerHTML = `<div class='alert alert-${data.status === 'success' ? 'success' : 'danger'}'>${data.message}</div>`;
    if (data.status === 'success') {
        setTimeout(() => {
            if (data.isadmin) {
                window.location.href = 'admin/admin_dashboard.php';
            } else {
                window.location.href = 'user/user_dashboard.php';
            }
        }, 1000);
    }
});
});
</script>
</body>
</html>
