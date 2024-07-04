# Acme Widget Co Sales System

Acme Widget Co are the leading provider of made up widgets and they’ve contracted you to create a proof of concept for their new sales system.
The system calculates the total cost of a basket, taking into account product prices, delivery costs, and special offers.

## Products

- **Red Widget (R01)**: $32.95
- **Green Widget (G01)**: $24.95
- **Blue Widget (B01)**: $7.95

## Delivery Costs

- Orders under $50: $4.95
- Orders under $90: $2.95
- Orders $90 or more: Free delivery

## Special Offers

- **Buy one red widget, get the second half price**

## Installation

1. Clone the repository:
2. Run `index.php` using command: `php index.php`

## Usage

The `Basket` class handles the products, delivery costs, and offers. It has the following methods:

- `__construct($products, $deliveryCost, $offers)`: Initializes the basket with the product catalogue, delivery cost rules, and offers.
- `add($productCode)`: Adds a product to the basket using the product code.
- `total()`: Returns the total cost of the basket, taking into account delivery and offer rules.

### Example

```php
$basket = new Basket($products, $deliveryCost, $offers);
$basket->add('B01');
$basket->add('G01');
echo "Total: $" . $basket->total(); // $37.85
```
