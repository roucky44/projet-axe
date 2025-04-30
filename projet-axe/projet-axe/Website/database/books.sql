SELECT * FROM `book`;

INSERT INTO book (title, author, date_publication) VALUES
('1984', 'George Orwell', '1949'),
('Le Petit Prince', 'Antoine de Saint-Exupéry', '1943'),
('L''Etranger', 'Albert Camus', '1942'),
('Orgueil et Préjugés', 'Jane Austen', '1813'),
('Le Seigneur des Anneaux', 'J.R.R. Tolkien', '1955'),
('Crime et Châtiment', 'Fiodor Dostoïevski', '1866'),
('Cent ans de solitude', 'Gabriel García Márquez', '1967'),
('Beloved', 'Toni Morrison', '1987'),
('Le Vieil Homme et la Mer', 'Ernest Hemingway', '1952'),
('Harry Potter à l''école des sorciers', 'J.K. Rowling', '1997');

SELECT * FROM book;

SELECT title, author, date_publication FROM book ORDER BY title ASC, author ASC, date_publication > 2000; 