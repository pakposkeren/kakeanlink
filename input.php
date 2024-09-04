<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kakean Link Disatuin!</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Your custom CSS -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, rgba(0, 123, 255, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1534196511436-921a4e99f297?fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            text-align: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .container {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            width: 100%;
            max-width: 800px;
            margin: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: auto;
        }

        .service-box {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 15px 20px;
            border-radius: 15px;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .service-box i {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 10px;
        }

        .service-box h3 {
            font-size: 1.2rem;
            margin: 10px 0;
            color: #fff;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .service-box p {
            font-size: 1rem;
            margin: 0;
            padding: 1px 0;
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            word-break: break-word;
        }

        .service-box:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        a {
            text-decoration: none;
            color: inherit;
            pointer-events: auto;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            p {
                font-size: 1rem;
            }
            .service-box {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5rem;
            }
            p {
                font-size: 0.9rem;
            }
            .service-box i {
                font-size: 1.5rem;
            }
            .service-box h3 {
                font-size: 1rem;
            }
            .service-box p {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Input Datanya Bossku!</h1>
        <p>Monggo dimasukkin satu-satu :</p>
        
        <!-- Form untuk menambah atau mengedit link -->
        <form action="manage.php" method="post">
            <fieldset class="form-group">
                <legend>Add or Edit Link</legend>
                <div class="form-group">
                    <label for="icon">Icon:</label>
                    <select id="icon" name="icon" class="form-control" required>
                        <option value="fas fa-smile">Smile</option>
                        <option value="fas fa-star">Star</option>
                        <option value="fas fa-heart">Heart</option>
                        <option value="fas fa-thumbs-up">Thumbs Up</option>
                        <option value="fas fa-cog">Cog</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="link">Link URL:</label>
                    <input type="url" id="link" name="link" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="title">Title (h3):</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description (p):</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" name="action" value="add" class="btn btn-primary">Add</button>
            </fieldset>
        </form>

        <!-- Form untuk menghapus link -->
        <form action="manage.php" method="post">
            <fieldset class="form-group">
                <legend>Delete Link</legend>
                <div class="form-group">
                    <label for="deleteIndex">Select Link to Delete:</label>
                    <select id="deleteIndex" name="deleteIndex" class="form-control" required>
                        <?php
                        // Menampilkan opsi hapus dengan judul
                        $filename = 'data/links.csv';
                        $data = readFromCsv($filename);
                        foreach ($data as $index => $row) {
                            echo "<option value=\"$index\">{$row[2]}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
            </fieldset>
        </form>
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
