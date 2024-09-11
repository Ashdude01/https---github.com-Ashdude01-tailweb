<?php include 'authCheck.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/meta.php'; ?>
    <title>Registration <?php echo site_name; ?></title>
</head>

<body>
    <section class="bg-gray-200 bg-cover bg-center min-h-screen">
        <div class="container mx-auto p-4 flex justify-center items-center">
            <div class="flex flex-col shadow-2xl shadow-gray-800 rounded my-20 w-full max-w-[500px]">
                <div class="flex flex-row p-4 bg-blue-700 items-center">
                    <i class="bi bi-person-add text-6xl text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 pr-2"></i>
                    <div class="flex flex-col gap-1 text-white">
                        <h1 class="text-2xl font-semibold">Registration</h1>
                        <p class="text-sm">Please Enter your Details</p>
                    </div>
                </div>
                <form id="signupForm" class="flex flex-col bg-white gap-5 font-semibold p-4 py-5">
                    <div class="relative z-0 w-full">
                        <input title="name" type="text" name="name" id="name" class="rounded border border-gray-800 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                        <label for="name" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Full Name</label>
                    </div>
                    <div class="relative z-0 w-full">
                        <input title="username" type="text" name="username" id="username" class="rounded border border-gray-800 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                        <label for="username" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Username</label>
                    </div>
                    <div class="relative z-0 w-full">
                        <input title="Password" type="password" name="password" id="password" class="rounded border border-gray-800 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                        <label for="password" class="peer-focus:font-medium absolute duration-300 transform -translate-y-4 scale-75 left-4 peer-focus:left-4 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Password</label>
                    </div>
                    <div class="flex gap-2 items-center justify-between">
                        <a href="login.php" class="font-bold text-sm text-red-500 hover:text-red-600">Already Registerd? Login</a>
                        <button type="submit" class="px-3 py-2 w-fit rounded bg-blue-600 text-white font-semibold hover:bg-blue-800">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include 'components/footer.php' ?>
    <script>
        $(document).ready(function() {
            $('#signupForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                try {
                    // Retrieve form input values
                    const name = $('#name').val();
                    const username = $('#username').val();
                    const password = $('#password').val();

                    // Validate form input
                    if (!name || !username || !password) {
                        throw new Error('All Fields Required');
                    }

                    // Send form data via POST request using $.post
                    $.post('api/register.php', {
                        name: name, // Fix: Pass the correct data
                        username: username,
                        password: password
                    }, function(data) {
                        // Check if the server responded with success or failure
                        if (data.success === false) {
                            Swal.fire({
                                icon: 'error',
                                text: data.message,
                                width: 300
                            })
                        } else {
                            // Display success message using SweetAlert
                            Swal.fire({
                                icon: 'success',
                                text: data.message,
                                width: 300,
                                confirmButtonText: 'Login'
                            }).then(() => {
                                location.href = "login.php";
                            });
                        }
                    })
                } catch (error) {
                    // Handle any caught errors by displaying an error message using SweetAlert
                    console.log(error)
                    Swal.fire({
                        icon: 'error',
                        text: error.message,
                        width: 300
                    });
                }
            });
        });
    </script>
</body>

</html>