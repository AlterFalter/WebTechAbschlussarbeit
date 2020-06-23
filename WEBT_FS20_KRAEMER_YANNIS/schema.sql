-- Create database
CREATE DATABASE currencyChangerDB;

-- Add tables
CREATE TABLE currency_pair_price (
    CurrencyStart VARCHAR(3),
    CurrencyEnd VARCHAR(3),
    Factor FLOAT
);

-- Fill in data
INSERT INTO currency_pair_price (CurrencyStart, CurrencyEnd, Factor) values ("USD", "CHF", 0.97);
INSERT INTO currency_pair_price (CurrencyStart, CurrencyEnd, Factor) values ("CHF", "USD", 1.03);
INSERT INTO currency_pair_price (CurrencyStart, CurrencyEnd, Factor) values ("CHF", "EUR", 0.94);
INSERT INTO currency_pair_price (CurrencyStart, CurrencyEnd, Factor) values ("EUR", "CHF", 1.06);
INSERT INTO currency_pair_price (CurrencyStart, CurrencyEnd, Factor) values ("EUR", "USD", 1.09);
INSERT INTO currency_pair_price (CurrencyStart, CurrencyEnd, Factor) values ("USD", "EUR", 0.92);
