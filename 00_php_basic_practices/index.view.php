<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book author name</title>
</head>

<body>
    <h1><?= $msg ?></h1>
    <div>
        <p>
        <h3>Option 3</h3>
        </p>
        <ul>
            <?php foreach ($filterBooksData3 as $key => $book) : ?>
            <li class="common-book-items">
                <a href="<?= $book['purchaseURL'] ?>"><?= $book['book']; ?> (<?= $book['releaseYear'] ?>) - By
                    <?= $book['name'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <p>
        <h3>Option 2</h3>
        </p>
        <ul>
            <?php foreach ($filterBooksData2 as $key => $book) : ?>
            <li class="common-book-items">
                <a href="<?= $book['purchaseURL'] ?>"><?= $book['book']; ?> (<?= $book['releaseYear'] ?>) - By
                    <?= $book['name'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>

        <p>
        <h3>Option 1</h3>
        </p>
        <ul>
            <?php foreach ($filterBooksData as $key => $book) : ?>
            <li class="common-book-items">
                <a href="<?= $book['purchaseURL'] ?>"><?= $book['book']; ?> (<?= $book['releaseYear'] ?>) - By
                    <?= $book['name'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>