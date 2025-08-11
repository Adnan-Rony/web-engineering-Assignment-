<?php include 'db.php'; ?>

<?php
// Delete book
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM books WHERE id=$id");
    header("Location: view.php");
    exit();
}

// Fetch all books
$result = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Books</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📚 Book List</h2>
        <a href="book.php"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            ➕ Add New Book
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Author</th>
                    <th class="px-6 py-3 text-left">Genre</th>
                    <th class="px-6 py-3 text-center">Best Seller</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3"><?= htmlspecialchars($row['title']) ?></td>
                        <td class="px-6 py-3"><?= htmlspecialchars($row['author']) ?></td>
                        <td class="px-6 py-3"><?= htmlspecialchars($row['genre']) ?></td>
                        <td class="px-6 py-3 text-center">
                            <?= $row['best_seller'] ? '✅' : '❌' ?>
                        </td>
                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="update.php?id=<?= $row['id'] ?>"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow">
                                ✏ Update
                            </a>
                            <a href="view.php?delete=<?= $row['id'] ?>"
                               onclick="return confirm('Delete this book?')"
                               class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow">
                                🗑 Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
