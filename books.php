<?php
header('Content-Type: application/xml');

$books = [
    [
        "id" => 1,
        "title" => "One Piece",
        "author" => "Eiichiro Oda",
        "year" => 1997
    ],
    [
        "id" => 2,
        "title" => "Naruto",
        "author" => "Masashi Kishimoto",
        "year" => 1997
    ]
];

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Mengembalikan daftar buku dalam format XML
        $xml = new SimpleXMLElement('<books/>');
        foreach ($books as $book) {
            $bookNode = $xml->addChild('book');
            $bookNode->addChild('id', $book['id']);
            $bookNode->addChild('title', $book['title']);
            $bookNode->addChild('author', $book['author']);
            $bookNode->addChild('year', $book['year']);
        }
        echo $xml->asXML();
        break;

    case 'POST':
        // Menambahkan buku baru
        $input = json_decode(file_get_contents('php://input'), true);
        $newBook = [
            "id" => count($books) + 1,
            "title" => $input['title'],
            "author" => $input['author'],
            "year" => $input['year']
        ];
        $books[] = $newBook;

        $xml = new SimpleXMLElement('<book/>');
        $xml->addChild('id', $newBook['id']);
        $xml->addChild('title', $newBook['title']);
        $xml->addChild('author', $newBook['author']);
        $xml->addChild('year', $newBook['year']);
        echo $xml->asXML();
        break;

    default:
        http_response_code(405);
        echo "<error>Method not supported</error>";
        break;
}
?>
