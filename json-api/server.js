const express = require('express');
const app = express();
const port = 3000;

app.use(express.json());

// Daftar person yang sudah ada
let persons = [
  {
    "id": 1,
    "nama": "Athallarik",
    "umur": 20,
    "alamat": { "Srono": "Jalan Gambor", "Banyuwangi": "Jawa Timur" },
    "hobi": ["membaca", "bersepeda"]
  }
];

// Daftar buku
let books = [
  { "id": 1, "title": "One Piece", "author": "Eiichiro Oda", "year": 1997 },
  { "id": 2, "title": "Naruto", "author": "Masashi Kishimoto", "year": 1997 }
];

// Endpoint untuk persons (seperti sebelumnya)
app.get('/person', (req, res) => {
  res.json(persons);
});

app.post('/person', (req, res) => {
  const newPerson = req.body;
  newPerson.id = persons.length + 1;
  persons.push(newPerson);
  res.status(201).json(newPerson);
});

app.delete('/person/:id', (req, res) => {
  const id = parseInt(req.params.id);
  persons = persons.filter(person => person.id !== id);
  res.status(204).send();
});

// === Endpoint Buku ===

// GET: Mengambil daftar buku
app.get('/books', (req, res) => {
  res.json(books);
});

// POST: Menambahkan buku baru
app.post('/books', (req, res) => {
  const newBook = req.body;
  newBook.id = books.length + 1;
  books.push(newBook);
  res.status(201).json(newBook);
});

// Jalankan server di port 3000
app.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}`);
});
