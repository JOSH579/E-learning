<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>WELCOME - TO LEARN MORE</title>
        <style>
            .main-heading {
                color: #007bff;
                text-align: center;
                font-family: Arial, sans-serif;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>

        <!-- Header Section -->
        <div style="text-align: center;">
            <h1 class="main-heading">WELCOME - TO LEARN MORE</h1>
            <img src="{{ asset('images/picha.jpg') }}" alt="E-learning">

                </div>

        <br><br>

        <!-- Course Dropdown -->
        <label for="course-select">Choose Course:</label>
        <select id="course-select" required>
            <option value="">-- Choose Course --</option>
            <option value="cs">Computer Science</option>
            <option value="it">Information Technology</option>
            <option value="cyber">Cyber Security</option>
        </select>

        <hr>

        <!-- Computer Science Section -->
        <h2>Computer Science</h2>
        <p>Key subjects covered in Computer Science:</p>
        <ul>
            <li>Data Structures & Algorithms</li>
            <li>Object-Oriented Programming </li>
            <li>Operating Systems</li>
            <li>Database Management Systems </li>
            <li>Software Engineering</li>
            <li>Computer Architecture</li>
        </ul>

        <hr>

        <!-- Information Technology Section -->
        <h2>Information Technology</h2>
        <p>Key subjects covered in Information Technology:</p>
        <ul>
            <li>Web Development & Web Technologies</li>
            <li>Computer Networks & Communication</li>
            <li>Cloud Computing</li>
            <li>Database Administration</li>
            <li>Systems Analysis and Design</li>
            <li>IT Project Management</li>
        </ul>

        <hr>

        <!-- Cyber Security Section -->
        <h2>Cyber Security</h2>
        <p>Key subjects covered in Cyber Security:</p>
        <ul>
            <li>Network Security & Firewalls</li>
            <li>Ethical Hacking & Penetration Testing</li>
            <li>Cryptography & Data Protection</li>
            <li>Digital Forensics & Incident Response</li>
            <li>Cyber Laws, Risk & Compliance</li>
            <li>Application Security</li>
        </ul>

    </body>
</html>