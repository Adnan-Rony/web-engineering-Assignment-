<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$book = $conn->query("SELECT * FROM books WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $best_seller = isset($_POST['best_seller']) ? 1 : 0;

    $conn->query("UPDATE books 
                  SET title='$title', author='$author', genre='$genre', best_seller='$best_seller' 
                  WHERE id=$id");
    header("Location: view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏ Update Book</h2>

    <form method="POST" class="space-y-5">
        <!-- Title -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Book Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                required>
        </div>

        <!-- Author -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Author</label>
            <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                required>
        </div>

        <!-- Genre -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Genre</label>
            <select name="genre"
                class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                required>
                <option value="Fiction" <?= $book['genre'] == 'Fiction' ? 'selected' : '' ?>>Fiction</option>
                <option value="Non-Fiction" <?= $book['genre'] == 'Non-Fiction' ? 'selected' : '' ?>>Non-Fiction</option>
                <option value="Sci-Fi" <?= $book['genre'] == 'Sci-Fi' ? 'selected' : '' ?>>Sci-Fi</option>
                <option value="Fantasy" <?= $book['genre'] == 'Fantasy' ? 'selected' : '' ?>>Fantasy</option>
            </select>
        </div>

        <!-- Best Seller -->
        <div class="flex items-center">
            <input type="checkbox" name="best_seller" id="best_seller"
                class="w-5 h-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500"
                <?= $book['best_seller'] ? 'checked' : '' ?>>
            <label for="best_seller" class="ml-2 text-gray-700">Best Seller?</label>
        </div>

        <!-- Buttons -->
        <div class="flex space-x-4">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg shadow">
                Update
            </button>
            <a href="view.php"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg shadow">
                Cancel
            </a>
        </div>
    </form>
</div>

</body>
</html>
