<?php
$results = array(
    0 => array(
        'name' => 'Shaytanat',
        'author' => 'Toxir Malik',
        'year' => 2006
    ),
    1 => array(
        'name' => 'Zulmatdagi saltanat',
        'author' => 'Abdurahimov O‘tkir',
        'year' => 2019
    ),
    2 => array(
        'name' => 'Двойник',
        'author' => 'Фёдор Достоевский',
        'year' => 1846,
    ),
);

class Book{
    public function __construct(array $books)
    {
        foreach ($books as $book){
            if (is_array($book) &&
                isset($book['name']) &&
                isset($book['author']) &&
                isset($book['year'])) {
                $this->getPrintBook($book['name'], $book['author'], $book['year']);
            }
        }
    }

    private function getPrintBook($name, $author, $year){
        echo "<h3>Kitob: $name</h3>";
        echo "<p>$author | $year</p><br>";
    }
}

$books = new Book($results);