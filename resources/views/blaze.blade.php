<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WELCOME - TO LEARN MORE</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background: #f8fafc;
            }
            .nav {
                text-align: right;
                margin-bottom: 20px;
            }
            .nav a {
                margin-left: 12px;
                color: #007bff;
                text-decoration: none;
            }
            .nav a:hover {
                text-decoration: underline;
            }
            .main-heading {
                color: #007bff;
                text-align: center;
                margin-top: 20px;
            }
            .cta {
                text-align: center;
                margin: 24px 0;
            }
            .cta a {
                display: inline-block;
                background: #007bff;
                color: #fff;
                padding: 12px 24px;
                border-radius: 4px;
                text-decoration: none;
                margin: 0 8px;
            }
            .cta a.secondary {
                background: #fff;
                color: #007bff;
                border: 1px solid #007bff;
            }
            .courses-box {
                max-width: 700px;
                margin: 0 auto 30px;
                background: #fff;
                border: 1px solid #e2e8f0;
                padding: 16px;
                border-radius: 8px;
            }
            .courses-box ul {
                padding-left: 20px;
            }
        </style>
    </head>
    <body>
        <div class="nav">
            <a href="{{ route('blaze') }}">Home</a>
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('login') }}">Log in</a>
        </div>

        <div style="text-align: center;">
            <h1 class="main-heading">WELCOME - TO LEARN MORE</h1>
            <img src="{{ asset('images/picha.jpg') }}" alt="E-learning" style="max-width: 100%; height: auto;">
        </div>

        <div class="cta">
            <a href="{{ route('register') }}">Register as a student</a>
            <a href="{{ route('login') }}" class="secondary">Already have an account?</a>
        </div>

        @if ($publishedCourses->isNotEmpty())
            <div class="courses-box">
                <h2>Published courses on our platform</h2>
                <ul>
                    @foreach ($publishedCourses as $course)
                        <li>
                            <strong>{{ $course->title }}</strong>
                            — {{ number_format((float) $course->price, 2) }}
                            @auth
                                <a href="{{ route('courses.show', $course) }}">View course</a>
                            @endauth
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <br>

        <label for="course-select">Explore subject areas:</label>
        <select id="course-select">
            <option value="">-- Choose Course --</option>
            <option value="cs">Computer Science</option>
            <option value="it">Information Technology</option>
            <option value="cyber">Cyber Security</option>
        </select>

        <hr>

        <h2>Computer Science</h2>
        <p>Key subjects covered in Computer Science:</p>
        <ul>
            <li>Data Structures & Algorithms</li>
            <li>Object-Oriented Programming</li>
            <li>Operating Systems</li>
            <li>Database Management Systems</li>
            <li>Software Engineering</li>
            <li>Computer Architecture</li>
        </ul>

        <hr>

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
