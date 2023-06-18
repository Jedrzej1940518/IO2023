Wstepna dokumentacja:

# Installation

### Prerequsites:
 - php server installed
 - mysql server installed or internet hosted mysql server
 - mod_rewrite enabled

### Instruction
 1) Put everything from repo to directory, where php server looks for .php files
 2) Change values inside file [DBConnection.php](DBConnection.php) to math mysql connection parameters
 3) Connect to mysql and copy/paste content of [sqlScript.txt](sqlScript.txt) or execute this script as a query to prepare mysql server
 4) start php server
 5) done


# Endpoints

## User endpoints
<details>
<summary>All user endpoints</summary>


### POST
 - register - register user </br> <details>
        <summary>body</summary>

        ```
        {
            "email" : "example@email.com",
            "first_name":"user_name",
            "last_name": "user_last_name",
            "age": 25,
            "address": "krakow",
            "password":"yooo"
        }
        ```
    </details>
 - login - login for registered user </br> <details>
        <summary>body</summary>

        ```
        {
            "email" : "example@email.com",
            "password":"yooo"
        }
        ```
    </details>

### GET
 - me - prints all information about current user

</details>

</br>

## Products endpoints

<details>
<summary>All products endpoints</summary>


### POST
 - products - inserts new product </br> <details>
        <summary>body</summary>

        ```
        {
            "name": "vn5",
            "category_id": 31,
            "alcohol_content": 99.5,
            "description": "zz",
            "country_origin_id": 25,
            "price": 100.99,
            "available_amount": 100,
            "rating": 4
        }
        ```
    </details>

### GET
 - products - returns list of products, allows also to specify page and limit, or filters field, where available filters are:
   - name - string, search by name
   - price_min - float, minimal price
   - price_max - float, maximum price
   - alcohol_content_min - int, minimal content of an alcohol
   - alcohol_content_max - int, maximal content of an alcohol
   - category_id - int, by category
 - products/{id} - return single product, where product id is {id}, {id} is integer

### PUT
 - products/{id} - {id} is int, edits product with given id </br> <details>
        <summary>body</summary>

        ```
        {
            "name": "UpdatedProduct",
            "price": 9.99,
            "available_amount": 100,
            "rating": 4
        }
        ```
    </details>

### DELETE
 - products/{id} - {id} is int, removes product with given id

</details>

</br>

## Category endpoints

<details>
<summary>All category endpoints</summary>


### POST
 - categories - inserts new category </br> <details>
        <summary>body</summary>

        ```
        {
            "name": "wóda",
            "description": "kopie mocno"
        }
        ```
    </details>

### GET
 - categories - returns list of categories

### DELETE
 - categories/{id} - {id} is int, removes category with given id

</details>

</br>

## Orders endpoints

<details>
<summary>All orders endpoints</summary>

</br>

#### Available order states:
 - 0 - ORDER_STARTED
 - 1 - AWAITING_PAYMENT
 - 2 - PAYMENT_FAILED
 - 3 - ORDER_FINISHED

</br>

### POST
 - orders - inserts new order </br> <details>
        <summary>body</summary>

        ```
        {
            "order_date": "2023-06-15 14:25:45",
            "user_id": 36,
            "state_id": 0
        }
        ```
    </details>

### GET
 - orders - returns list of user orders
 - orders/{id} - returns order with specified id

### PUT
 - orders/{id} - {id} is int, edits order with given id </br> <details>
        <summary>body</summary>

        ```
        {
            "order_date": "2023-06-15 14:45:45"
        }
        ```
    </details>


### DELETE
 - orders/{id} - {id} is int, removes order with given id

</details>

</br>

## Orders entries endpoints

<details>
<summary>All orders entries endpoints</summary>


### POST
 - orders_entries/{id} - {id} is int (order id), inserts new order entry for given order id </br> <details>
        <summary>body</summary>

        ```
        {
            "order_id": 12,
            "amount": 10,
            "product_id": 40,
            "historic_price": 33
        }
        ```
    </details>

### GET
 - orders_entries/{id} - {id} as int (order id), returns all entries per order id

### PUT
 - orders_entries/{id} - {id} is int, edits order entry with given id </br> <details>
        <summary>body</summary>

        ```
        {
            "product_id": 40,
            "historic_price": 33
        }
        ```
    </details>


### DELETE
 - orders_entries/{id} - {id} is int, removes order entry with given id

</details>

</br>

## Product opinion endpoints

<details>
<summary>All product opinion endpoints</summary>


### POST
 - product_opinions - inserts new product opinion </br> <details>
        <summary>body</summary>

        ```
        {
            "product_id": 40,
            "user_id": 36,
            "rate": 4,
            "description": "ziomus tego sie nie da pic",
            "opinion_date":"2023-06-15 14:25:45"
        }
        ```
    </details>

### GET
 - product_opinions/{id} - {id} as int (product id), returns all opinions per product id

### PUT
 - product_opinions/{id} - {id} is int, edits opinion with given id </br> <details>
        <summary>body</summary>

        ```
        {
            "description": "nie no, jednak smakuje lepiej jak wychodzi"
        }
        ```
    </details>


### DELETE
 - product_opinions/{id} - {id} is int, removes opinion with given id

</details>