<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form - e-Learning School</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            padding: 20px;
        }
        .form-container {
            max-width: 500px;
            background: #ffffff;
            padding: 25px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .gender-options {
            margin-top: 5px;
        }
        .gender-options label {
            display: inline;
            font-weight: normal;
            margin-right: 15px;
        }
        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            margin-top: 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Student Registration Form</h3>
    <form action="#" method="POST">

        <!-- Full Name -->
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" placeholder="e.g. name" required>

        <!-- Email Address -->
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" placeholder="example@gmail.com" required>

        <!-- Phone Number -->
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" placeholder="+255 7XX XXX XXX" required>

        <!-- Date of Birth -->
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <!-- Gender -->
        <label>Gender:</label>
        <div class="gender-options">
            <input type="radio" id="male" name="gender" value="male" required>
            <label for="male">Male</label>

            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
        </div>

        <!-- Select Course -->
        <label for="course">Select Preferred Course:</label>
        <select id="course" name="course" required>
            <option value="">-- Select Course --</option>
            <option value="cs">Computer Science</option>
            <option value="it">Information Technology (IT)</option>
            <option value="cyber_security">Cyber Security</option>
        </select>

        <!-- Password -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <!-- Submit Button -->
        <button type="submit">Register Now</button>

    </form>
</div>

</body>
</html>
