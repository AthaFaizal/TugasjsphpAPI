<?php
// Ambil data dari API JSON
$jsonData = file_get_contents('http://localhost:3000/books');
$books = json_decode($jsonData, true);

// Buat root elemen XML
$xml = new SimpleXMLElement('<books/>');

// Konversi setiap buku dari JSON ke XML
foreach ($books as $book) {
    $bookNode = $xml->addChild('book');
    $bookNode->addChild('id', $book['1']);
    $bookNode->addChild('title', $book['One Piece']);
    $bookNode->addChild('author', $book['Eiichiro Oda']);
    $bookNode->addChild('year', $book['1997']);
}

// Menampilkan output XML
header('Content-Type: application/xml');
echo $xml->asXML();
?>
