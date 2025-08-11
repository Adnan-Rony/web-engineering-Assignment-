<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $best_seller = isset($_POST['best_seller']) ? 1 : 0;

    $sql = "INSERT INTO books (title, author, genre, best_seller) 
            VALUES ('$title', '$author', '$genre', '$best_seller')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📚 Add New Book</h2>

    <form method="POST" class="space-y-5">
        <!-- Title -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Book Title</label>
            <input type="text" name="title" placeholder="Enter book title"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <!-- Author -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Author</label>
            <input type="text" name="author" placeholder="Enter author name"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <!-- Genre -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Genre</label>
            <select name="genre"
                class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
                <option value="">-- Select Genre --</option>
                <option value="Fiction">Fiction</option>
                <option value="Non-Fiction">Non-Fiction</option>
                <option value="Sci-Fi">Sci-Fi</option>
                <option value="Fantasy">Fantasy</option>
            </select>
        </div>

        <!-- Best Seller -->
        <div class="flex items-center">
            <input type="checkbox" name="best_seller" id="best_seller"
                class="w-5 h-5 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
            <label for="best_seller" class="ml-2 text-gray-700">Best Seller?</label>
        </div>

        <!-- Buttons -->
        <div class="flex space-x-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                Submit
            </button>
            <a href="view.php"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg shadow">
                View Books
            </a>
        </div>
    </form>
</div>

</body>
</html>
