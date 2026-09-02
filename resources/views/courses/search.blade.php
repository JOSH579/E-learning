<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Resources & Shop</title>
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
            align-items: flex-start;
            min-height: 100vh;
            padding: 20px;
        }

        .main-wrapper {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            overflow: hidden;
        }

        /* Tab Navigation Header */
        .tab-buttons {
            display: flex;
            background-color: #e9ecef;
            border-bottom: 2px solid #dee2e6;
        }

        .tab-btn {
            flex: 1;
            padding: 15px;
            background: none;
            border: none;
            font-size: 16px;
            font-weight: bold;
            color: #495057;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 0;
        }

        .tab-btn.active {
            background-color: #ffffff;
            color: #3498db;
            border-bottom: 3px solid #3498db;
        }

        .tab-content {
            display: none;
            padding: 30px;
        }

        .tab-content.active {
            display: block;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Form Controls */
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

        /* Product Store Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .product-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background: #fafafa;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .product-card h4 {
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .product-card .price {
            color: #27ae60;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 12px;
        }

        .product-card label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            background: #fff;
            padding: 6px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
        }

        /* Checkout Summary Area */
        .checkout-section {
            background-color: #f8fafc;
            border-top: 2px dashed #cbd5e1;
            padding-top: 20px;
            margin-top: 10px;
        }

        .checkout-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
        }

        /* Action Buttons */
        .btn-submit {
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

        .btn-submit:hover {
            background-color: #2980b9;
        }

        .btn-checkout {
            background-color: #27ae60;
        }

        .btn-checkout:hover {
            background-color: #219150;
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <!-- Tab Navigation Buttons -->
    <div class="tab-buttons">
        <button class="tab-btn active" onclick="switchTab('search-tab', event)">🔍 Search Resources</button>
        <button class="tab-btn" onclick="switchTab('shop-tab', event)">📚 Buy Books & Tools</button>
    </div>
    <div id="search-tab" class="tab-content active">
        <h2>Search Learning Resources</h2>

  <div class="form-group">
                <label for="category">Select Subject:</label>
                <select id="category" name="category">
                    <option value="all">All Subjects</option>
                    <option value="computer_science">Computer Science</option>
                    <option value="it">Information Technology (IT)</option>
                    <option value="cyber_security">Cybersecurity</option>
                </select>
            </div>
    <!-- TAB 2: SEARCH FORM -->
        <form action="search_results.php" method="GET">
            <div class="form-group">
                <label for="keyword">Search Keyword:</label>
                <input type="text" id="keyword" name="keyword" placeholder="e.g., Data Structures, SQL, Python..." required>
            </div>


            <div class="form-group">
                <label>Resource Type:</label>
                <div class="radio-group">
                    <label><input type="radio" name="type" value="all" checked> All</label>
                    <label><input type="radio" name="type" value="notes"> Notes (PDF/Docs)</label>
                    <label><input type="radio" name="type" value="video"> Videos</label>
                </div>
            </div>

            <button type="submit" class="btn-submit">Search</button>
        </form>
    </div>

    <!-- TAB 2: STORE & CHECKOUT -->
    <div id="shop-tab" class="tab-content">
        <h2>Select Books & Study Tools</h2>
        <form action="checkout.php" method="POST">

            <div class="products-grid">
                <!-- Book Item 1 -->
                <div class="product-card">
                    <h4>Python CS Handbook</h4>
                    <p class="price"></p>
                    <label>
                        <input type="checkbox" name="items[]" value="python_book" data-price="15.00" onchange="calculateTotal()"> Select
                    </label>
                </div>

                <!-- Book Item 2 -->
                <div class="product-card">
                    <h4>Networking Essentials</h4>
                    <p class="price"></p>
                    <label>
                        <input type="checkbox" name="items[]" value="networking_book" data-price="20.00" onchange="calculateTotal()"> Select
                    </label>
                </div>

                <!-- Tool Item 1 -->
                <div class="product-card">
                    <h4> USB Drive (64GB)</h4>
                    <p class="price"></p>
                    <label>
                        <input type="checkbox" name="items[]" value="usb_course" data-price="25.00" onchange="calculateTotal()"> Select
                    </label>
                </div>

                <!-- Tool Item 2 -->
                <div class="product-card">
                    <h4>Computers</h4>
                    <p class="price"></p>
                    <label>
                        <input type="checkbox" name="items[]" value="cyber_book" data-price="30.00" onchange="calculateTotal()"> Select
                    </label>
                </div>
            </div>

            <!-- Cart Summary Section -->
            <div class="checkout-section">
                <div class="checkout-summary">
                    <span>Total Amount:</span>
                    <span id="total-price">$0.00</span>
                </div>
                <button type="submit" class="btn-submit btn-checkout">Proceed to Payment</button>
            </div>

        </form>
    </div>
</div>

<script>
    // Tab Switcher Logic
    function switchTab(tabId, event) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

        document.getElementById(tabId).classList.add('active');
        event.currentTarget.classList.add('active');
    }

    // Dynamic Price Calculation
    function calculateTotal() {
        let checkboxes = document.querySelectorAll('input[name="items[]"]:checked');
        let total = 0;

        checkboxes.forEach(box => {
            total += parseFloat(box.getAttribute('data-price'));
        });

        document.getElementById('total-price').innerText = '$' + total.toFixed(2);
    }
</script>

</body>
</html>
