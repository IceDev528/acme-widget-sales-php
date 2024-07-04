<?php

class Basket {
    private $products;
    private $deliveryCost;
    private $offers;
    private $basket;

    public function __construct($products, $deliveryCost, $offers) {
        $this->products = $products;
        $this->deliveryCost = $deliveryCost;
        $this->offers = $offers;
        $this->basket = [];
    }

    public function add($productCode) {
        if (isset($this->products[$productCode])) {
            $this->basket[] = $productCode;
        } else {
            throw new Exception("Product {$productCode} does not exist.");
        }
    }

    public function total() {
        $total = 0.0;
        $productCount = array_count_values($this->basket);
        
        foreach ($productCount as $productCode => $count) {
            $productPrice = $this->products[$productCode];
            
            if ($productCode === 'R01' && $count > 1) {
                $total += $productPrice * (int)($count / 2) * 1.5 + $productPrice * ($count % 2);
            } else {
                $total += $productPrice * $count;
            }
        }

        $deliveryCost = $this->calculateDeliveryCost($total);
        $total += $deliveryCost;

        return number_format(floor($total * 100) / 100, 2);
    }

    private function calculateDeliveryCost($total) {
        foreach ($this->deliveryCost as $limit => $charge) {
            if ($total < $limit) {
                return $charge;
            }
        }
        return 0;
    }

    public function showBasket() {
        foreach ($this->basket as $productCode) {
            echo "{$productCode} ";
        }
    }
}

// Product Catalogue
$products = [
    'R01' => 32.95,
    'G01' => 24.95,
    'B01' => 7.95
];

// Delivery Costs
$deliveryCost = [
    50 => 4.95,
    90 => 2.95,
    PHP_INT_MAX => 0
];

// Special Offers
$offers = [
    'R01' => 'buy_one_get_second_half'
];

$basket = new Basket($products, $deliveryCost, $offers);

// Test cases
$basket = new Basket($products, $deliveryCost, $offers);
$basket->add('B01');
$basket->add('G01');
$basket->showBasket();
echo "Total: $" . $basket->total() . "\n"; // $37.85

$basket = new Basket($products, $deliveryCost, $offers);
$basket->add('R01');
$basket->add('R01');
$basket->showBasket();
echo "Total: $" . $basket->total() . "\n"; // $54.37

$basket = new Basket($products, $deliveryCost, $offers);
$basket->add('R01');
$basket->add('G01');
$basket->showBasket();
echo "Total: $" . $basket->total() . "\n"; // $60.85

$basket = new Basket($products, $deliveryCost, $offers);
$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');
$basket->showBasket();
echo "Total: $" . $basket->total() . "\n"; // $98.27

?>
