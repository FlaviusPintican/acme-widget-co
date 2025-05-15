# Architech Labs Code Test

## Acme Widget Co

Acme Widget Co are the leading provider of made up widgets and they’ve contracted you to create a proof of concept for their new sales system.

They sell three products:

| Product       | Code | Price  |
|---------------|------|--------|
| Red Widget    | R01  | $32.95 |
| Green Widget  | G01  | $24.95 |
| Blue Widget   | B01  | $7.95  |

To incentivise customers to spend more, delivery costs are reduced based on the amount spent:

- Orders under $50: **$4.95**
- Orders under $90: **$2.95**
- Orders of $90 or more: **Free delivery**

### Special Offer

They are also experimenting with special offers. The initial offer will be:

> Buy one red widget, get the second half price

---

## Your Task

Implement a basket which needs to have the following interface:

- It is initialised with the product catalogue, delivery charge rules, and offers (the format of how these are passed is up to you).
- It has an `add` method that takes the product code as a parameter.
- It has a `total` method that returns the total cost of the basket, taking into account the delivery and offer rules.

---

## Example Baskets and Totals

| Products                 | Total   |
|--------------------------|---------|
| B01, G01                 | $37.85  |
| R01, R01                 | $54.37  |
| R01, G01                 | $60.85  |
| B01, B01, R01, R01, R01  | $98.27  |

---

## What We Expect to See

- A solution written in easy to understand and update PHP
- A README file explaining how it works and any assumptions you’ve made
- Pushed to a public Github repo


## Run the project
```
docker compose up -d
docker exec -it basket_app composer install
```

## Run the unit and functional tests
```
docker exec -it basket_app composer run test
```

## Run the phpstan analysis
```
docker exec -it basket_app composer run analyze
```


#### This project implements a shopping basket system for Acme Widget Co. Here's a technical overview:


## Architecture Overview
The project follows clean architecture principles with separated components:


### Domain Models
#### Product: Readonly class with code, name, and price properties
#### Catalogue: Repository pattern implementation for product storage

### Basket Implementation
#### BasketInterface: Contract defining the required methods
#### Basket: Core implementation tracking products and calculating prices

### Pricing Components
#### Delivery Cost Calculation: Strategy pattern via DeliveryCostInterface
#### Discount Offers: Strategy pattern via OfferInterface
#### Price Calculations: Utility methods in ProductHelper
#### Product codes implemented as typed enums (ProductEnumCode)

### Tests
#### Unit Tests: PHPUnit tests for all components
#### Functional Tests: for the basket functionality
