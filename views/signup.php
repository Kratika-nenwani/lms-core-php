<!DOCTYPE html>
<html>
<head>
    <title>Library Management System - Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 items-center">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow bg-dark text-white">
                <div class="card-header mt-3 bg-primary text-white text-center">
                    <h3>Create an Account</h3>
                <div id="responseMessage" class="text-center mt-3"></div>
                </div>
                <div class="card-body">
                    <form id="signupForm">
                        <input type="hidden" name="action" value="signup">

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="unique_name" class="form-label">Unique Name</label>
                            <input type="text" name="unique_name" id="unique_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Mobile Number</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Register</button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="signin.php" class="text-light">Already have an account? Sign in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
//     document.getElementById('signupForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     const form = new FormData(this);
//     fetch('../controller/AuthController.php', {
//         method: 'POST',
//         body: form
//     })
//     .then(res => res.json())
//     .then(data => {
//         const messageDiv = document.getElementById('responseMessage');
//         if (data.status === "success") {
//             messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
//             form.reset();
//         } else {
//             messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
//         }
//     });
// });
document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = new FormData(this);

    fetch('../controller/AuthController.php', {
        method: 'POST',
        body: form
    })
    .then(res => res.json())
    .then(data => {
        console.log("Response from server:", data); 
        const messageDiv = document.getElementById('responseMessage');
        if (data.status === "success") {
            messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            this.reset(); // reset the form
        } else {
            messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(err => {
        console.error("Fetch error:", err); 
        document.getElementById('responseMessage').innerHTML =
            `<div class="alert alert-danger">Something went wrong. Please try again.</div>`;
    });
});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
