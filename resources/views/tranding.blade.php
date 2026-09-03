<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E learning</title>
    <style>
        /* Mitindo ya Jumla */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #2b2d42;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Upau wa Urambazaji (Navigation Bar) */
        nav {
            background-color: #0d3b66;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        nav a {
            text-decoration: none;
            margin: 0 10px;
        }
        nav button {
            background-color: #faf0ca;
            color: #0d3b66;
            border: none;
            padding: 10px 22px;
            font-size: 15px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        nav button:hover {
            background-color: #f4d35e;
            transform: scale(1.05);
        }

        /* Sehemu ya Juu (Hero Section) */
        .hero {
            background-color: #0d3b66;
            color: white;
            padding: 60px 20px;
            margin-bottom: 30px;
        }
        .hero h1 {
            font-size: 2.8rem;
            margin: 0 0 10px 0;
            color: #f4d35e;
        }
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
        }

        /* Sehemu Kuu ya Maudhui */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Sehemu ya Wadhamini / Washirika (Sponsors Section) */
        .sponsors-section {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 40px;
        }
        .sponsors-section h2 {
            color: #0d3b66;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .sponsors-section .sub-title {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        /* Grid ya Wadhamini */
        .sponsors-grid {
            display: block;
            text-align: center;
        }
        .sponsor-card {
            display: inline-block;
            width: 28%;
            margin: 2%;
            background-color: #f8f9fa;
            padding: 30px 20px;
            border-radius: 8px;
            border: 1px solid #eef2f7;
            vertical-align: top;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
        }
        .sponsor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-color: #f4d35e;
        }
        .sponsor-logo-placeholder {
            width: 80px;
            height: 80px;
            background-color: #0d3b66;
            color: #ffffff;
            font-size: 2rem;
            line-height: 80px;
            border-radius: 50%;
            margin: 0 auto 20px auto;
            font-weight: bold;
        }
        .sponsor-card.saut .sponsor-logo-placeholder {
            background-color: #0369a1;
        }
        .sponsor-card.tz-edu .sponsor-logo-placeholder {
            background-color: #1e3a8a;
        }
        .sponsor-card h3 {
            color: #0d3b66;
            font-size: 1.25rem;
            margin: 10px 0;
            min-height: 50px;
        }
        .sponsor-card p {
            font-size: 0.95rem;
            color: #555;
            line-height: 1.5;
            text-align: justify;
        }

        /* Sehemu ya Picha */
        .gallery-grid {
            display: block;
            text-align: center;
            margin-bottom: 40px;
        }
        .img-container {
            display: inline-block;
            width: 45%;
            margin: 2%;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            vertical-align: top;
        }
        .school-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 6px;
        }
        .img-caption {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
            font-size: 1rem;
        }

        /* Sehemu ya Mawasiliano */
        .contact-card {
            background-color: #e0f2fe;
            border: 1px solid #bae6fd;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 40px;
            text-align: left;
        }
        .contact-card h2 {
            color: #0369a1;
            margin-top: 0;
        }
        .contact-info {
            font-size: 1.2rem;
            margin: 12px 0;
            color: #0c4a6e;
        }

        /* Sehemu ya Chini (Footer) */
        footer {
            background-color: #0d3b66;
            color: white;
            padding: 20px 0;
            margin-top: 60px;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <div class="hero">
        <h1>E-LEARNING SCHOOL</h1>
        <p>Quality education recognized by our strategic and academic partners.</p>
    </div>

    <div class="container">

        <!-- Picha za Ushirikiano wa Kielimu -->
        <div class="gallery-grid">
            <div class="img-container">
                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=600&q=80" alt="Watu wakishirikiana kielimu" class="school-image">
                <div class="img-caption">Developing professionals</div>
            </div>
            <div class="img-container">
                <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80" alt="Wanafunzi wakisherehekea mafanikio" class="school-image">
                <div class="img-caption">Our goal is to advance the education sector</div>
            </div>
        </div>

        <!-- Sehemu Kuu ya popular cource -->
        <div class="sponsors-section">
            <h2>Tranding courses</h2>
            <div class="sub-title">:We are here to offer you prestigious courses.</div>

            <div class="sponsors-grid">

                <!-- Courses 1: ATC -->
                <div class="sponsor-card">
                    <div class="sponsor-logo-placeholder">ECM</div>
                    <h3> Economics</h3>
                    <p>"Economists are the ones who shape the policies that govern nations and major corporations. Studying this course equips you with the language and logic used by top leaders to make strategic decisions."</p>
                </div>

                <!-- Sponsor 2: Tanzania Education Sector -->
                <div class="sponsor-card tz-edu">
                    <div class="sponsor-logo-placeholder">HW</div>
                    <h3>Health & Wellbeing</h3>
                    <p>With rising awareness surrounding anxiety, depression, and workplace burnout, there is an urgent need for professionals trained in preventive mental health care, holistic wellness, and psychological support systems.</p>
                </div>

                <!-- Sponsor 3: SAUT -->
                <div class="sponsor-card saut">
                    <div class="sponsor-logo-placeholder">IT</div>
                    <h3>Information techonology</h3>
                    <p>"This course teaches you to think logically and strategically. You learn to analyze data, troubleshoot complex systems, and make impactful technical decisions—qualities that make an IT professional a strong leader anywhere."</p>
                </div>

            </div>
        </div>
<!-----sehem ya skill---->
        <div class="sponsor-section">
            <h3>POPULAR SKILLS</h3>
        <div class="sub-title">know the popular skills</div>

    <div class="sponsor-grid">

        <div class="sponsor-card DATA">
        <div class="sponsor-logo-placeholder">DATA</div>
        <h1>Data Analysis & Management</h1>
        <p>Interpreting complex datasets using tools like SQL, Python, Excel, and visualization platforms (Power BI, Tableau) to drive business decisions.</p>
        </div>

                <div class="sponsor-card comp">
                <div class="sponsor-logo-placeholder">Comp</div>
                <h1>Cloud Computing & DevOps</h1>
                <p>Managing infrastructure and deployments using platforms like AWS, Azure, and toolsets like Docker and Kubernetes.</p>
            </div>

            <div class="sponsor-card soft">
            <div class="sponsor-logo-placeholder">soft</div>
            <h1>Software & Web Development</h1>
            <p>Building scalable software using frameworks and languages such as C, JavaScript, Python, and modern backend frameworks (e.g., Laravel, Node.js).</p>
    </div>
        </div>

        <!-- Sehemu ya Mawasiliano -->
        <div class="contact-card">
            <h2>Admissions & Enrollment Office</h2>
            <div class="contact-info">
                <strong>Simu:</strong> 0723242451
            </div>
            <div class="contact-info">
                <strong>Email</strong> ecourses@axpamle.com
            </div>
            <div class="contact-info">
                <strong>Anwani:</strong>  Arusha.
            </div>

        </div>

    </div>

    <!-- Footer -->
    <footer>
        &copy; 2026 E-learning school. .
    </footer>

</body>
</html>
