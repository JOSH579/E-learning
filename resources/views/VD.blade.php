<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Study Resources</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .search-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .search-container h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-weight: 600;
        }

        input[type="text"], select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, select:focus {
            border-color: #3498db;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 5px;
        }

        .radio-group label {
            font-weight: normal;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="search-container">
    <h2>Search Learning Resources</h2>
    <form action="search_results.php" method="GET">

        <!-- Keyword Search -->
        <div class="form-group">
            <label for="keyword">Search Keyword:</label>
            <input type="text" id="keyword" name="keyword" placeholder="e.g., Data Structures, Ethical Hacking, SQL..." required>
        </div>

        <!-- Course Category Filter -->
        <div class="form-group">
            <label for="category">Select Subject:</label>
            <select id="category" name="category">
                <option value="all">All Subjects</option>
                <option value="computer_science">Computer Science</option>
                <option value="it">Information Technology (IT)</option>
                <option value="cyber_security">Cybersecurity</option>
            </select>
        </div>

        <!-- Resource Type Filter -->
        <div class="form-group">
            <label>Resource Type:</label>
            <div class="radio-group">
                <label><input type="radio" name="type" value="all" checked> All</label>
                <label><input type="radio" name="type" value="notes"> Notes (PDF/Docs)</label>
                <label><input type="radio" name="type" value="video"> Videos</label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit">Search</button>
    </form>
</div>

</body>
</html>
