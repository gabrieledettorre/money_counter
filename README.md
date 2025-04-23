# Contabanconote

A simple web app to keep track of physical banknotes. You can increment or decrement each denomination (€5, €10, €20, €50) or manually set the quantity. Data is stored in a database, so your values are saved even if you close or refresh the page.

## Features

- Add or remove banknotes per denomination
- Input field to manually change the quantity
- Reset button to clear all values
- Automatic total calculation
- Mobile-friendly interface using Bootstrap

## Requirements

- PHP
- MySQL
- A web server (like Apache or any shared hosting like Altervista)

## Setup

1. **Upload the files** to your web space.
2. **Create the database table**:

```sql
CREATE TABLE `banconote` (
  `taglio` INT PRIMARY KEY,
  `quantita` INT DEFAULT 0
);

INSERT INTO `banconote` (`taglio`, `quantita`) VALUES (5, 0), (10, 0), (20, 0), (50, 0);
