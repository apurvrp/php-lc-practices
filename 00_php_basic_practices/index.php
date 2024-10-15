<?php

$name = "Tom";
$read = true;
if ($read) {
    $msg = "Hello, my name is $name and I've read a book";
} else {
    $msg = "I've not read a book";
}

$books = [
    [
        'name' => "Max Harry",
        'book' => "Book is our friend",
        'purchaseURL' => 'https://github.com/apurv-developer27',
        'releaseYear' => 2022
    ],
    [
        'name' => "Eon Morgun",
        'book' => "Cricketer",
        'purchaseURL' => 'https://github.com/apurv-developer27',
        'releaseYear' => '2021'
    ],
    [
        'name' => "Morni Morkle",
        'book' => "The Family",
        'purchaseURL' => 'https://github.com/apurv-developer27',
        'releaseYear' => '2020'
    ],
    [
        'name' => "Max Harry",
        'book' => "Friends",
        'purchaseURL' => 'https://github.com/apurv-developer27',
        'releaseYear' => '2019',
    ],
    [
        'name' => "Eon Morgun",
        'book' => "The Sports",
        'purchaseURL' => 'https://github.com/apurv-developer27',
        'releaseYear' => '2023',
    ],
];

$key = "name";
$value = "Max Harry";

/*
####### Lambda functions
*/

$filterByAuthor = function ($books, $aKey, $value) {
    $filterBooks = [];
    
    foreach ($books as $key => $book) 
    {
        if(!empty(trim($aKey)) && !empty(trim($value)))
        {
            if($book[$aKey] === $value) {
                $filterBooks[] = $book;
            }
        }else{
            $filterBooks[] = $book;
        }
        
    }
    return $filterBooks;
};
$filterBooksData = $filterByAuthor($books, $key, $value);

// Option 2
$filterByAuthor2 = function ($items, $fn) {
    $filterBooks = [];
    
    foreach ($items as $item) {
        if($fn($item)) {
            $filterBooks[] = $item;
        }        
    }
    return $filterBooks;
};
$filterBooksData2 = $filterByAuthor2($books, function($book){
    return $book['releaseYear'] <= 2020;
});

// Option 3
$filterBooksData3 = array_filter($books, function($book){
    return $book['name'] === 'Eon Morgun';
});


require 'index.view.php';