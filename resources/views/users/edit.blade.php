<!-- resources/views/users/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <!-- Link to your external or internal CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
        }

        label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

       
        .form-group {
            margin-bottom: 15px;
        }

        .form-group button {
            width: auto;
            background-color: #ff9800;
            padding: 8px 16px;
        }

        .form-group button:hover {
            background-color: #f57c00;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit User</h1>
        <form id="user-edit-form">
        <input type="hidden" id="user_id" value="{{ $user->id }}">
        <input type="hidden" id="user_name" value="{{ $user->name }}">
        <input type="hidden" id="user_email" value="{{ $user->email }}">

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" value="{{ old('password') }}" required>
                <button type="button" onclick="generatePassword()">Generate Password</button>
            </div>

            <div class="form-group">
                <button type="submit">Update User</button>
            </div>
        </form>
    </div>

    <script>

document.getElementById('user-edit-form').addEventListener('submit', function(e) {
    e.preventDefault();
    

    const userId = document.getElementById('user_id').value;
    const name = document.getElementById('user_name').value;
    const email = document.getElementById('user_email').value;
    const password = document.getElementById('password').value;

    fetch(`/api/users/${userId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            // If you have a token for auth, include it like:
            // 'Authorization': 'Bearer YOUR_API_TOKEN'
        },
        
        body: JSON.stringify({
            name:name,
            email:email,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Najma")
        console.log(JSON.stringify)
        alert('User updated successfully!');
        console.log(data);
    })
    .catch(error => {
        alert('Update failed!');
        console.error(error);
    });
});

        // Function to generate a random password
        function generatePassword() {
            const password = Math.random().toString(36).slice(-8); // Generates an 8-character password
            document.getElementById('password').value = password;
        }

       
    </script>
</body>
</html>
