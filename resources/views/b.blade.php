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
        .nav {
            max-width: 500px;
            margin: 0 auto 16px;
            text-align: right;
        }
        .nav a {
            color: #007bff;
            text-decoration: none;
            margin-left: 12px;
        }
        .form-container {
            max-width: 500px;
            background: #ffffff;
            padding: 25px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2, h3 {
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
        .error {
            color: #b91c1c;
            font-size: 14px;
            margin-top: 4px;
        }
        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>

<div class="nav">
    <a href="{{ route('blaze') }}">Back to welcome page</a>
    <a href="{{ route('login') }}">Log in</a>
</div>

<div class="form-container">
    <h3>Student Registration Form</h3>

    @if ($errors->any())
        <div class="alert">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. John Doe" required>
        @error('name')<p class="error">{{ $message }}</p>@enderror

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" required>
        @error('email')<p class="error">{{ $message }}</p>@enderror

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+255 7XX XXX XXX" required>
        @error('phone')<p class="error">{{ $message }}</p>@enderror

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
        @error('date_of_birth')<p class="error">{{ $message }}</p>@enderror

        <label>Gender:</label>
        <div class="gender-options">
            <input type="radio" id="male" name="gender" value="male" @checked(old('gender') === 'male') required>
            <label for="male">Male</label>

            <input type="radio" id="female" name="gender" value="female" @checked(old('gender') === 'female')>
            <label for="female">Female</label>
        </div>
        @error('gender')<p class="error">{{ $message }}</p>@enderror

        <label for="preferred_course">Select Preferred Course:</label>
        <select id="preferred_course" name="preferred_course" required>
            <option value="">-- Select Course --</option>
            <option value="cs" @selected(old('preferred_course') === 'cs')>Computer Science</option>
            <option value="it" @selected(old('preferred_course') === 'it')>Information Technology (IT)</option>
            <option value="cyber_security" @selected(old('preferred_course') === 'cyber_security')>Cyber Security</option>
        </select>
        @error('preferred_course')<p class="error">{{ $message }}</p>@enderror

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="At least 8 characters" required>
        @error('password')<p class="error">{{ $message }}</p>@enderror

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit">Register Now</button>
    </form>
</div>

</body>
</html>
